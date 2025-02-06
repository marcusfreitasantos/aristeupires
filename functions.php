<?php
function oceanwp_child_enqueue_parent_style() {

	$version = "3.1.1";

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
include("components/popup/popup.php");
include("custom-posts/popups.php");

global $emailHeaders;
$emailHeaders = array(
	'Content-Type: text/html; charset=UTF-8',
	'Reply-To: Aristeu Pires <contato@aristeupires.com.br>',
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
    wp_enqueue_script( 'ajax-scripts', get_stylesheet_directory_uri() . '/assets/js/ajax-scripts.js', array('jquery'), null, true );
    wp_localize_script( 'ajax-scripts', 'my_ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'enqueueCustomScripts' );


function loadMoreProductsByAjax() {
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
add_action( 'wp_ajax_get_products_by_ajax', 'loadMoreProductsByAjax' );
add_action( 'wp_ajax_nopriv_get_products_by_ajax', 'loadMoreProductsByAjax' );


function showPopupBasedOnCurrentPage(){
    $currentPageID = get_the_ID();
    $currentPostType = get_post_type($currentPageID);

    $args = [
        'post_type'  => 'popup',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'     => 'pages',
                'value'   => '"' . $currentPageID . '"',
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'dynamic_content',
                'value'   => '"' . $currentPostType . '"',
                'compare' => 'LIKE',
            ]
        ],
        'posts_per_page' => 1,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        echo Popup($query);
        wp_reset_postdata();
    }
}
add_action('wp_footer', 'showPopupBasedOnCurrentPage');


function emailTemplate($content){
	return '
	<table width="100%" style="background: #f7f7f7; padding: 40px;">
		<tr>
			<td width="600px">
				<div style="width: 600px; margin: auto;">
					<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-radius: 5px">
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top">
											<!-- Header -->
											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #000">
												<tr>
													<td style="padding: 36px 48px; display: block; text-align: center; background-color: transparent; border: none; border-bottom: 1px solid #eee;">
														<p style="margin:0;">
														<img src="https://www.aristeupires.com.br/wp-content/uploads/2024/07/aristeu.pires-logo-2024.png" width="200px"/>
														</p>
													</td>
												</tr>
											</table>
											<!-- End Header -->
										</td>
									</tr>
									<tr>
										<td align="center" valign="top">
											<!-- Body -->
											<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body" style="background: #fff">
												<tr>
													<td valign="top" id="body_content">
														<!-- Content -->
														<table border="0" cellpadding="20" cellspacing="0" width="100%">
															<tr>
																<td valign="top" style="padding:48px 48px 32px;background-color:transparent;border:none;border-bottom:1px solid #eee">
																	<div id="body_content_inner" style="font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;">' . $content . '</div>
																</td>
															</tr>
														</table>
														<!-- End Content -->
													</td>
												</tr>
											</table>
											<!-- End Body -->
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<!-- Footer -->
								<table border="0" cellpadding="10" cellspacing="0" width="100%" id="template_footer">
									<tr>
										<td valign="top">
											<table border="0" cellpadding="10" cellspacing="0" width="100%">
												<tr>
													<td colspan="2" valign="middle" id="credit">
														
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- End Footer -->
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	';
}


function sendEmailByAjax() {
    if ( isset($_POST['userEmail']) && $_POST['userEmail'] != "" ) {
        global $emailHeaders;
        $to = "contato@aristeupires.com.br";
        $subject = "Novo contato pelo formulário do popup";
        $userEmail= $_POST['userEmail'];
        $userPhone= $_POST['userPhone'] ? $_POST['userPhone'] : "Sem telefone";
        $userCompany= $_POST['userCompanyName'] ? $_POST['userCompanyName'] : "Sem empresa";
        $originUrl= $_POST['originUrl'];
        
        $message =  "							
                <p style='font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;'><strong>Informações do usuário:</strong></p>
                <p style='font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;'>Email: $userEmail</p>
                <p style='font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;'>Telefone: $userPhone</p>
                <p style='font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;'>Empresa: $userCompany</p>
                <p style='font-family: Helvetica, Arial, sans-serif; font-size: 13px;line-height: 1.5em;'>URL de origem: $originUrl</p>
            ";
    
        $body = emailTemplate($message);
    
        $sendEmail = wp_mail( $to, $subject, $body, $emailHeaders );

        if($sendEmail){
            echo true;
        }else{
            echo false;
        }
    } else {
        echo 'Email não fornecido.';
    }
    
    wp_die();
}
add_action( 'wp_ajax_send_email_by_ajax', 'sendEmailByAjax' );
add_action( 'wp_ajax_nopriv_send_email_by_ajax', 'sendEmailByAjax' );


?>
