<?php get_header(); ?>

<?php
$args = array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'exclude' => array(15),
    'hide_empty' => false
);
$product_categories = get_terms($args);

?>



<?php 
$carousel = get_field('carousel');
if($carousel){ ?>
    <section class="home__carousel">
        <div class="swiper-wrapper">
            <?php foreach($carousel as $carouselItem){ ?>
                <a href="<?php echo $carouselItem['link']['url'] ?>" class="swiper-slide carousel__wrapper" style="background: url(<?php echo $carouselItem['background_image']; ?>)">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-center flex-column carousel__content_wrapper">
                            <?php if($carouselItem['title']){ ?>
                                <h2 class="carousel__title"><?php echo $carouselItem['title']; ?></h2>
                            <?php } ?>

                            <?php if($carouselItem['subtitle']){ ?>
                                <h3 class="carousel__subtitle"><?php echo $carouselItem['subtitle']; ?></h3>
                            <?php } ?>
                            
                            <?php if($carouselItem['button']){ ?>
                                <span class="carousel__btn">
                                    <?php echo $carouselItem['button']; ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>
<?php } ?>

<section id="section_products">
    <div class="container">
        <div class="row">
            <?php foreach($product_categories as $cat){ ?>
                <?php $thumbnailId = get_term_meta( $cat->term_id, 'thumbnail_id', true ); ?>
                <?php $thumbnailUrl = wp_get_attachment_url( $thumbnailId ); ?>

                    <a href="/categoria-produto/<?php echo $cat->slug; ?>" class="category__card col-md-6">
                        <div style="background: url(<?php echo esc_url( $thumbnailUrl ); ?>)" class="category__card_img col-md-6"></div>

                        <div class="category__card_info col-md-6 d-flex flex-column justify-content-center">
                            <span class="category__card_title"><?php echo $cat->name; ?></span>
                            <div class="category__card_btn">
                                <span>Mais detalhes</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                    </a>
            <?php } ?>
        </div>
    </div>
</section>

<script>
    //SWIPER SLIDE
    const swiper = new Swiper(".home__carousel", {
        direction: "horizontal",
        loop: true,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
