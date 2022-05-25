let scrollPosition = window.scrollY;
const siteHeader = document.getElementsByClassName( 'site-header' )[ 0 ] ?? false,
	siteHeaderHeight = siteHeader?.offsetHeight;

if ( siteHeader ) {
	window.addEventListener( 'scroll', function() {
		scrollPosition = window.scrollY;

		if ( scrollPosition >= siteHeaderHeight ) {
			siteHeader.classList.add( 'sticky' );
		} else {
			siteHeader.classList.remove( 'sticky' );
		}
	} );
}
