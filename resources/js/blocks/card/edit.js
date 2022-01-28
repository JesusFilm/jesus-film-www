import classNames from 'classnames';

const { __ } = wp.i18n;
const { getBlobByURL, isBlobURL } = wp.blob;
const { InnerBlocks, useBlockProps, MediaPlaceholder, store } = wp.blockEditor;
const { Image } = wp.blockLibrary;
const { useSelect } = wp.data;
const { useEffect } = wp.element;

export function isMediaDestroyed( id ) {
	const attachment = wp?.media?.attachment( id ) || {};
	return attachment.destroyed;
}

export default function edit( { attributes, setAttributes, className, isSelected, context } ) {
	const { id, mediaAlt, url, mediaLink } = attributes;

	const classes = classNames( className, 'wp-block-card' );

	const blockProps = useBlockProps( {
		className: classes,
	} );

	const mediaUpload = useSelect( ( select ) => {
		const { getSettings } = select( store );
		return getSettings().mediaUpload;
	}, [] );

	useEffect( () => {
		if ( ! id && isBlobURL( url ) ) {
			const file = getBlobByURL( url );

			if ( file ) {
				mediaUpload( {
					filesList: [ file ],
					onFileChange: ( [ { id: id, url } ] ) => {
						setAttributes( { id, src: url } );
					},
					onError: ( e ) => {
						setAttributes( { src: undefined, id: undefined } );
					},
					allowedTypes: [ 'image' ],
				} );
			}
		}
	}, [] );

	function onSelectURL( newSrc ) {
		if ( newSrc !== url ) {
			setAttributes( { src: newSrc, id: undefined } );
		}
	}

	function onUploadError( message ) {
		console.error( message );
	}

	function onSelectImage( media ) {
		if ( ! media || ! media.url ) {
			// in this case there was an error and we should continue in the editing state
			// previous attributes should be removed because they may be temporary blob urls
			setAttributes( { url: undefined, id: undefined } );
			return;
		}

		// sets the block's attribute and updates the edit component from the
		// selected media, then switches off the editing UI
		setAttributes( { url: media.url, id: media.id } );
	}

	function onCloseModal() {
		if ( isMediaDestroyed( attributes?.id ) ) {
			setAttributes( {
				url: undefined,
				id: undefined,
			} );
		}
	}

	function onImageError( isReplaced = false ) {
		// If the image block was not replaced with an embed,
		// clear the attributes and trigger the placeholder.
		if ( ! isReplaced ) {
			setAttributes( {
				url: undefined,
				id: undefined,
			} );
		}
	}

	return (
		<div { ...blockProps }>
			<div className="wp-block-card-media">
				{ ( url ) && (
					<img src={ url } />
				) }
				<MediaPlaceholder
					labels={ {
						title: '',
						instructions: '',
					} }
					onSelect={ onSelectImage }
					onSelectURL={ onSelectURL }
					accept="image/*"
					allowedTypes={ [ 'image' ] }
					value={ { id, url } }
					onError={ onUploadError }
					disableMediaButtons={ url }
				/>
			</div>
			<div className="wp-block-card-bottom">
				<InnerBlocks />
			</div>
		</div>
	);
}
