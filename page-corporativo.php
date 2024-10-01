<?php get_header(); ?>
<?php $heroImg = get_field('hero_image'); ?>

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

<section class="py-5">
    <div class="container pt-5">
        <h1 class="corp__page_title text-center"><?php the_title();?></h1>

        <?php if(get_field('page_description')){ ?>
            <p class="corp__page_description text-center"><?php the_field('page_description');?></p>
        <?php } ?>
    </div>
</section>


<?php get_footer(); ?>