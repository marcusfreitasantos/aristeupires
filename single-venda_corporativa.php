<?php get_header(); ?>
<?php $relatedProducts = get_field("related_products"); ?>
<?php $photoGallery = get_field("photo_gallery"); ?>
<?php $postContent = get_field("post_content"); ?>
<?php
    $getPostsArgs = array(
		'posts_per_page'      => 3,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'venda_corporativa',
        'post__not_in'     => array(get_the_id()),
	);	
    
    $corpPosts = new WP_Query($getPostsArgs);
?>


<section class="corp__section">
    <div class="container">

        <?php if(!$postContent){ ?>
            <h1 class="corp__title"><?php echo the_title(); ?></h1>
        <?php } ?>

        <div class="row">
            <?php if($postContent){ ?>
                <div class="col-md-6">
                    <h1 class="corp__title"><?php echo the_title(); ?></h1>
    
                    <div class="corp__content">
                        <?php echo $postContent; ?>
                    </div>    
                    
                    <?php if(get_field("details")){ ?>
                        <div class="corp__details">
                            <?php echo the_field("details"); ?>
                        </div>
                    <?php } ?>
    
                    <?php if($relatedProducts){ ?>
                        <div class="row g-5 pt-5 pb-5">
                            <?php foreach($relatedProducts as $product){ ?>
                                <?php $productImage = get_the_post_thumbnail($product->id, 'full'); ?>
                                <div class="col-md-6">
                                    <a href="<?php echo get_permalink( $product->ID ); ?>" class="corp__related_product_card">
                                        <?php echo $productImage; ?>
                                        <h4 class="corp__related_product_card_title">
                                            <?php echo $product->post_title; ?>
                                        </h4>
                                    </a>
                                </div>
                                
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="<?php echo $postContent ? 'col-md-6' : 'col-12';?>">
                <?php if($photoGallery){ ?>
                    <div class="corp__photo_gallery">
                        <?php foreach($photoGallery as $photo){ ?>
                            <img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>" />
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="corp__other_section">
    <div class="container">
        <h2 class="section__title">Mais vendas corporativas</h2>
        <hr/>
        <div class="row">
            <?php if($corpPosts->have_posts()){ ?>
                <?php while ($corpPosts->have_posts()) : $corpPosts->the_post(); ?>
                    <?php global $post; ?>
                    <?php $postImg = get_the_post_thumbnail($post->id, 'full'); ?>
                    
                    <div class="col-md-4">
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
                <?php endwhile; ?>
            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>