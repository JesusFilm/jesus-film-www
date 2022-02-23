const { registerPlugin } = wp.plugins;
const { __ } = wp.i18n;
const { useSelect, dispatch } = wp.data;
const { Fragment } = wp.element; // eslint-disable-line
const { PluginDocumentSettingPanel } = wp.editPost;  // eslint-disable-line
const { SelectControl, ToggleControl, PanelBody } = wp.components; // eslint-disable-line
const { InspectorControls } = wp.blockEditor; // eslint-disable-line

import './blocks';

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
	'moneythink/columns-custom-attribute',
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

const columnsControls = wp.compose.createHigherOrderComponent( () => {
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
	'moneythink/columns-reverse-mobile-control',
	columnsControls,
);

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'moneythink/columns-apply-class',
	function( extraProps, blockType, attributes ) {
		const { reverseColumnsMobile } = attributes;

		if ( typeof reverseColumnsMobile !== 'undefined' && reverseColumnsMobile ) {
			extraProps.className = extraProps.className + ' reverse-columns-mobile';
		}
		return extraProps;
	},
);
