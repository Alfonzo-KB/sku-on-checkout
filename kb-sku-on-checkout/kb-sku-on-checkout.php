<?php
/**
* Plugin Name:  Kimber SKU on Checkout
* Description: Display Product SKU on Checkout
* Version: 1.0
* Requires PHP:      7.4
* Author: Kegan Black
*/

function kb_echo_sku_info($cart_item, $cart_item_key){
    $variation_id = $cart_item['variation_id'];
    if ($variation_id){
        $product = wc_get_product( $cart_item['variation_id']);
    }else{
        $product = wc_get_product( $cart_item['product_id']);
    }
    $sku = "SKU: ". $product->get_sku();
    ?> <p class="product-sku"><?php echo $sku ?> </p> <?php
}

add_filter( 'woocommerce_after_cart_item_name', 'kb_echo_sku_info', 10, 2 );

add_filter( 'woocommerce_checkout_cart_item_quantity', 'kb_add_sku_checkout', 1, 3 );
function kb_add_sku_checkout($quantity, $cart_item, $cart_item_key){
    kb_echo_sku_info($cart_item, $cart_item_key);
}