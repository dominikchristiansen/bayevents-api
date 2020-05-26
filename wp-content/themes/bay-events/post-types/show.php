<?php

/**
 * Registers the `show` post type.
 */
function show_init() {
	register_post_type( 'show', array(
		'labels'                => array(
			'name'                  => __( 'Shows', 'bay-events' ),
			'singular_name'         => __( 'Show', 'bay-events' ),
			'all_items'             => __( 'All Shows', 'bay-events' ),
			'archives'              => __( 'Show Archives', 'bay-events' ),
			'attributes'            => __( 'Show Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into show', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this show', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'show', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'show', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'show', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'show', 'bay-events' ),
			'filter_items_list'     => __( 'Filter shows list', 'bay-events' ),
			'items_list_navigation' => __( 'Shows list navigation', 'bay-events' ),
			'items_list'            => __( 'Shows list', 'bay-events' ),
			'new_item'              => __( 'New Show', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Show', 'bay-events' ),
			'edit_item'             => __( 'Edit Show', 'bay-events' ),
			'view_item'             => __( 'View Show', 'bay-events' ),
			'view_items'            => __( 'View Shows', 'bay-events' ),
			'search_items'          => __( 'Search shows', 'bay-events' ),
			'not_found'             => __( 'No shows found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No shows found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Show:', 'bay-events' ),
			'menu_name'             => __( 'Shows', 'bay-events' ),
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
		'rest_base'             => 'show',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'show_init' );

/**
 * Sets the post updated messages for the `show` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `show` post type.
 */
function show_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['show'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Show updated. <a target="_blank" href="%s">View show</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Show updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Show restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Show published. <a href="%s">View show</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Show saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Show submitted. <a target="_blank" href="%s">Preview show</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Show scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview show</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Show draft updated. <a target="_blank" href="%s">Preview show</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'show_updated_messages' );
