const { RichText } = wp.blockEditor;

export default function save( { attributes } ) {
	const { content } = attributes;

	return (
		<RichText.Content value={ content } />
	);
}

