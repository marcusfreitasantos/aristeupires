<?php function ProductCard($product){
    ob_start();  
    $siteUrl = site_url();
    $productImage = get_the_post_thumbnail($product->id, 'full');
    $productCat = getProductCategories();
    $currencySymbol = get_woocommerce_currency_symbol();
    ?>
        <div class="product__card">
            <a class="product__img" href=<?php echo "$siteUrl/produto/$product->slug";?>>
                <?php echo $productImage; ?>
            </a>

            <div class="product__card_info d-flex flex-row justify-content-between align-items-center">
                <a href=<?php echo "$siteUrl/produto/$product->slug";?> class="product__title">
                    <?php echo $product->name; ?>
                </a>

                <span class="product__price">
                    a partir de: <?php echo    $currencySymbol . $product->get_price(); ?>
                </span>
            </div>
        </div>

    <?php
    return ob_get_clean();

} ?>