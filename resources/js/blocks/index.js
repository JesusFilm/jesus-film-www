const { registerBlockType } = wp.blocks;

import * as card from './card';
import * as moreLink from './more-link';

const blocks = [
	card,
	moreLink,
];

const registerBlock = ( block ) => {
	if ( ! block ) {
		return;
	}
	const { metadata, settings, name } = block;
	registerBlockType( { name, ...metadata }, settings );
};

blocks.forEach( registerBlock );
