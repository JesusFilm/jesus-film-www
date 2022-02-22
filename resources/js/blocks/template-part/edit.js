const { useBlockProps } = wp.blockEditor;
const { useEntityProp } = wp.coreData;
const { RawHTML } = wp.element;

export default function edit( { attributes, setAttributes, className, focus, id, context: { postId, postType, queryId } } ) {
	const blockProps = useBlockProps();

	const [
		meta,
		setMeta,
		template_part,
	] = useEntityProp( 'postType', postType, 'template_part', postId );

	return (
		<div { ...blockProps }>
			<RawHTML key="html">{ template_part }</RawHTML>
		</div>
	);
}
