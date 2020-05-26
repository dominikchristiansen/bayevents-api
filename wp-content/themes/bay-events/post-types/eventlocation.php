<?php

/**
 * Registers the `eventlocation` post type.
 */
function eventlocation_init() {
	register_post_type( 'eventlocation', array(
		'labels'                => array(
			'name'                  => __( 'Eventlocations', 'bay-events' ),
			'singular_name'         => __( 'Eventlocation', 'bay-events' ),
			'all_items'             => __( 'All Eventlocations', 'bay-events' ),
			'archives'              => __( 'Eventlocation Archives', 'bay-events' ),
			'attributes'            => __( 'Eventlocation Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into eventlocation', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this eventlocation', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'eventlocation', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'eventlocation', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'eventlocation', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'eventlocation', 'bay-events' ),
			'filter_items_list'     => __( 'Filter eventlocations list', 'bay-events' ),
			'items_list_navigation' => __( 'Eventlocations list navigation', 'bay-events' ),
			'items_list'            => __( 'Eventlocations list', 'bay-events' ),
			'new_item'              => __( 'New Eventlocation', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Eventlocation', 'bay-events' ),
			'edit_item'             => __( 'Edit Eventlocation', 'bay-events' ),
			'view_item'             => __( 'View Eventlocation', 'bay-events' ),
			'view_items'            => __( 'View Eventlocations', 'bay-events' ),
			'search_items'          => __( 'Search eventlocations', 'bay-events' ),
			'not_found'             => __( 'No eventlocations found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No eventlocations found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Eventlocation:', 'bay-events' ),
			'menu_name'             => __( 'Eventlocations', 'bay-events' ),
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
		'rest_base'             => 'eventlocation',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'eventlocation_init' );

/**
 * Sets the post updated messages for the `eventlocation` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `eventlocation` post type.
 */
function eventlocation_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['eventlocation'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Eventlocation updated. <a target="_blank" href="%s">View eventlocation</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Eventlocation updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Eventlocation restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Eventlocation published. <a href="%s">View eventlocation</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Eventlocation saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Eventlocation submitted. <a target="_blank" href="%s">Preview eventlocation</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Eventlocation scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview eventlocation</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Eventlocation draft updated. <a target="_blank" href="%s">Preview eventlocation</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'eventlocation_updated_messages' );
