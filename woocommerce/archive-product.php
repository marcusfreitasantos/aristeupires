<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>
<?php $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; ?>
<?php $mainImage = get_field("main_image", 7); ?>
<?php $productCats = getProductCategories(); ?>
<?php $productsPage = get_permalink( wc_get_page_id( 'shop' ) ); ?>
<?php 
    global $currentCategories;
    $currentCategories = [];

    if(is_product_category()){
        $term = get_queried_object();
        $currentCategories[] = $term->slug;
    };
?>
<?php
    $getProductsArgs = array(
        'limit'     => 9,
        'status'    => 'publish',
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
        'page'      => $currentPage,
        'paginate'  => true,
        'category'  => $currentCategories
    );
    $products = wc_get_products( $getProductsArgs );
    $productCount = count($products->products);

?>

<?php
    function definePaginationUrlStructure(){
        global $currentCategories;
        $paginationUrlPrefix = get_permalink( wc_get_page_id( 'shop' ) );
        
        if(!empty($currentCategories)){
            $paginationUrlPrefix = site_url() . "/categoria-produto/" . $currentCategories[0];
        }

        return $paginationUrlPrefix;
    }
?>

<?php if($mainImage) { ?>
    <section class="product__page_header">
        <img id="product__page_header_img" src="<?php echo $mainImage['url'] ?>" alt="<?php echo $mainImage['alt'] ?>" />
    </section>
<?php } ?>


<section id="produtos" class="section_products">
    <div class="container">
        <h2 class="section__title text-center">Produtos</h2>
        <hr/>

        <div class="products__cat_wrapper">
            <a class="products__cat_link <?php echo empty($currentCategories) ? 'active-link' : ''; ?>" href="<?php echo $productsPage; ?>">Todos</a>
            <?php foreach($productCats as $cat){ ?>
                <a class="products__cat_link <?php echo in_array($cat->slug, $currentCategories) ? 'active-link' : ''; ?>" href="<?php echo "$siteUrl/categoria-produto/$cat->slug"; ?>"><?php echo $cat->name; ?></a>
           <?php } ?>
        </div>
        <div class="row gx-5" id="products__list">
            <?php
            if($products->products){
                foreach($products->products as $product){  
                ?>
                    <div class="col-md-4 mb-5">
                        <?php echo ProductCard($product); ?>
                    </div>
                <?php }
            }else{ ?>
                <div  class="col-12 text-center p-5">
                    <span>Nada encontrado.</span>
                </div>
            <?php } ?>
        </div>


        <?php if($productCount >= 9){ ?>
            <div class="col-12 text-center py-5 my-5 d-block">
                <span class="custom__loader"></span>
    
                <span class="loadmore__btn">
                    <span>Ver mais produtos</span>
                </span>
            </div>
        <?php } ?>
    </div>   
</section>

<?php get_footer(); ?>