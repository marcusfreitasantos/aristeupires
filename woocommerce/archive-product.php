<?php get_header(); ?>
<?php $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; ?>
<?php $mainImage = get_field("main_image", 7); ?>
<?php $productCats = getProductCategories(); ?>

<?php if($mainImage) { ?>
    <section>
        <img class="img-fluid h-100 w-100" src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['alt'] ?>" />
    </section>
<?php } ?>


<section id="produtos" class="section_products">
    <div class="container">
        <h2 class="section__title text-center">Produtos</h2>

        <div class="">
            <?php foreach($productCats as $cat){ ?>
                <span><?php echo $cat->name; ?></span>
           <?php } ?>
        </div>
        <div class="row">
            <?php 
            $getProductsArgs = array(
                'limit'     => 8,
                'status'    => 'publish',
                'page'      => $currentPage,
                'paginate'  => true
            );
            $products = wc_get_products( $getProductsArgs );
            
            $totalProducts = $products->total;
            $maxNumPages = $products->max_num_pages;

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

        <div>
            <a href=""></a>
        </div>
    </div>   
</section>

<?php get_footer(); ?>