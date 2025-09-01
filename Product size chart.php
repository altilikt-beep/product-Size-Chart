add_action('woocommerce_single_product_summary', 'wpb_size_guide_by_category', 15);
function wpb_size_guide_by_category() {
    global $product;

    if (!$product) return;

    $product_id = $product->get_id();

    // ✅ Category → Chart ID Mapping
    $charts = array(
        'men','men-tights-winter'      => '23677',  // Category slug => Chart ID
        'men','men-round-neck-winter'    => '23673',
		'men','men-high-neck'          => '23673',
		'men','men-round-neck-summer'    => '23673',
	    'boys','boys-high-neck'    => '23673',
		'boys','boys-round-neck-summer'    => '23673',
		'boys','boys-round-neck-winter'     => '23673',
		'boys','boys-tights-winter'      => '23677',
        'women','women-accessories'     => '23682',
		'women','women-tights-winter'      => '23677',
		'women','women-round-neck-summer'      => '23683',
		'women','women-tights-summer'      => '23677',
		'women','women-round-neck-winter'      => '23683',
		'girls','girls-round-neck-summer'      => '23673',
		'girls','girls-round-neck-winter'      => '23673',
		'girls','girls-high-neck'      => '23673',
		'girls','girls-tights-summer'      => '23677',
		'girls','girls-tights-winter'      => '23677',
		'toddler','toddler-thermals'      => '23688',
		'toddler','toddler-high-neck'    => '23673',
		'toddler','toddler-round-neck-summer'    => '23673',
		'toddler','toddler-round-neck-winter'    => '23673',
		 'toddler','toddler-tights-summer'      => '23677',
		 'toddler','toddler-tights-winter'      => '23677',
		'infants'      => '23687',
		 'infant','infant-high-neck'    => '23673',
		 'infant','infant-round-neck-summer'    => '23673',
		 'infant','infant-round-neck-winter'    => '23673',
		 'infant','infant-tights-summer'    => '23677',
		 'infant','infant-tights-winter'    => '23677',
		'women'     => '23677',
        'women','women-high-neck' => '23673'
    );

    // ✅ Get product categories
    $terms = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));

    // ✅ Loop through mapping and check if product has that category
    foreach ($charts as $cat_slug => $chart_id) {
        if (in_array($cat_slug, $terms)) {
            echo '<div class="size-guide-container" style="margin: 15px 0;">';
            echo do_shortcode('[wpb-product-size-chart size_id="' . esc_attr($chart_id) . '" post_id="' . esc_attr($product_id) . '" button_text="Size Guide"]');
            echo '</div>';
            break; // Stop after first match
        }
    }
}
