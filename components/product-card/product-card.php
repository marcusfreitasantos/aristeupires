<?php function ProductCard($product){
    ob_start();  
    $siteUrl = site_url();
    $productImage = get_the_post_thumbnail($product->id, 'full');
    $productCat = getProductCategories();
    ?>
        <div class="product__card">
            <a class="product__img" href=<?php echo "$siteUrl/produto/$product->slug";?>>
                <?php echo $productImage; ?>
                <div class="product__card_img_btn">
                    <span>Veja mais</span>
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </a>

            <div class="product__card_info d-flex flex-column text-center">
                <a href=<?php echo "$siteUrl/produto/$product->slug";?> class="product__title">
                    <?php echo $product->name; ?>
                </a>

                <?php foreach(getProductCategories($product->category_ids) as $productCat){ ?>
                    <a href=<?php echo "$siteUrl/categoria-produto/$productCat->slug";?> class="product__category">
                        <?php echo $productCat->name; ?>
                    </a>
                <?php } ?>
            </div>
        </div>

    <?php
    return ob_get_clean();

} ?>