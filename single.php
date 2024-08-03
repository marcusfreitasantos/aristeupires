<?php get_header(); ?>

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
                sidebar
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>