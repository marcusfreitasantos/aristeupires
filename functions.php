<?php
function oceanwp_child_enqueue_parent_style() {

	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/css/bootstrap.min.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/fontawesome.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/regular.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/brands.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/solid.css',array(), $version );

	wp_enqueue_script( 'bootstrap-main-script', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/js/bootstrap.min.js', array(), $version );
	wp_enqueue_script( 'bootstrap-bundle-script', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/js/bootstrap.bundle.min.js', array(), $version );
	wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/scripts.js', array(), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );



global $emailHeaders;
$emailHeaders = array(
	'Content-Type: text/html; charset=UTF-8',
	'Reply-To: Blessy <suporte@blessyapp.com>',
);


function redirectUserAfterLogin( $redirectTo, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return admin_url();
		} else {
			return site_url() . '/wp-admin/edit.php?post_type=event';
		}
	} else {
		return $redirectTo;
	}
}

//add_filter( 'login_redirect', 'redirectUserAfterLogin', 10, 3 );


?>
