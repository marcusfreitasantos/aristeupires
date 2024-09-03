<?php get_header(); ?>
<?php $heroImg = get_field('hero_image'); ?>
<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $getPostsArgs = array(
		'posts_per_page'      => 6,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'venda_corporativa',
        'paged'            => $paged,
	);	
    
    $corpPosts = new WP_Query($getPostsArgs);
    $big = 999999999;
?>


<?php 
    function changeColumnClassBasedOnIndex($colIndex){
        $colClassName = "col-md-3";
        
        if($colIndex == 1 || $colIndex == 5){
            $colClassName = "col-md-6";
        }
        return $colClassName;
    }
?>


<style>
    body{
        padding: 0 !important;
    }
</style>

<section class="corp__hero">
    <?php if($heroImg){ ?>
        <img class="corp__hero_img" src="<?php echo $heroImg['url']; ?>" alt="<?php echo $heroImg['alt']; ?>" />
    <?php } ?>
</section>

<section>
    <div class="container pt-5">
        <h1 class="corp__page_title text-center"><?php the_title();?></h1>

        <?php if(get_field('page_description')){ ?>
            <p class="corp__page_description text-center"><?php the_field('page_description');?></p>
        <?php } ?>
        
        <div class="row">
            <?php if($corpPosts->have_posts()){ ?>
                <?php $index = 0; ?>
                <?php while ($corpPosts->have_posts()) : $corpPosts->the_post(); ?>
                    <?php global $post; ?>
                    <?php $postImg = get_the_post_thumbnail($post->id, 'full'); ?>
                    
                    <div class="<?php echo changeColumnClassBasedOnIndex($index); ?> mt-4">
                        <a href="<?php echo the_permalink(); ?>" class="corp__other_card">
                            <?php echo $postImg; ?>
                            <h4 class="corp__other_card_title"><?php echo the_title(); ?></h4>

                            <?php if(get_field("post_content")){ ?>
                                <div class="corp__other_card_content">
                                    <?php echo substr(wp_strip_all_tags(get_field("post_content")), 0, 100); ?>
                                </div>
                            <?php } ?>
                        </a>
                    </div>
                    <?php $index++; ?>
                <?php endwhile; ?>
            <?php } ?>
        </div>

        <?php echo PostPagination($corpPosts); ?>
    </div>
</section>

<?php get_footer(); ?>