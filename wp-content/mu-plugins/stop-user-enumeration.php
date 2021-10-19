<?php
/**
 * Do not allow requests like
 * https://www.example.com/?author=1
 * that redirect to
 * https://www.example.com/author/admin/
 * and therefor reveal user login names.
 */

add_filter( 'init', function() {
	if ( ! is_user_logged_in() && isset( $_REQUEST['author'] ) ) {
                if ( preg_match( '/^[0-9]+$/', $_REQUEST['author'] ) ) {
                        wp_die( "Author requests are not allowed.", 403 );
                }
        }
});