<?php

/**
 * Registers the `tagungslocation` post type.
 */
function tagungslocation_init() {
	register_post_type( 'tagungslocation', array(
		'labels'                => array(
			'name'                  => __( 'Tagungslocations', 'bay-events' ),
			'singular_name'         => __( 'Tagungslocation', 'bay-events' ),
			'all_items'             => __( 'All Tagungslocations', 'bay-events' ),
			'archives'              => __( 'Tagungslocation Archives', 'bay-events' ),
			'attributes'            => __( 'Tagungslocation Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into tagungslocation', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this tagungslocation', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'tagungslocation', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'tagungslocation', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'tagungslocation', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'tagungslocation', 'bay-events' ),
			'filter_items_list'     => __( 'Filter tagungslocations list', 'bay-events' ),
			'items_list_navigation' => __( 'Tagungslocations list navigation', 'bay-events' ),
			'items_list'            => __( 'Tagungslocations list', 'bay-events' ),
			'new_item'              => __( 'New Tagungslocation', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Tagungslocation', 'bay-events' ),
			'edit_item'             => __( 'Edit Tagungslocation', 'bay-events' ),
			'view_item'             => __( 'View Tagungslocation', 'bay-events' ),
			'view_items'            => __( 'View Tagungslocations', 'bay-events' ),
			'search_items'          => __( 'Search tagungslocations', 'bay-events' ),
			'not_found'             => __( 'No tagungslocations found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No tagungslocations found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Tagungslocation:', 'bay-events' ),
			'menu_name'             => __( 'Tagungslocations', 'bay-events' ),
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
		'rest_base'             => 'tagungslocation',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'tagungslocation_init' );

/**
 * Sets the post updated messages for the `tagungslocation` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `tagungslocation` post type.
 */
function tagungslocation_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['tagungslocation'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Tagungslocation updated. <a target="_blank" href="%s">View tagungslocation</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Tagungslocation updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Tagungslocation restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Tagungslocation published. <a href="%s">View tagungslocation</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Tagungslocation saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Tagungslocation submitted. <a target="_blank" href="%s">Preview tagungslocation</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Tagungslocation scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview tagungslocation</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Tagungslocation draft updated. <a target="_blank" href="%s">Preview tagungslocation</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'tagungslocation_updated_messages' );
