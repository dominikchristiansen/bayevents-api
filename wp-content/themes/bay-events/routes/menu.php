<?php
function get_menu()
{
    $wpmenu = wp_get_nav_menu_items('menu');
    $menu = [];

    function getSubmenu($wpmenu, $id)
    {
        $submenu = [];
        foreach ($wpmenu as $sub) {
            if ($sub->menu_item_parent == $id) {
                $submenu[] = [
                    'id' => $sub->ID,
                    'title' => $sub->title,
                    'url' => $sub->url
                ];
            }
        }
        return $submenu;
    }

    foreach ($wpmenu as $item) {
        if (empty($item->menu_item_parent)) {
            $menu[] = [
                'id' => $item->ID,
                'title' => $item->title,
                'url' => $item->url,
                'children' => getSubmenu($wpmenu, $item->ID)
            ];
        }
    }

    return $menu;
}

add_action('rest_api_init', function () {
    register_rest_route('/api/', 'menu', [
        'methods' => 'GET',
        'callback' => 'get_menu',
    ]);
});
