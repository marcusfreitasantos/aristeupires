<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>

<?php
function getProductCategories($categoryIds=[]){
    $categoriesToInclude = $categoryIds ? $categoryIds : "";
    $productCatArgs = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'include'   =>  $categoriesToInclude,
        'exclude' => array(15),
        'hide_empty' => false
    );
    $productCategories = get_terms($productCatArgs);
    
    return $productCategories;
}

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

<section id="section_categories">
    <div class="container">
        <div class="row">
            <?php 
            $productCat = getProductCategories();
            foreach($productCat as $cat){ ?>
                <?php $thumbnailId = get_term_meta( $cat->term_id, 'thumbnail_id', true ); ?>
                <?php $thumbnailUrl = wp_get_attachment_url( $thumbnailId ); ?>

                    <a href=<?php echo "$siteUrl/categoria-produto/$cat->slug";?> class="category__card col-md-6">
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

<?php $aboutSection = get_field("about"); ?>
<?php if($aboutSection){ ?>
    <section id="section_about">
        <div class="container bg-white">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4">
                    <div class="about__info">
                        <h2 class="section__title">
                            <?php echo $aboutSection["title"]; ?>
                        </h2>
    
                        <p class="about__description">
                            <?php echo $aboutSection["description"]; ?>
                        </p>
                    </div>

                    <div class="about__divisor"></div>

                    <div class="about__btn">
                        <span>Veja o vídeo: Aristeu Pires Designer</span>
                        <i class="fa-regular fa-circle-play"></i>
                    </div>
                </div>
    
                <div class="col-md-8">
                    <img class="about__img" src="<?php echo $aboutSection["image"]["url"]; ?>" alt="<?php echo $aboutSection["image"]["alt"]; ?>" />
                </div>
            </div>
        </div>
    </section>

    <div class="about__video_popup">
        <span class="about__video_popup_close">
            <span>Fechar</span>
            <i class="fa-solid fa-xmark"></i>
        </span>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/j7UMEFhfwcU?si=eIxtDAa-zuwGrqwx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen="allowfullscreen"></iframe>
    </div>
<?php } ?>



<section id="section_products">
    <div class="container">
        <h2 class="section__title text-center">Destaques</h2>
        <div class="row">
            <?php 
            $getProductsArgs = array(
                'limit' => 8,
                'status' => 'publish'
            );
            $products = wc_get_products( $getProductsArgs );

            if($products){
                foreach($products as $product){  
                $productImage = get_the_post_thumbnail($product->id, 'full');
                ?>
                    <div class="col-md-3 mb-5">
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
                                        <a href=<?php echo "$siteUrl/categoria-produto/$cat->slug";?> class="product__category">
                                            <?php echo $productCat->name; ?>
                                        </a>
                                   <?php } ?>
                                </div>
                            </div>
                    </div>
                <?php }
            }
            ?>
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

    //VIDEO POPUP
    const aboutVideoPopup = document.querySelector(".about__video_popup")
    const openAboutVideoPopup = document.querySelector(".about__btn")
    const closeAboutVideoPopup = document.querySelector(".about__video_popup_close")

    openAboutVideoPopup.addEventListener("click", function(){
        aboutVideoPopup.style.display = "block";
    })

    closeAboutVideoPopup.addEventListener("click",function(){
        aboutVideoPopup.style.display = "none"
    })

</script>
