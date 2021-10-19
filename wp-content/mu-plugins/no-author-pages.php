<?php
/**
 * Redirect requests to author pages like ...
 * https://www.example.com/author/admin
 * ... to the homepage
 */

add_action(
	'template_redirect',
	function() {
		if ( is_author() ) {
			// change to 301 redirects if you really never want to display
			// author pages.
			wp_redirect( get_option( 'home' ), 302 );
			exit;
		}
	}
);
