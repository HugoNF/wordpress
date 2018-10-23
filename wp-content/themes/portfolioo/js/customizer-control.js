(function( $ ) {
    wp.customize.bind( 'ready', function() {
        var customize = this;

        // Codes here
        var api = wp.customize;
		wp.customize.section( 'sidebar-widgets-frontpage-1' ).panel( 'frontpage');


    } );
})( jQuery );