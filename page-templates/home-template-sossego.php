<?php /* Template Name: Sossego's Home Template based */ ?>

<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>

<?php 
$carousel = get_field('carousel');
if ($carousel) { ?>
    <section class="home__carousel">
        <div class="swiper-wrapper">
            <?php foreach ($carousel as $carouselItem) { ?>
                <a href="<?php echo $carouselItem['link']['url'] ?>" class="swiper-slide carousel__wrapper" style="background: url(<?php echo $carouselItem['background_image']; ?>)">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-center flex-column carousel__content_wrapper">
                            <?php if ($carouselItem['title']) { ?>
                                <h2 class="carousel__title"><?php echo $carouselItem['title']; ?></h2>
                            <?php } ?>

                            <?php if ($carouselItem['subtitle']) { ?>
                                <h3 class="carousel__subtitle"><?php echo $carouselItem['subtitle']; ?></h3>
                            <?php } ?>
                            
                            <?php if ($carouselItem['button']) { ?>
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

<?php $sectionCreator = get_field('sections_creator'); ?>
<?php 

function changeBackgroundBasedOnContent($section, $position){
    if(($section["media_selector"]["left_image"] || $section["media_selector"]["left_video"]) && $position === "left"){
        $sectionContentWrapperBackgroundColor = "background-color: rgba(0,0,0,0.60);;";

    }else if(($section["media_selector"]["right_image"] || $section["media_selector"]["right_video"]) && $position === "right"){
        $sectionContentWrapperBackgroundColor = "background-color: rgba(0,0,0,0.60);";
    }else{
        $sectionContentWrapperBackgroundColor = "background-color: #73796d;";
    }

    return $sectionContentWrapperBackgroundColor;
}

?>

<?php if ($sectionCreator) {
    foreach ($sectionCreator as $section) { ?>
        <section class="section__creator">
            <div class="row gx-0 h-100">
                <!--GET IMAGES AND VIDEOS FROM LEFT SIDE-->
                <div class="col-md-6 position-relative h-100">
                    <?php if($section["text"] && $section["text_position"] === "left"){ ?>
                        <div class="section__content_wrapper" style="<?php echo changeBackgroundBasedOnContent($section, "left"); ?>;">
                            <?php echo $section["text"]; ?>

                            <?php if($section["cta"]){ ?>
                                <a class="section__creator_btn" href="<?php echo $section["cta"]["url"]; ?>">
                                    <?php echo $section["cta"]["title"]; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if($section["media_selector"]["left_image"]){ ?>
                        <img src="<?php echo $section["media_selector"]["left_image"]["url"]; ?>" />
                    <?php } ?>

                    <?php if($section["media_selector"]["left_video"]) { ?>
                        <video class="product__video" autobuffer="true" preload="auto" muted loop autoplay >
                            <source src=<?php echo $section["media_selector"]["left_video"]; ?>  type="video/mp4" />
                        </video>
                    <?php } ?>
                </div>

                <!--GET IMAGES, VIDEOS AND TEXT FROM RIGHT SIDE-->
                <div class="col-md-6 position-relative h-100">
                    <?php if($section["text"] && $section["text_position"] === "right"){ ?>
                        <div class="section__content_wrapper" style="<?php echo changeBackgroundBasedOnContent($section, "right"); ?>;">
                            <?php echo $section["text"]; ?>

                            <?php if($section["cta"]){ ?>
                                <a class="section__creator_btn" href="<?php echo $section["cta"]["url"]; ?>">
                                    <?php echo $section["cta"]["title"]; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if($section["media_selector"]["right_image"]){ ?>
                        <img src="<?php echo $section["media_selector"]["right_image"]["url"]; ?>" />
                    <?php } ?>

                    <?php if($section["media_selector"]["right_video"]) { ?>
                        <video class="product__video" autobuffer="true" preload="auto" muted loop autoplay >
                            <source src=<?php echo $section["media_selector"]["right_video"]; ?>  type="video/mp4" />
                        </video>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php }
} ?>

<script>
    // SWIPER SLIDE
    const swiper = new Swiper(".home__carousel", {
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
</script>

<?php get_footer(); ?>
