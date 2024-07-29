<?php get_header(); ?>



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
