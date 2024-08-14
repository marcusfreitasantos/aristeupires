<?php get_header(); ?>

<?php
$product = new WC_product(get_the_id());
$productData = $product->get_data();
$attachmentIds = $product->get_gallery_image_ids();

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

            <div class="col-md-6 d-flex justify-content-end">
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

<section id="product-info">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product__img_carousel w-100 position-relative">
                    <div class="swiper-wrapper">

                        <?php foreach($attachmentIds as $attachmentId){
                            $productGalleryImageUrl = wp_get_attachment_url( $attachmentId );
                            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $productGalleryImageUrl; ?>"  />
                                </div>
                        <?php } ?>

                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <div class="col-md-6 text-center p-5 d-flex align-items-center justify-content-center">
                <span>[SOSSEGO'S PLUGIN]</span>
            </div>
        </div>
    </div>
</section>

<section id="product-resources">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="section__title">Descrição</h2>

                <div class="product__details">
                    <?php echo $productData['description']; ?>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="section__title">Recursos</h2>

                <?php if($productResources){ ?>
                    <div class="product__resources_wrapper row">
                        <?php foreach($productResources as $resource){ ?>
                            <div class="col-md-6 mb-4">
                                <a class="product__resource_btn" href="<?php echo $resource['link']['url']; ?>" target="<?php echo $resource['link']['target']; ?>">
                                    <span class="product__resource_btn_title"><?php echo $resource['link']['title']; ?></span>
                                    <span class="product__resource_btn_text"><?php echo $resource['small_description']; ?></span>
                                </a>
                            </div>    
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if($productCustomGallery){ ?>
    <section class="product__gallery_section" id="product-gallery">
        <?php foreach($productCustomGallery as $gallery){ ?>
            <div class="gallery__carousel">
                <div class="swiper-wrapper">
                    <?php foreach($gallery['add_slider_image'] as $galleryImg){ ?>
                        <div class="swiper-slide">
                            <img src="<?php echo $galleryImg['url']; ?>"  />
                        </div>
                    <?php } ?>
                </div>
            </div>
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
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    const swiper2 = new Swiper(".gallery__carousel", {
        direction: "horizontal",
        loop: true,
        slidesPerView: 3,
        spaceBetween: 12,
        autoplay: {
            delay: 3000,
        },
    });
</script>


<?php get_footer(); ?>