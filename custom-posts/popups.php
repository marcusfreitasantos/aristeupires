<?php
function registerPopupPostType() {
    $labels = array(
     'name' => _x( 'Popups', 'post type general name' ),
     'singular_name' => _x( 'Popup', 'post type singular name' ),
     'add_new' => 'Add Popup',
     'add_new_item' => 'Novo popup'
  );

  $args = array(
    'labels' => $labels,
    'description' => 'General popups',
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'has_archive' => false

  );

  register_post_type( 'popup', $args );
}
add_action( 'init', 'registerPopupPostType' );
