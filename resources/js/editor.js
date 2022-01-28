const { registerPlugin } = wp.plugins;
const { __ } = wp.i18n;
const { useSelect, dispatch } = wp.data;
const { Fragment } = wp.element; // eslint-disable-line
const { PluginDocumentSettingPanel } = wp.editPost;  // eslint-disable-line
const { SelectControl } = wp.components; // eslint-disable-line

import './blocks';

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

wp.domReady( () => {
	wp.blocks.registerBlockStyle( 'core/cover', {
		name: 'narrow',
		label: 'Narrow',
	} );
} );
