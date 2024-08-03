<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>

<?php
   $getPostsArgs = array(
		'posts_per_page'      => 2,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
        'post__not_in'          => array(get_the_id()),
        'category__in'     => [],
	);	
    
    $news = new WP_Query($getPostsArgs);

    $postCategories = getAllPostCategories();

?>

<section class="section__post_content">
    <div class="container">
        <div class="row gx-5">
            <div class="col-md-8">

                <div class="post__header">
                    <h1 class="post__title">
                        <?php echo the_title(); ?>
                    </h1>

                    <span class="post__meta">
                        <?php echo date_i18n( 'F j, Y', strtotime( get_the_date() ) ); ?>

                    </span>
                </div>

                <div class="post__content">
                    <?php echo the_content(); ?>
                </div>

                <hr/>

                <div class="post__social_wrapper">
                    <span>Compartilhe:</span>

                    <?php echo do_shortcode('[addtoany]'); ?>
                </div>
            </div>  

            <div class="col-md-4">
                <h2 class="section__title">Veja também</h2>
                <?php if($news->have_posts()){ 
                    while ($news->have_posts()) : $news->the_post();
                    global $post;

                   echo PostCard($post); 
                    endwhile; 
                } ?>

                <hr/>
                <a href=<?php echo "$siteUrl/noticias"; ?> class="post__card_btn"> 
                    <span>Mais novidades</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>