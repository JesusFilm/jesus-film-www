const { registerBlockType } = wp.blocks;

import * as card from './card';

const blocks = [
	card,
];

const registerBlock = ( block ) => {
	if ( ! block ) {
		return;
	}
	const { metadata, settings, name } = block;
	registerBlockType( { name, ...metadata }, settings );
};

blocks.forEach( registerBlock );
