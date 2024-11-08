<?php
function oceanwp_child_enqueue_parent_style() {

	$version = "2.0.5";

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/css/bootstrap.min.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/fontawesome.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/regular.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/brands.css',array(), $version );
	wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/libs/fontawesome/css/solid.css',array(), $version );
	wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/assets/libs/swiper/css/swiper-bundle.min.css',array(), $version );
   	wp_enqueue_style( 'lightbox-style', get_stylesheet_directory_uri() . '/assets/libs/lightbox/css/lightbox.min.css',array(), $version );

	wp_enqueue_script( 'bootstrap-main-script', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/js/bootstrap.min.js', array(), $version );
	wp_enqueue_script( 'bootstrap-bundle-script', get_stylesheet_directory_uri() . '/assets/libs/bootstrap/js/bootstrap.bundle.min.js', array(), $version );
	wp_enqueue_script( 'swiper-script',get_stylesheet_directory_uri() . '/assets/libs/swiper/js/swiper-bundle.min.js', array(), $version );
   	wp_enqueue_script( 'lightbox-script',get_stylesheet_directory_uri() . '/assets/libs/lightbox/js/lightbox.min.js', array(), $version );
	wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/scripts.js', array(), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );


include("components/button-link/button-link.php");
include("components/post-card/post-card.php");
include("components/product-card/product-card.php");
include("components/whatsapp-btn/whatsapp-btn.php");
include("components/post-pagination/post-pagination.php");

global $emailHeaders;
$emailHeaders = array(
	'Content-Type: text/html; charset=UTF-8',
	'Reply-To: Blessy <contato@aristeupires.com.br>',
);


function getProductCategories($categoryIds=[]){
    $categoriesToInclude = $categoryIds ? $categoryIds : "";
    $productCatArgs = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
        'include'   =>  $categoriesToInclude,
        'exclude' => array(15),
        'hide_empty' => true
    );
    $productCategories = get_terms($productCatArgs);
    
    $filteredCategories = array_filter($productCategories, function($category) {
        return $category->parent == 0;
    });
    
    return $filteredCategories;
}

function getAllPostCategories(){
    $postCategoriesArgs = array(
        'taxonomy'   => 'category',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => true
    );
    $postCategories = get_terms($postCategoriesArgs);
    
    return $postCategories;
}


function updateHeaderCartIcon( $fragments ) {

	$fragments[ '.header__cart_icon' ] = '<a href="' . wc_get_cart_url() . '" class="header__cart_icon">' . WC()->cart->get_cart_contents_count() . '</a>';
 	return $fragments;

 }
 add_filter( 'woocommerce_add_to_cart_fragments', 'updateHeaderCartIcon' );


 function searchOnlyProducts($query) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set('post_type', 'product');
        // Get the search query
        $search_query = $query->get('s');

        // Remove any slashes from the search query
        $search_query = str_replace('/', '', $search_query);

        // Update the search query
        $query->set('s', $search_query);
    }
}
add_action('pre_get_posts', 'searchOnlyProducts');


function enqueueCustomScripts() {
    wp_enqueue_script( 'ajax-products-script', get_stylesheet_directory_uri() . '/assets/js/ajax-products.js', array('jquery'), null, true );

    wp_localize_script( 'ajax-products-script', 'my_ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'enqueueCustomScripts' );


function customAjaxHandler() {
    if ( isset($_POST['products_page']) ) {
        $currentPage = sanitize_text_field( $_POST['products_page'] );
        $productCat = sanitize_text_field( $_POST['category'] );

        $getProductsArgs = array(
            'limit'     => 9,
            'status'    => 'publish',
            'page'      => $currentPage,
            'paginate'  => true,
            'category'  => $productCat == 'produtos' ? [] : [$productCat]
        );
        $products = wc_get_products( $getProductsArgs );
        $totalProducts = $products->total;

        if($totalProducts < 9){
            echo '<style>.loadmore__btn{display: none !important};</style>';
        }

        foreach($products->products as $product){ ?>
            <div class="col-md-4 mb-5">
                <?php echo ProductCard($product); ?>
            </div>
        <?php }


    }

    wp_die(); 
}
add_action( 'wp_ajax_get_products_by_ajax', 'customAjaxHandler' );
add_action( 'wp_ajax_nopriv_get_products_by_ajax', 'customAjaxHandler' );
?>
