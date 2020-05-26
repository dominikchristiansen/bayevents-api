<?php

/**
 * Registers the `teamevent` post type.
 */
function teamevent_init() {
	register_post_type( 'teamevent', array(
		'labels'                => array(
			'name'                  => __( 'Teamevents', 'bay-events' ),
			'singular_name'         => __( 'Teamevent', 'bay-events' ),
			'all_items'             => __( 'All Teamevents', 'bay-events' ),
			'archives'              => __( 'Teamevent Archives', 'bay-events' ),
			'attributes'            => __( 'Teamevent Attributes', 'bay-events' ),
			'insert_into_item'      => __( 'Insert into teamevent', 'bay-events' ),
			'uploaded_to_this_item' => __( 'Uploaded to this teamevent', 'bay-events' ),
			'featured_image'        => _x( 'Featured Image', 'teamevent', 'bay-events' ),
			'set_featured_image'    => _x( 'Set featured image', 'teamevent', 'bay-events' ),
			'remove_featured_image' => _x( 'Remove featured image', 'teamevent', 'bay-events' ),
			'use_featured_image'    => _x( 'Use as featured image', 'teamevent', 'bay-events' ),
			'filter_items_list'     => __( 'Filter teamevents list', 'bay-events' ),
			'items_list_navigation' => __( 'Teamevents list navigation', 'bay-events' ),
			'items_list'            => __( 'Teamevents list', 'bay-events' ),
			'new_item'              => __( 'New Teamevent', 'bay-events' ),
			'add_new'               => __( 'Add New', 'bay-events' ),
			'add_new_item'          => __( 'Add New Teamevent', 'bay-events' ),
			'edit_item'             => __( 'Edit Teamevent', 'bay-events' ),
			'view_item'             => __( 'View Teamevent', 'bay-events' ),
			'view_items'            => __( 'View Teamevents', 'bay-events' ),
			'search_items'          => __( 'Search teamevents', 'bay-events' ),
			'not_found'             => __( 'No teamevents found', 'bay-events' ),
			'not_found_in_trash'    => __( 'No teamevents found in trash', 'bay-events' ),
			'parent_item_colon'     => __( 'Parent Teamevent:', 'bay-events' ),
			'menu_name'             => __( 'Teamevents', 'bay-events' ),
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
		'rest_base'             => 'teamevent',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'teamevent_init' );

/**
 * Sets the post updated messages for the `teamevent` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `teamevent` post type.
 */
function teamevent_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['teamevent'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Teamevent updated. <a target="_blank" href="%s">View teamevent</a>', 'bay-events' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bay-events' ),
		3  => __( 'Custom field deleted.', 'bay-events' ),
		4  => __( 'Teamevent updated.', 'bay-events' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Teamevent restored to revision from %s', 'bay-events' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Teamevent published. <a href="%s">View teamevent</a>', 'bay-events' ), esc_url( $permalink ) ),
		7  => __( 'Teamevent saved.', 'bay-events' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Teamevent submitted. <a target="_blank" href="%s">Preview teamevent</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Teamevent scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview teamevent</a>', 'bay-events' ),
		date_i18n( __( 'M j, Y @ G:i', 'bay-events' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Teamevent draft updated. <a target="_blank" href="%s">Preview teamevent</a>', 'bay-events' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'teamevent_updated_messages' );

add_filter( 'rest_prepare_teamevent', 'get_team_content', 12, 3 );
function get_team_content( $response, $post_type, $request ) {
  // return $response;
  return [
    'type' => $response->data['acf']['type'],
    'id' => $response->data['id'],
    'slug' => $response->data['slug'],
    'title' => $response->data['title']['rendered'],
    'headline' => $response->data['acf']['info']['headline'],
    'description' => $response->data['acf']['info']['description'],
    'gallery' => getSlidesArray($response->data['acf']['gallery'])
  ];
}

add_action('rest_api_init', function () {
	register_rest_route('/api/', 'teamevent/entdecken', [
			'methods' => 'GET',
			'callback' => 'get_teamevent_by_type_entdecken',
	]);
});

function get_teamevent_by_type_entdecken () {
	$posts = new WP_REST_Request( 'GET', '/wp/v2/teamevent' );
	$posts = rest_do_request( $posts );
	// $arr = 
	// foreach ($posts as $post) {
	// 	if ( get_fields($post->ID)['type'] === 'entdecken' ) {
	// 		$arr = $this->prepare_item_for_response($post);
	// 		// $arr = [
	// 		// 	'id' => $post->data['id'],
	// 		// 	'slug' => $post->data['slug'],
	// 		// 	'title' => $post->data['title']['rendered'],
	// 		// 	'headline' => $post->data['acf']['info']['headline'],
	// 		// 	'description' => $post->data['acf']['info']['description'],
	// 		// 	'gallery' => getSlidesArray($post->data['acf']['gallery'])
	// 		// ];
	// 	}
	// 	array_push($data, $arr);
	// }
	return $posts;
}