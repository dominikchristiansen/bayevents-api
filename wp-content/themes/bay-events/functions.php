<?php
$product_types = ['teamevent', 'concept', 'hotel', 'tagungslocation', 'eventlocation', 'show', 'artist'];

require get_template_directory() . '/routes/menu.php';
require get_template_directory() . '/routes/pages.php';

foreach ($product_types as $type) {
    require get_template_directory() . '/post-types/' . $type . '.php';
}

function menus()
{
    $locations = [
        'primary' => __('Desktop Horizontal Menu', 'twentytwenty'),
        'expanded' => __('Desktop Expanded Menu', 'twentytwenty'),
        'mobile' => __('Mobile Menu', 'twentytwenty'),
        'footer' => __('Footer Menu', 'twentytwenty'),
        'social' => __('Social Menu', 'twentytwenty'),
    ];

    register_nav_menus($locations);
}

add_action('init', 'menus');

add_theme_support('post-thumbnails');

//disable gutenberg editor
add_filter( 'use_block_editor_for_post', '__return_false' );

// enable featured image for rest
add_action('rest_api_init', 'register_rest_images');
function register_rest_images()
{
    register_rest_field(
        ['page'],
        'featured_image_url',
        [
            'get_callback' => 'get_rest_featured_image',
            'update_callback' => null,
            'schema' => null,
        ]
    );
}
function get_rest_featured_image($object, $field_name, $request)
{
    if ($object['featured_media']) {
        $img = wp_get_attachment_image_src($object['featured_media'], 'app-thumb');
        return $img[0];
    }
    return false;
}

// add svg support in media library
function add_svg($svg_mime)
{
    $svg_mime['svg'] = 'image/svg+xml';
    return $svg_mime;
}
add_filter('upload_mimes', 'add_svg');

add_action('rest_api_init', function () {
    register_rest_route('/api/', 'product-pages', [
        'methods' => 'GET',
        'callback' => 'get_product_pages',
    ]);
});

function get_product_pages()
{
    $pages = [];
    foreach ($GLOBALS['product_types'] as $posttype) {
        $posttype_data = get_post_type_object($posttype);
        $posts = get_posts(['post_type' => $posttype, 'numberposts' => 8]);
        foreach ($posts as $post) {
            $arr = [
                'label' => $posttype_data->label,
                'id' => $post->ID,
                'slug' => $post->post_name,
                'image' => get_fields($post->ID)['gallery'][0]['sizes']['large'],
                'name' => get_fields($post->ID)['info']['name'],
                'post_type' => $post->post_type
            ];

            array_push($pages, $arr);
        }
    }

    return $pages;
}


function getSlidesArray ($slider) {
    $arr = null;
    if (!empty($slider)) {
      foreach ( $slider as $slide ) {
        $arr[] = [
          'name' => $slide['name'],
          'url' => $slide['sizes']['2048x2048'],
        ];
      }
    }
    return $arr;
  }