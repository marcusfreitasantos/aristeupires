<?php /* Template Name: Aristeu - Default Pages Template */ ?>

<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>
<?php $sectionCreator = get_field('sections'); ?>
<?php if ( is_page() )
    $pageSlug = get_queried_object()->post_name;
?>
<?php
    $getPostsArgs = array(
		'posts_per_page'      => 3,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'project',
	);	
    
    $corpPosts = new WP_Query($getPostsArgs);
?>

<?php
    function checkIfIndexIsOddOrEven($index){

        if($index % 2){
            return "flex-row";
        }else{
            return "flex-row-reverse";
        }
    };

    function changeColumnClassBasedOnIndex($colIndex){
        $colClassName = "col-md-3";
        $indexesToBeChecked = [1,5,7];
        
        if(in_array($colIndex, $indexesToBeChecked )){
            $colClassName = "col-md-5";
        }
        return $colClassName;
    }
?>

<style>
    body{
        padding-top: 80px;
    }

    .projects__carousel img{
        height: 200px;
        object-fit: cover;

    }
</style>


<?php if ($sectionCreator) {
    $indexCount = 1;
    foreach ($sectionCreator as $section) { 
        $indexCount++ ?>

        <section class="default__pages_section">
            <div class="row gx-0 h-100 align-items-center <?php echo checkIfIndexIsOddOrEven($indexCount); ?>">
                <div class="col-md-6 d-flex">
                    <div class="default__pages_section_content">
                        <?php if($section["title"]){ ?>
                            <h2><?php echo $section["title"]; ?></h2>
                        <?php } ?>

                        <?php if($section["text"]){ ?>
                            <p><?php echo $section["text"]; ?></p>
                        <?php } ?>

                        <?php if($section["link"]){ ?>
                            <a class="default__pages_btn" href="<?php echo $section["link"]["url"]; ?>">
                                <?php echo $section["link"]["title"]; ?>
                            </a>
                        <?php } ?>



                        <?php if($pageSlug === "corporativo"){ ?>

                            <div class="row justify-content-between projects__carousel">
                                <?php if($corpPosts->have_posts()){ ?>
                                    <?php $index = 0; ?>
                                    <?php while ($corpPosts->have_posts()) : $corpPosts->the_post(); ?>
                                        <?php global $post; ?>
                                        <?php $postImg = get_the_post_thumbnail($post->id, 'full'); ?>
                                        
                                        <div class="<?php echo changeColumnClassBasedOnIndex($index); ?>  mt-4">
                                            <a href="<?php echo the_permalink(); ?>" class="corp__other_card">
                                                <?php echo $postImg; ?>
                                                <h4 class="corp__other_card_title"><?php echo the_title(); ?></h4>
                                            </a>
                                        </div>
                                        <?php $index++; ?>
    
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php } ?>
    
                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <a href="/projetos" class="w-100">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </div> 
                            </div>
                        <?php } ?>

        
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if($section["image"]){ ?>
                            <img src="<?php echo $section["image"]["url"]; ?>" />
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php }
} ?>

<?php get_footer(); ?>

