import classNames from 'classnames';

const { __ } = wp.i18n;
const { getBlobByURL, isBlobURL } = wp.blob;
const { BlockControls, MediaReplaceFlow, InnerBlocks, AlignmentControl, RichText, useBlockProps, MediaPlaceholder, store } = wp.blockEditor;
const { Toolbar, ToolbarGroup, ToolbarButton } = wp.components;
const { Image } = wp.blockLibrary;
const { useSelect, useDispatch } = wp.data;
const { useEffect, createRef, Platform } = wp.element;

export default function edit( { attributes, onReplace, setAttributes, className } ) {
	const {
		content,
		textAlign,
		placeholder,
	} = attributes;

	const blockProps = useBlockProps( {
		className: classNames( className, {
			[ `has-text-align-${ textAlign }` ]: textAlign,
		}, 'wp-block-more-link' ),
	} );

	const onContentChange = ( value ) => {
		const newAttrs = { content: value };

		setAttributes( newAttrs );
	};

	return (
		<>
			<BlockControls group="block">
				<AlignmentControl
					value={ textAlign }
					onChange={ ( nextAlign ) => {
						setAttributes( { textAlign: nextAlign } );
					} }
				/>
			</BlockControls>
			<RichText
				identifier="content"
				tagName="div"
				value={ content }
				onChange={ onContentChange }
				onReplace={ onReplace }
				onRemove={ () => onReplace( [] ) }
				aria-label={ __( 'Read more text' ) }
				placeholder={ placeholder || __( 'Read More' ) }
				textAlign={ textAlign }
				{ ...( Platform.isNative && { deleteEnter: true } ) } // setup RichText on native mobile to delete the "Enter" key as it's handled by the JS/RN side
				{ ...blockProps }
			/>
		</>
	);
}
