<?php
require_once dirname(__FILE__) . '/../../../../wp-load.php';

$products = [
    [
        'title' => 'Calacatta Vecchia Ceramic Penny Mosaic',
        'price' => '8.39',
        'brand' => 'SAN GIORGIO',
        'size' => '11 x 13',
        'unit' => 'piece'
    ],
    [
        'title' => 'Seaside Polished Ceramic Tile',
        'price' => '2.69',
        'brand' => 'VILLA',
        'size' => '4 x 16',
        'unit' => 'piece'
    ],
    [
        'title' => 'Grand Oak Waterproof Laminate Plank',
        'price' => '1.99',
        'brand' => 'HYDROSHIELD PLUS',
        'size' => '10mm x 7in x 50in',
        'unit' => 'sqft'
    ],
    [
        'title' => 'Phoenix Sand Matte Porcelain Tile',
        'price' => '1.99',
        'brand' => 'CASTILLE',
        'size' => '12 x 24',
        'unit' => 'sqft'
    ]
];

foreach ($products as $p) {
    $post_id = wp_insert_post(array(
        'post_title' => $p['title'],
        'post_type' => 'product',
        'post_status' => 'publish'
    ));

    wp_set_object_terms($post_id, 'simple', 'product_type');
    update_post_meta($post_id, '_visibility', 'visible');
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, 'total_sales', '0');
    update_post_meta($post_id, '_downloadable', 'no');
    update_post_meta($post_id, '_virtual', 'no');
    update_post_meta($post_id, '_regular_price', $p['price']);
    update_post_meta($post_id, '_price', $p['price']);
    
    // Custom meta
    update_post_meta($post_id, '_product_brand', $p['brand']);
    update_post_meta($post_id, '_product_size', $p['size']);
    update_post_meta($post_id, '_product_unit', $p['unit']);
    
    echo "Created: " . $p['title'] . "\n";
}
