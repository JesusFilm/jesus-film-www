const headerSearchForm = document.getElementById( 'header-search' );
const headerSearchToggle = document.querySelectorAll( '[data-header-search-toggle]' );
const searchPageSearchForm = document.querySelector( 'body.search #header-search' ) ?? null;

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

if ( searchPageSearchForm ) {
	setTimeout( () => {
		headerSearchForm.classList.remove( 'hidden' );
		headerSearchForm.setAttribute( 'aria-expanded', 'true' );
	}, 250 );
}
