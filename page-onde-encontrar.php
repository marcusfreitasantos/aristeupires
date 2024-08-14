<?php get_header(); ?>

<?php
$brazilianStates = [
    (object) ['name' => 'Acre', 'value' => 'AC'],
    (object) ['name' => 'Alagoas', 'value' => 'AL'],
    (object) ['name' => 'Amapá', 'value' => 'AP'],
    (object) ['name' => 'Amazonas', 'value' => 'AM'],
    (object) ['name' => 'Bahia', 'value' => 'BA'],
    (object) ['name' => 'Ceará', 'value' => 'CE'],
    (object) ['name' => 'Distrito Federal', 'value' => 'DF'],
    (object) ['name' => 'Espírito Santo', 'value' => 'ES'],
    (object) ['name' => 'Goiás', 'value' => 'GO'],
    (object) ['name' => 'Maranhão', 'value' => 'MA'],
    (object) ['name' => 'Mato Grosso', 'value' => 'MT'],
    (object) ['name' => 'Mato Grosso do Sul', 'value' => 'MS'],
    (object) ['name' => 'Minas Gerais', 'value' => 'MG'],
    (object) ['name' => 'Pará', 'value' => 'PA'],
    (object) ['name' => 'Paraíba', 'value' => 'PB'],
    (object) ['name' => 'Paraná', 'value' => 'PR'],
    (object) ['name' => 'Pernambuco', 'value' => 'PE'],
    (object) ['name' => 'Piauí', 'value' => 'PI'],
    (object) ['name' => 'Rio de Janeiro', 'value' => 'RJ'],
    (object) ['name' => 'Rio Grande do Norte', 'value' => 'RN'],
    (object) ['name' => 'Rio Grande do Sul', 'value' => 'RS'],
    (object) ['name' => 'Rondônia', 'value' => 'RO'],
    (object) ['name' => 'Roraima', 'value' => 'RR'],
    (object) ['name' => 'Santa Catarina', 'value' => 'SC'],
    (object) ['name' => 'São Paulo', 'value' => 'SP'],
    (object) ['name' => 'Sergipe', 'value' => 'SE'],
    (object) ['name' => 'Tocantins', 'value' => 'TO'],
];
?>

<?php
$storeStateToSearch = "";
$getPostsArgs = [];

if(isset($_GET['store_state']) && $_GET['store_state'] !== "todos"){
    $storeStateToSearch = $_GET['store_state'];
}

if($storeStateToSearch){
    $getPostsArgs = array(
		'posts_per_page'      => -1,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'loja',
        'meta_query' => array(
            array(
                'key'     => 'state', 
                'value'   => $storeStateToSearch, 
                'compare' => '=',
            ),
        ),
    );
}else{
    $getPostsArgs = array(
		'posts_per_page'      => -1,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'loja',
    );
}
    
$stores = new WP_Query($getPostsArgs);

?>


<section class="section__post_content">
    <div class="container">
        <h1 class="section__title text-center">Onde Encontrar</h1>
        <h2 class="text-center">Veja as lojas que você pode encontrar nossos produtos.</h2>

        <form name="search_posts_form" method="get" action="">
            <div class="row justify-content-center pt-5">
                <div class="col-md-4">
                    <select name="store_state" id="store_state">
                        <option value="">Selecione um estado</option>
                        <option value="todos">Todos</option>
                        <?php foreach($brazilianStates as $state){ ?>
                            <option value=<?php echo $state->value; ?>><?php echo $state->name; ?></option>
                       <?php } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">Buscar</i></button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="dedicated_stores">
    <div class="container">
        <h2 class="section__title text-center mb-5">Lojas Dedicadas</h2>
        <div class="row">
            <div class="dedicated_stores_carousel">
                <div class="swiper-wrapper">
                    <?php 
                        if ($stores->have_posts()) {
                            while ($stores->have_posts()) {
                                $stores->the_post();
                                $postImg = get_field('image');
                                $categories = get_the_terms(get_the_ID(), 'lojas_cat');
                                if (has_term('lojas-dedicadas', 'lojas_cat')){   ?>

                                    <div class="swiper-slide">
                                        <div class="stores__card row align-items-center g-0">
                                            <div class="col-md-8">
                                                <?php if($postImg){ ?>
                                                    <img src="<?php echo $postImg['url'];?>"  alt="<?php echo $postImg['alt'];?>" />
                                                <?php } ?>
                                            </div>

                                            <div class="col-md-4 stores__card_info">
                                                <h2 class="stores__card_title"><?php the_title(); ?></h2>

                                                <?php if(get_field('city') && get_field('state')){?>
                                                    <h3 class="stores__card_subtitle"><?php echo the_field('city'); ?> / <?php echo the_field('state'); ?></h3>
                                            <?php } ?>

                                                <?php if(get_field('address')){?>
                                                    <p class="stores__card_address"><?php echo the_field('address'); ?></p>
                                            <?php } ?>

                                                <?php if(get_field('phone')){?>
                                                    <span class="stores__card_phone"><?php echo the_field('phone'); ?></span>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            wp_reset_postdata();
                        } else{ ?>
                            <div  class="col-12 text-center p-5">
                                <span>Nada encontrado.</span>
                            </div>
                    <?php } ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>


<section class="concept_stores">
    <div class="container">
        <h2 class="section__title text-center mb-5">Conceito Aristeu Pires</h2>
        <div class="row">
            <div class="concept_stores_carousel">
                <div class="swiper-wrapper">
                    <?php 
                        if ($stores->have_posts()) {
                            while ($stores->have_posts()) {
                                $stores->the_post();
                                $postImg = get_field('image');
                                $categories = get_the_terms(get_the_ID(), 'lojas_cat');
                                if (has_term('conceito-aristeu-pires', 'lojas_cat')){   ?>

                                    <div class="swiper-slide">
                                        <div class="stores__card row align-items-center g-0">
                                            <div class="col-md-6 stores__card__img_wrapper">
                                                <?php if($postImg){ ?>
                                                    <img src="<?php echo $postImg['url'];?>"  alt="<?php echo $postImg['alt'];?>" />
                                                <?php } ?>
                                            </div>

                                            <div class="col-md-6 stores__card_info">
                                                <h2 class="stores__card_title"><?php the_title(); ?></h2>

                                                <?php if(get_field('city') && get_field('state')){?>
                                                    <h3 class="stores__card_subtitle"><?php echo the_field('city'); ?> / <?php echo the_field('state'); ?></h3>
                                            <?php } ?>

                                                <?php if(get_field('address')){?>
                                                    <p class="stores__card_address"><?php echo the_field('address'); ?></p>
                                            <?php } ?>

                                                <?php if(get_field('phone')){?>
                                                    <span class="stores__card_phone"><?php echo the_field('phone'); ?></span>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            wp_reset_postdata();
                        } else{ ?>
                            <div  class="col-12 text-center p-5">
                                <span>Nada encontrado.</span>
                            </div>
                    <?php } ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>

<section class="essence_stores">
    <div class="container">
        <h2 class="section__title text-center mb-5">Lojas Essência</h2>
        <div class="row">
        <?php 
            if ($stores->have_posts()) {
                while ($stores->have_posts()) {
                    $stores->the_post();
                    $postImg = get_field('image');
                    $categories = get_the_terms(get_the_ID(), 'lojas_cat');
                    if (has_term('lojas-essencia', 'lojas_cat')){   ?>
                        <div class="col-md-3 mb-4">
                            <div class="essence__stores_card">
                                
                                <?php if(get_field('city') && get_field('state')){?>
                                    <h3 class="stores__card_subtitle"><?php echo the_field('city'); ?> / <?php echo the_field('state'); ?></h3>
                                <?php } ?>
    
                                <h2 class="stores__card_title"><?php the_title(); ?></h2>

                                <?php if(get_field('address')){?>
                                    <p class="stores__card_address"><?php echo the_field('address'); ?></p>
                                <?php } ?>
    
                                <?php if(get_field('phone')){?>
                                    <span class="stores__card_phone"><?php echo the_field('phone'); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }
                }
                wp_reset_postdata();
            } else{ ?>
                <div  class="col-12 text-center p-5">
                    <span>Nada encontrado.</span>
                </div>
        <?php } ?>
        </div>
    </div>
</section>



<script>
    //SWIPER SLIDE
    const swiper = new Swiper(".dedicated_stores_carousel", {
        direction: "horizontal",
        loop: true,
        autoplay: {
            delay: 3000
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    const swiper2 = new Swiper(".concept_stores_carousel", {
        direction: "horizontal",
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 6000
        },
        breakpoints: {
        1024: {
        slidesPerView: 2,
        spaceBetween: 12,
        },
      },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

<?php get_footer(); ?>