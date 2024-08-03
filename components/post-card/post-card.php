<?php function PostCard($post){
    ob_start();  
    $categories = wp_get_post_categories($post->ID, array("fields" => "all"));
    ?>

    <div class="post__card">
        <?php echo  get_the_post_thumbnail($post->ID, "full"); ?>

        <div>
            <a href="<?php echo get_permalink($post->ID); ?>" class="post__card_title"><?php echo $post->post_title; ?></a>
            <?php foreach($categories as $postsCategory){ ?>
                <span class="post__card_cat"><?php echo $postsCategory->name; ?></span>
            <?php } ?>
        </div>
        
        <p class="post__card_text"><?php echo get_the_excerpt($post->ID); ?></p>

        <?php echo ButtonLink(get_permalink($post->ID), "Leia mais"); ?>
    </div>

    <?php
    return ob_get_clean();
} 
?>