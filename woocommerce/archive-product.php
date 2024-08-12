<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>
<?php $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; ?>
<?php $mainImage = get_field("main_image", 7); ?>
<?php $productCats = getProductCategories(); ?>
<?php 
    $currentCategories = [];

    if(is_product_category()){
        $term = get_queried_object();
        $currentCategories[] = $term->slug;
    };
?>
<?php
    $getProductsArgs = array(
        'limit'     => 8,
        'status'    => 'publish',
        'page'      => $currentPage,
        'paginate'  => true,
        'category'  => $currentCategories
    );
    $products = wc_get_products( $getProductsArgs );
    
    $totalProducts = $products->total;
    $maxNumPages = $products->max_num_pages;
?>

<?php if($mainImage) { ?>
    <section>
        <img class="img-fluid h-100 w-100" src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['alt'] ?>" />
    </section>
<?php } ?>


<section id="produtos" class="section_products">
    <div class="container">
        <h2 class="section__title text-center">Produtos</h2>
        <hr/>

        <div class="products__cat_wrapper">
            <a class="products__cat_link <?php echo empty($currentCategories) ? 'active-link' : ''; ?>" href="<?php echo "$siteUrl/loja" ?>">Todos os produtos</a>
            <?php foreach($productCats as $cat){ ?>
                <a class="products__cat_link <?php echo in_array($cat->slug, $currentCategories) ? 'active-link' : ''; ?>" href="<?php echo "$siteUrl/categoria-produto/$cat->slug"; ?>"><?php echo $cat->name; ?></a>
           <?php } ?>
        </div>
        <div class="row">
            <?php
            if($products->products){
                foreach($products->products as $product){  
                ?>
                    <div class="col-md-3 mb-5">
                        <?php echo ProductCard($product); ?>
                    </div>
                <?php }
            }else{ ?>
                <div  class="col-12 text-center p-5">
                    <span>Nada encontrado.</span>
                </div>
            <?php } ?>
        </div>

        <?php if($maxNumPages > 1){ ?>
            <div class="products__pagination_wrapper w-100 d-flex justify-content-center align-items-center">
                <?php if($currentPage > 1){ ?>
                    <a class="products__pagination_next" href="http://localhost/aristeu-pires/loja/?page=<?php echo  (int) $currentPage - 1; ?>">
                        <i class="fa-solid fa-chevron-left"></i>    
                        <span>Anterior</span>
                    </a>
                <?php } ?>


                <?php if($currentPage < $maxNumPages){ ?>
                    <a class="products__pagination_next" href="http://localhost/aristeu-pires/loja/?page=<?php echo  (int) $currentPage + 1; ?>">
                        <span>Próximo</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>   
</section>

<?php get_footer(); ?>