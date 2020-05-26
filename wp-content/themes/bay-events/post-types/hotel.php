<?php

/**
 * Registers the `hotel` post type.
 */
function hotel_init() {
	register_post_type( 'hotel', array(
		'labels'                => array(
			'name'                  => __( 'Hotels', 'bay-events' ),
			'singular_name'         => __( 'Hotel', 'bay-events' ),
			'all_items'             => __( 'All Hotels', 'bay-events' ),
			'archives'              => __( 'Hotel Archives', 'bay-events' ),
			'attributes'            => __( 'Hotel Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into hotel', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this hotel', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'hotel', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'hotel', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'hotel', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'hotel', 'bay-events' ),
			'filter_items_list'     => __( 'Filter hotels list', 'bay-events' ),
			'items_list_navigation' => __( 'Hotels list navigation', 'bay-events' ),
			'items_list'            => __( 'Hotels list', 'bay-events' ),
			'new_item'              => __( 'New Hotel', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Hotel', 'bay-events' ),
			'edit_item'             => __( 'Edit Hotel', 'bay-events' ),
			'view_item'             => __( 'View Hotel', 'bay-events' ),
			'view_items'            => __( 'View Hotels', 'bay-events' ),
			'search_items'          => __( 'Search hotels', 'bay-events' ),
			'not_found'             => __( 'No hotels found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No hotels found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Hotel:', 'bay-events' ),
			'menu_name'             => __( 'Hotels', 'bay-events' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'hotel',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'hotel_init' );

/**
 * Sets the post updated messages for the `hotel` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `hotel` post type.
 */
function hotel_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['hotel'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Hotel updated. <a target="_blank" href="%s">View hotel</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Hotel updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Hotel restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Hotel published. <a href="%s">View hotel</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Hotel saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Hotel submitted. <a target="_blank" href="%s">Preview hotel</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Hotel scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview hotel</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Hotel draft updated. <a target="_blank" href="%s">Preview hotel</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'hotel_updated_messages' );
