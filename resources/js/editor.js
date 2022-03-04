const { registerPlugin } = wp.plugins;
const { __ } = wp.i18n;
const { useSelect, dispatch } = wp.data;
const { Fragment } = wp.element; // eslint-disable-line
const { createHigherOrderComponent } = wp.compose; // eslint-disable-line
const { PluginDocumentSettingPanel } = wp.editPost;  // eslint-disable-line
const { SelectControl, ToggleControl, PanelBody, __experimentalUnitControl: UnitControl } = wp.components; // eslint-disable-line
const { InspectorControls, BlockEdit } = wp.blockEditor; // eslint-disable-line

import './blocks';
import classNames from 'classnames';

wp.domReady( () => {
	wp.blocks.registerBlockStyle( 'core/cover', {
		name: 'narrow',
		label: 'Narrow',
	} );
} );

/**
 * Submenu control.
 */
function SubmenuSelectControl() {
	const menusSelect = useSelect( ( select ) => {
		return select( 'core' ).getMenus( { per_page: 100, context: 'view' } );
	}, [] );

	const meta = useSelect( ( select ) =>
		select( 'core/editor' ).getEditedPostAttribute( 'meta' )._jf_submenu,
	);

	if ( ! menusSelect ) {
		return null;
	}

	const menus = menusSelect.map( ( author ) => ( { value: author.id, label: author.name } ) );

	menus.unshift( { value: null, label: __( 'None' ) } );

	return (
		<SelectControl
			label={ __( 'Submenu to display' ) }
			options={ menus }
			value={ meta }
			onChange={ ( value ) => {
				dispatch( 'core/editor' ).editPost( {
					meta: {
						_jf_submenu: value,
					},
				} );
			} }
		/>
	);
}

const JFSubmenuPanel = () => (
	<PluginDocumentSettingPanel
		name="submenu"
		title={__( 'Submenu' )}
		className="submenu"
	>
		<SubmenuSelectControl />

	</PluginDocumentSettingPanel>
);

registerPlugin( 'jf-submenu-panel', {
	render: JFSubmenuPanel,
	icon: null,
} );

/**
 * Reverse columns mobile.
 */
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'jesusfilm/columns-custom-attribute',
	function( settings, name ) {
		if ( typeof settings.attributes !== 'undefined' ) {
			if ( name === 'core/columns' ) {
				settings.attributes = Object.assign( settings.attributes, {
					reverseColumnsMobile: {
						type: 'boolean',
					},
				} );
			}
		}
		return settings;
	},
);

const columnsControls = wp.compose.createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const { attributes, setAttributes, isSelected } = props;

		return (
			<Fragment>
				<BlockEdit {...props} />
				{isSelected && ( props.name === 'core/columns' ) &&
					<InspectorControls>
						<PanelBody>
							<ToggleControl
								label={wp.i18n.__( 'Reverse Columns on Mobile' )}
								checked={!! attributes.reverseColumnsMobile}
								onChange={() => setAttributes( { reverseColumnsMobile: ! attributes.reverseColumnsMobile } )}
							/>
						</PanelBody>
					</InspectorControls>
				}
			</Fragment>
		);
	};
}, 'columnsControls' );

wp.hooks.addFilter(
	'editor.BlockEdit',
	'jesusfilm/columns-reverse-mobile-control',
	columnsControls,
);

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'jesusfilm/columns-apply-class',
	function( extraProps, blockType, attributes ) {
		const { reverseColumnsMobile } = attributes;

		if ( typeof reverseColumnsMobile !== 'undefined' && reverseColumnsMobile ) {
			extraProps.className = extraProps.className + ' reverse-columns-mobile';
		}
		return extraProps;
	},
);

// Enable custom attributes on Image block
const enableWidthSelectOnBlocks = [
	'core/group',
];

/**
 * Declare our custom attribute
 *
 * @param  settings
 * @param  name
 */
const setWidthAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( ! enableWidthSelectOnBlocks.includes( name ) ) {
		return settings;
	}

	return Object.assign( {}, settings, {
		attributes: Object.assign( {}, settings.attributes, {
			groupWidth: { type: 'string' },
		} ),
	} );
};
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'jesusfilm/set-sidebar-select-attribute',
	setWidthAttribute,
);

/**
 * Add Custom Select to Image Sidebar
 */
const withWidthSelect = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		// If current block is not allowed
    	if ( ! enableWidthSelectOnBlocks.includes( props.name ) ) {
			return (
				<BlockEdit { ...props } />
			);
		}

		const { attributes, setAttributes } = props;
		const { groupWidth } = attributes;

		return (
			<Fragment>
				<BlockEdit { ...props } />
				<InspectorControls>
                	<PanelBody
    	                title={ __( 'Sizing' ) }
    	            >

						<UnitControl
							label={ __( 'Width' ) }
							onChange={ ( value ) => {
								setAttributes( {
									groupWidth: value,
								} );
							} }
							value={ groupWidth }
						/>

	                </PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'withWidthSelect' );

wp.hooks.addFilter(
	'editor.BlockEdit',
	'jesusfilm/with-sidebar-select',
	withWidthSelect,
);

/**
 * Add custom class to block in Edit
 */
const withWidthSelectProp = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		// If current block is not allowed
		if ( ! enableWidthSelectOnBlocks.includes( props.name ) ) {
			return (
				<BlockListBlock { ...props } />
			);
		}

		const { attributes } = props;
		const { groupWidth } = attributes;

		if ( groupWidth ) {
			let wrapperProps = props.wrapperProps;

			wrapperProps = {
				...wrapperProps,
				style: {
					...( wrapperProps && { ...wrapperProps.style } ),
					maxWidth: groupWidth,
				},
			};

			return <BlockListBlock { ...props } className={ 'has-max-width' } wrapperProps={ wrapperProps } />;
		}
		return <BlockListBlock { ...props } />;
	};
}, 'withWidthSelectProp' );

wp.hooks.addFilter(
	'editor.BlockListBlock',
	'jesusfilm/with-sidebar-select-prop',
	withWidthSelectProp,
);

/**
 * Save our custom attribute
 *
 * @param  props
 * @param  blockType
 * @param  attributes
 */
const saveWidthAttribute = ( props, blockType, attributes ) => {
	// Do nothing if it's another block than our defined ones.
	if ( enableWidthSelectOnBlocks.includes( blockType.name ) ) {
		const { groupWidth } = attributes;
		if ( groupWidth ) {
			props.className = classNames( props.className, 'has-max-width' );

			Object.assign( props, { style: { ...props.style, maxWidth: groupWidth } } );
		}
	}

	return props;
};
wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'jesusfilm/save-sidebar-select-attribute',
	saveWidthAttribute,
);
