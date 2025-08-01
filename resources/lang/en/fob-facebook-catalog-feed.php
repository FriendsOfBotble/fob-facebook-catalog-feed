<?php

return [
    'name' => 'Facebook Catalog Feed',
    'description' => 'Generate Facebook Catalog Feed XML for your products',
    
    'settings' => [
        'title' => 'Facebook Catalog Feed Settings',
        'feed_url_info' => 'Your Facebook Catalog Feed URL:',
        'feed_types_info' => 'You can also use specific feed types:',
        'all_products' => 'All products',
        'new_products' => 'New products (latest 100)',
        'featured_products' => 'Featured products only',
        'on_sale_products' => 'Products on sale',
        'enabled' => 'Enable Facebook Catalog Feed',
        'include_out_of_stock' => 'Include out of stock products',
        'include_variations' => 'Include product variations as separate items',
        'include_variations_help' => 'If enabled, each product variation will be listed as a separate item in the feed',
        'brand_attribute' => 'Default brand name',
        'brand_attribute_placeholder' => 'e.g. Your Store Name',
        'brand_attribute_help' => 'Used when products don\'t have a brand assigned',
        'condition' => 'Default product condition',
        'condition_new' => 'New',
        'condition_refurbished' => 'Refurbished',
        'condition_used' => 'Used',
        'availability_in_stock' => 'Availability text for in-stock items',
        'availability_out_of_stock' => 'Availability text for out-of-stock items',
        'in_stock' => 'In stock',
        'available_for_order' => 'Available for order',
        'preorder' => 'Preorder',
        'out_of_stock' => 'Out of stock',
        'discontinued' => 'Discontinued',
    ],
    
    'widget' => [
        'name' => 'Facebook Catalog Feed URL',
        'description' => 'Display Facebook Catalog Feed URL for easy access',
        'feed_url' => 'Feed URL',
        'copy_url' => 'Copy URL',
        'copied' => 'Copied!',
    ],
];