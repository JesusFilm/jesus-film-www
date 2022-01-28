const labelPlaceholderFields = document.querySelectorAll( '.gfield_label_placeholder' );

labelPlaceholderFields.forEach( ( field ) => {
	const fieldInputs = field.querySelectorAll( 'input, select, textarea' );

	if ( fieldInputs.length ) {
		fieldInputs.forEach( ( input ) => {
			input.addEventListener( 'focus', labelPlaceholderFieldClass, false );
			input.addEventListener( 'change', labelPlaceholderFieldClass, false );
			input.addEventListener( 'blur', labelPlaceholderFieldClass, false );
		} );
	}
} );

function labelPlaceholderFieldClass( e ) {
	if ( 'focus' === e.type || e.target.value ) {
		e.target.closest( '.gfield_label_placeholder' ).classList.add( 'is-focused' );
	}

	if ( 'blur' === e.type && ! e.target.value ) {
		e.target.closest( '.gfield_label_placeholder' ).classList.remove( 'is-focused' );
	}
}
