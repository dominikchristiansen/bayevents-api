<?php

/**
 * Registers the `concept` post type.
 */
function concept_init() {
	register_post_type( 'concept', array(
		'labels'                => array(
			'name'                  => __( 'Concepts', 'bay-events' ),
			'singular_name'         => __( 'Concept', 'bay-events' ),
			'all_items'             => __( 'All Concepts', 'bay-events' ),
			'archives'              => __( 'Concept Archives', 'bay-events' ),
			'attributes'            => __( 'Concept Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into concept', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this concept', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'concept', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'concept', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'concept', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'concept', 'bay-events' ),
			'filter_items_list'     => __( 'Filter concepts list', 'bay-events' ),
			'items_list_navigation' => __( 'Concepts list navigation', 'bay-events' ),
			'items_list'            => __( 'Concepts list', 'bay-events' ),
			'new_item'              => __( 'New Concept', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Concept', 'bay-events' ),
			'edit_item'             => __( 'Edit Concept', 'bay-events' ),
			'view_item'             => __( 'View Concept', 'bay-events' ),
			'view_items'            => __( 'View Concepts', 'bay-events' ),
			'search_items'          => __( 'Search concepts', 'bay-events' ),
			'not_found'             => __( 'No concepts found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No concepts found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Concept:', 'bay-events' ),
			'menu_name'             => __( 'Concepts', 'bay-events' ),
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
		'rest_base'             => 'concept',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'concept_init' );

/**
 * Sets the post updated messages for the `concept` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `concept` post type.
 */
function concept_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['concept'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Concept updated. <a target="_blank" href="%s">View concept</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Concept updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Concept restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Concept published. <a href="%s">View concept</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Concept saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Concept submitted. <a target="_blank" href="%s">Preview concept</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Concept scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview concept</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Concept draft updated. <a target="_blank" href="%s">Preview concept</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'concept_updated_messages' );
