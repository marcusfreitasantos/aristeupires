<?php /* Template Name: Aristeu - Default Pages Template */ ?>

<?php get_header(); ?>
<?php $siteUrl = site_url(); ?>
<?php $sectionCreator = get_field('sections'); ?>

<?php
    function checkIfIndexIsOddOrEven($index){

        if($index % 2){
            return "flex-row";
        }else{
            return "flex-row-reverse";
        }
    };
?>


<?php if ($sectionCreator) {
    $indexCount = 1;
    foreach ($sectionCreator as $section) { 
        $indexCount++ ?>

        <section class="default__pages_section">
            <div class="row gx-0 h-100 <?php echo checkIfIndexIsOddOrEven($indexCount); ?>">
                <div class="col-md-6 d-flex align-items-center">
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
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if($section["image"]){ ?>
                        <img src="<?php echo $section["image"]["url"]; ?>" class="img-fluid w-100" />
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php }
} ?>

<?php get_footer(); ?>

