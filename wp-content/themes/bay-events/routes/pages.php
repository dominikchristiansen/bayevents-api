<?php
add_filter( 'rest_prepare_page', 'get_page_content', 12, 3 );
function get_page_content( $response, $post_type, $request ) {
  // return $response;
  return [
    'id' => $response->data['id'],
    'slug' => $response->data['slug'],
    'title' => $response->data['title']['rendered'],
    'headline' => $response->data['acf']['headline'],
    'content' => $response->data['content']['rendered'],
    'excerpt' => $response->data['excerpt']['rendered'],
    'order' => $response->data['menu_order'],
    'slider' => getSlidesArray($response->data['acf']['slider']),
    'acf' => get_fields($response->data['id'])
  ];
}
