
document.addEventListener( 'DOMContentLoaded', function() {
	setTimeout( function() {
		const mainNode = document.getElementById( 'genesis-mobile-nav-primary' ) ?? false;

		if ( mainNode ) {
			function callback( mutationsList, observer ) {
				mutationsList.forEach( ( mutation ) => {
					if ( mutation.attributeName === 'class' ) {
						if ( mutation.target.classList.contains( 'activated' ) ) {
							document.body.classList.add( 'primary-nav-expanded' );
						} else {
							document.body.classList.remove( 'primary-nav-expanded' );
						}
					}
				} );
			}

			const mutationObserver = new MutationObserver( callback );

			mutationObserver.observe( mainNode, { attributes: true } );
		}
	}, 2000 );
} );
