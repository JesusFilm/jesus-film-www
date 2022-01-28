const headerSearchForm = document.getElementById( 'header-search' );
const headerSearchToggle = document.querySelectorAll( '[data-header-search-toggle]' );

headerSearchToggle.forEach( ( toggle ) => {
	toggle.addEventListener( 'click', function( e ) {
		e.preventDefault();

		headerSearchForm.classList.remove( 'hidden' );

		const expanded = headerSearchForm.getAttribute( 'aria-expanded' );

		if ( 'false' === expanded || ! expanded ) {
			headerSearchForm.setAttribute( 'aria-expanded', 'true' );
			headerSearchForm.querySelector( '.search-form-input' ).focus();
		} else {
			headerSearchForm.setAttribute( 'aria-expanded', 'false' );
		}
	} );
} );
