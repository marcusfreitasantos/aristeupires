<?php /* Template Name: Aristeu - Home Page Template */ ?>

<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>
<?php $heroMedia = get_field('hero_media_selector'); ?>
<?php $carousel = get_field('carousel'); ?>
<?php $videoBg = get_field('video_background'); ?>
<?php $videoDesktopUrl = $videoBg["video_url"] ?>
<?php $videoMobileUrl = $videoBg["video_url_mobile"] ?>

<style>
    @media(max-width: 40rem){
        body:not(.logged-in) {
        padding-top: 0 !important;
        }
    }
</style>


<?php 
if ($carousel && $heroMedia == "image_carousel") { ?>
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

<?php if ($videoBg && $heroMedia == "video_bg") { ?>

    <?php if(wp_is_mobile()){ ?>
        <div style="padding:120% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?= $videoMobileUrl ?>?autoplay=1&amp;loop=1&amp;muted=1&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;controls=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="AP_Home_3"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
    <?php }else{?>
        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?= $videoDesktopUrl ?>?autoplay=1&amp;loop=1&amp;muted=1&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&amp;controls=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="AP_Home_3"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
    <?php } ?>
 
 <?php } ?>

<?php $sectionCreator = get_field('sections_creator'); ?>
<?php 

function changeBackgroundBasedOnContentLeftColumn($section, $textPosition){
    $leftImg = $section["media_selector"]["left_image"] ? $section["media_selector"]["left_image"]["url"] : "";
    $backgroundColor = $section['background_color'];


    if(($leftImg && $textPosition === "left")){
        $sectionCreatorColumnBackground = "background: url($leftImg); box-shadow: inset 0 1000px 0 0 rgba(0,0,0,0.7);";
    
    }else if($leftImg){
        $sectionCreatorColumnBackground = "background: url($leftImg);";

    }else{
        $sectionCreatorColumnBackground = "background-color: $backgroundColor;";
    }

    return  $sectionCreatorColumnBackground;
}

function changeBackgroundBasedOnContentRightColumn($section, $textPosition){
    $rightImg = $section["media_selector"]["right_image"] ? $section["media_selector"]["right_image"]["url"] : "";
    $backgroundColor = $section['background_color'];

    if($rightImg && $textPosition === "right"){
        $sectionCreatorColumnBackground = "background: url($rightImg); box-shadow: inset 0 1000px 0 0 rgba(0,0,0,0.7);";
    
    }else if($rightImg){
        $sectionCreatorColumnBackground = "background: url($rightImg);";

    }else{
        $sectionCreatorColumnBackground = "background-color: $backgroundColor;";
    }

    return  $sectionCreatorColumnBackground;
}

?>

<?php if ($sectionCreator) {
    foreach ($sectionCreator as $section) { ?>
        <section class="section__creator" id="<?php echo $section['section_name'] ? $section['section_name'] : '' ?>">
            <div class="row gx-0 section__creator_row">
                <div class="col-md-6 section__creator_column" style="<?php echo changeBackgroundBasedOnContentLeftColumn($section, $section["text_position"]); ?>">

                    <?php if($section["media_selector"]["left_image"]){ ?>
                        <div class="d-md-none d-block">
                            <img src="<?php echo $section["media_selector"]["left_image"]["url"]; ?>" alt="<?php echo $section["media_selector"]["left_image"]["alt"]; ?>" height="200px" />
                        </div>
                    <?php } ?>

                    <?php if($section["text"] && $section["text_position"] === "left"){ ?>
                        <div class="section__content_wrapper">
                            <?php echo $section["text"]; ?>

                            <?php if($section["cta"]){ ?>
                                <a class="section__creator_btn" href="<?php echo $section["cta"]["url"]; ?>">
                                    <?php echo $section["cta"]["title"]; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>


                    <?php if($section["media_selector"]["left_video"]) { ?>
                        <div class="section__creator_video">
                            <video autobuffer="true" preload="auto" muted loop autoplay >
                                <source src=<?php echo $section["media_selector"]["left_video"]; ?>  type="video/mp4" />
                            </video>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6 section__creator_column" style="<?php echo changeBackgroundBasedOnContentRightColumn($section, $section["text_position"]); ?>">

                    <?php if($section["media_selector"]["right_image"]){ ?>
                        <div class="d-md-none d-block">
                            <img src="<?php echo $section["media_selector"]["right_image"]["url"]; ?>" alt="<?php echo $section["media_selector"]["left_image"]["alt"]; ?>" height="200px" />
                        </div>
                    <?php } ?>

                    <?php if($section["text"] && $section["text_position"] === "right"){ ?>
                        <div class="section__content_wrapper">
                            <?php echo $section["text"]; ?>

                            <?php if($section["cta"]){ ?>
                                <a class="section__creator_btn" href="<?php echo $section["cta"]["url"]; ?>">
                                    <?php echo $section["cta"]["title"]; ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if($section["media_selector"]["right_video"]) { ?>
                        <div class="section__creator_video">
                            <video autobuffer="true" preload="auto" muted loop autoplay >
                                <source src=<?php echo $section["media_selector"]["right_video"]; ?>  type="video/mp4" />
                            </video>
                        </div>
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
