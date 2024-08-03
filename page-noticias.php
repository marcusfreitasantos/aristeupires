<?php get_header(); ?>
<?php    
    $searchTerm = '';
    $categoriesToSearch = [];

    if(isset($_GET['post_keyword']) || isset($_GET['post_category'])){
        $searchTerm = $_GET['post_keyword'];

        if((int) $_GET['post_category']){
            $categoriesToSearch[] =  (int) $_GET['post_category'];
        }
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $getPostsArgs = array(
		'posts_per_page'      => 8,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
        'category__in'     => $categoriesToSearch,
        'paged'            => $paged,
        's'                => $searchTerm
	);	
    
    $news = new WP_Query($getPostsArgs);

    $postCategories = getAllPostCategories();
?>


<section id="section_news">
    <div class="container">
        <h2 class="section__title text-center">Notícias</h2>

        <form name="search_posts_form" method="get" action="">
            <div class="row">
                <div class="col-md-5">
                    <select name="post_category" id="post_category">
                        <option value="0">Selecione uma categoria</option>

                        <?php foreach($postCategories as $postCategory){ ?>
                            <option value=<?php echo $postCategory->term_id; ?>><?php echo $postCategory->name; ?></option>
                       <?php } ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text"  placeholder="Pesquise pelo título" name="post_keyword" id="post_keyword"/>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">Buscar</i></button>
                </div>
            </div>
        </form>

        <div class="row gx-5">
            <?php if($news->have_posts()){ 
                while ($news->have_posts()) : $news->the_post();
                global $post;

                ?>
                <div class="col-md-3">
                    <?php echo PostCard($post); ?>
                </div>

            <?php 
                endwhile; 

                $big = 999999999;
                ?>

                <div class="col-12 text-center mt-5 pt-5">
                    <?php
                        echo paginate_links(array(
                            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format'    => '?paged=%#%',
                            'current'   => max(1, get_query_var('paged')),
                            'total'     => $news->max_num_pages,
                            'prev_text' => __('«'),
                            'next_text' => __('»'),
                        ));
                    ?>
                </div>

           <?php }else{ ?>
            <div  class="col-12 text-center p-5">
                <span>Nada encontrado.</span>
            </div>

            <?php } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>