/**
 * Security by obscurity:
 * Try to hide obvious hints about the WordPress release.
 *
 * There are, however, various other ways of recognising the version, if someone has the time and interest.
 */

add_filter( 'the_generator', '__return_null'  );

add_action( 'init', function() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wpex_theme_meta_generator', 1 );
}, 10 );

/**
 * Replace the version number in a way caching and
 * cache replacement is still possible, e.g.
 * theme.css?ver=5.9.1
 * to theme.css?ver=8bf50f91
 *
 * Note that dozens of other plugins might have their
 * own ver=xy way and allow fingerprinting.
 */
function mask_version_from_assets( $src ) {
	$wp_version_string = 'ver='.get_bloginfo( 'version' );
	if ( strpos( $src, $wp_version_string ) ) {
		$version_hash = hash( 'crc32', \NONCE_SALT . $wp_version_string );
		$src = str_replace( $wp_version_string, 'ver='.$version_hash, $src );
	}
	return $src;
}

// Filters an enqueued style’s fully-qualified URL.
add_filter( 'style_loader_src', 'mask_version_from_assets', 9999 );
// Filters the script loader source.
add_filter( 'script_loader_src', 'mask_version_from_assets', 9999 );