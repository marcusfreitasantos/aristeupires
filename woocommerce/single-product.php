<?php get_header(); ?>

<?php
global $product;
$product = new WC_product(get_the_id());
$productData = $product->get_data();
$attachmentIds = $product->get_gallery_image_ids();
$productImage = get_the_post_thumbnail($product->id, 'full');
$purchaseUrl = add_query_arg('add-to-cart', $product->id, wc_get_cart_url());

function checkIfCurrentProductIsMiniatura(){
    global $product;
    $productCats = getProductCategories($product->category_ids);

    foreach($productCats as $cat){
        if($cat->slug == "miniaturas"){
            return true;
        };
        return false;
    };
}
$isMiniature = checkIfCurrentProductIsMiniatura();


//ACFs
$headerImg = get_field("banner_field");
$productResources = get_field("links_with_icon");
$productCustomGallery = get_field("carousel_sliders");
$otherProducts = get_field("select_other_products");

$getProductsArgs = array(
    'status'    => 'publish',
    'include'   => $otherProducts
);
$otherProductsQuery = wc_get_products( $getProductsArgs );
?>

<style>
    body{
        padding: 0 !important;
    }
</style>

<?php if($headerImg){ ?>
    <section class="product__page_header">
        <img class="product__page_header_img" src="<?php echo $headerImg['url']; ?>" alt="<?php echo $headerImg['alt']; ?>" />
    </section>
<?php } ?>

<section class="product__page_nav">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="product__page_title"><?php echo the_title(); ?></h1>
            </div>

            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="product__page_nav_wrapper">
                    <a href="#product-info">
                        Geral
                    </a>

                    <a href="#product-resources">
                        Especificações
                    </a>

                    <a href="#product-gallery">
                        Galeria
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="product-info" class="bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php if($attachmentIds){ ?>
                    <div class="product__img_carousel w-100 position-relative">
                        <div class="swiper-wrapper">    
                            <?php foreach($attachmentIds as $attachmentId){
                                $productGalleryImageUrl = wp_get_attachment_url( $attachmentId );
                                ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo $productGalleryImageUrl; ?>" data-lightbox="product__img_carousel">                                        
                                            <img src="<?php echo $productGalleryImageUrl; ?>"  />
                                        </a>

                                    </div>
                            <?php } ?>    
                        </div>
    
                        <div class="swiper-button-prev" id="product__img_carousel_prev"></div>
                        <div class="swiper-button-next" id="product__img_carousel_next"></div>
                    </div>
                <?php }else{ ?>

                    <?php echo $productImage; ?>

                <?php } ?>
            </div>

            <?php if($productResources){ ?>
                <div class="col-md-6 product__resources_col">

                    <div class="product__resources_description">
                        <h2 class="section__title">Descrição</h2>

                        <div class="product__details">
                            <p><strong>A partir de: R$<?php echo $product->get_price(); ?></strong></p>
                            <?php echo wpautop($productData['short_description'], true ); ?>
                        </div>

                        <?php if($isMiniature) { ?>
                            <div class="product__details_purchase_btn_wrapper">
                                <a href="<?php echo $purchaseUrl; ?>" class="product__details_purchase_btn">
                                    Comprar Agora
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="product__resources__content">
                        <h2 class="section__title">Recursos</h2>
    
                        <div class="product__resources_wrapper row">
                            <?php foreach($productResources as $resource){ ?>
                                <div class="col-md-6 mb-4">
                                    <a class="product__resource_btn" href="<?php echo $resource['link'] ? $resource['link']['url'] : ''; ?>" target="_blank">
                                        <span class="product__resource_btn_title"><?php echo $resource['link'] ? $resource['link']['title'] : "Download"; ?></span>
                                        <span class="product__resource_btn_text"><?php echo $resource['small_description'] ? $resource['small_description'] : "Description"; ?></span>
                                    </a>
                                </div>    
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php if(!empty($productCustomGallery[0]["add_slider_image"])){ ?>
    <section class="product__gallery_section" id="product-gallery">
        <?php foreach($productCustomGallery as $gallery){ ?>
            <?php if($gallery['add_slider_image'] ){ ?>

                <div class="gallery__carousel">
                    <div class="swiper-wrapper">
                        <?php foreach($gallery['add_slider_image'] as $galleryImg){ ?>
                            <div class="swiper-slide">
                                <a href="<?php echo $galleryImg['url']; ?>" data-lightbox="product__gallery">
                                    <img src="<?php echo $galleryImg['url']; ?>"  />
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="swiper-button-prev" id="gallery__carousel_prev"></div>
                    <div class="swiper-button-next" id="gallery__carousel_next"></div>
                </div>
            <?php } ?>
        <?php } ?>        
    </section>
<?php } ?>

<?php if($otherProducts){ ?>
    <section class="other__products_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section__title">
                        Explore outros produtos
                    </h2>
                    <hr/>
                </div>
                
                <?php foreach($otherProductsQuery as $otherProduct){?>
                    <div class="col-md-4 mb-5">
                        <?php echo ProductCard($otherProduct); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>


<script>
    // SWIPER SLIDE
    const swiper = new Swiper(".product__img_carousel", {
        direction: "horizontal",
        loop: true,
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: "#product__img_carousel_next",
            prevEl: "#product__img_carousel_prev",
        },
    });

    const swiper2 = new Swiper(".gallery__carousel", {
        direction: "horizontal",
        loop: true,
        slidesPerView: 1,
        spaceBetween: 12,
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: "#gallery__carousel_next",
            prevEl: "#gallery__carousel_prev",
        },
        breakpoints: {
        768: {
        slidesPerView: 2,
        spaceBetween: 12,
        },
        1024: {
        slidesPerView: 3,
        spaceBetween: 12,
        },
      },
    });
</script>


<?php get_footer(); ?>