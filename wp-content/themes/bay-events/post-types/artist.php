<?php

/**
 * Registers the `artist` post type.
 */
function artist_init() {
	register_post_type( 'artist', array(
		'labels'                => array(
			'name'                  => __( 'Artists', 'bay-events' ),
			'singular_name'         => __( 'Artist', 'bay-events' ),
			'all_items'             => __( 'All Artists', 'bay-events' ),
			'archives'              => __( 'Artist Archives', 'bay-events' ),
			'attributes'            => __( 'Artist Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into artist', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this artist', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'artist', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'artist', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'artist', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'artist', 'bay-events' ),
			'filter_items_list'     => __( 'Filter artists list', 'bay-events' ),
			'items_list_navigation' => __( 'Artists list navigation', 'bay-events' ),
			'items_list'            => __( 'Artists list', 'bay-events' ),
			'new_item'              => __( 'New Artist', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Artist', 'bay-events' ),
			'edit_item'             => __( 'Edit Artist', 'bay-events' ),
			'view_item'             => __( 'View Artist', 'bay-events' ),
			'view_items'            => __( 'View Artists', 'bay-events' ),
			'search_items'          => __( 'Search artists', 'bay-events' ),
			'not_found'             => __( 'No artists found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No artists found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Artist:', 'bay-events' ),
			'menu_name'             => __( 'Artists', 'bay-events' ),
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
		'rest_base'             => 'artist',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'artist_init' );

/**
 * Sets the post updated messages for the `artist` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `artist` post type.
 */
function artist_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['artist'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Artist updated. <a target="_blank" href="%s">View artist</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Artist updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Artist restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Artist published. <a href="%s">View artist</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Artist saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Artist submitted. <a target="_blank" href="%s">Preview artist</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Artist scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview artist</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Artist draft updated. <a target="_blank" href="%s">Preview artist</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'artist_updated_messages' );
