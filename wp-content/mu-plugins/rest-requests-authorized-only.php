<?php
/**
 * Do only allow authorized users or clients to use the REST API
 * ... well but don't break functionality of some plugins that
 * depend on the API.
 */
add_filter(
	'rest_authentication_errors',
	function ( $result ) {

		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$req_uri = wp_unslash( $_SERVER['REQUEST_URI'] );

			/**
			 * Do a greater-than-strpos-check as WordPress might be
			 * installed in a subdirectory.
			 */

			/** Allow FacetWP calls */
			if ( false !== strpos( $req_uri, '/wp-json/facetwp/v1/refresh' ) ) {
				return $result;
			}
			/** Allow Contact Form 7 calls */
			if ( false !== strpos( $req_uri, '/wp-json/contact-form-7/' ) ) {
				return $result;
			}
		}

		if ( ! is_user_logged_in() ) {
			return new WP_Error(
				'rest_unauthorised',
				__( 'Only authenticated users can access the REST API.', 'rest_unauthorised' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}

		return $result;
	}
);
