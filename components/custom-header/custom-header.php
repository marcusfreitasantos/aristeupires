<?php 
$mainMenu = wp_get_nav_menu_items("main_menu");
$siteUrl = site_url();
$childThemeDirectory = get_stylesheet_directory_uri();
$logo = "$childThemeDirectory/assets/img/aristeu.pires-logo-dark-2024.png";
$headerIconSize = "24px";
$cartItemsNumber = WC()->cart->get_cart_contents_count();


function hasChildren($menuItems, $itemId) {
    foreach ($menuItems as $menuItem) {
        if ($menuItem->menu_item_parent == $itemId) {
            return true;
        }
    }
    return false;
}
?>

<header class="custom__header">
    <div class="custom__header_container">
        <div class="row justify-content-between align-items-center">
           <div class="col-md-4 col-2">
                <div class="header__left_menu">
                    <span class="header__main_menu_btn">
                        <i class="fa-solid fa-bars"></i>
                    </span>

                    <span class="header__main_menu_btn_close">
                        <i class="fa-solid fa-x"></i>
                    </span>
                </div>
            </div>

            <div class="header__logo_wrapper col-4 ">
                <a href=<?php echo $siteUrl; ?>>
                    <img class="img-fluid" src=<?php echo $logo; ?>  alt="ariteu pires logo" />
                </a>
            </div>

            <div class="col-4 d-sm-block justify-content-end">
                <div class="d-flex align-items-center justify-content-end header__right_menu">
                    
                    <div class="header__search_form">
                        <?php get_search_form(); ?>
                    </div>

                    <a class="header__search_form_btn" >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    <a class="position-relative" href=<?php echo wc_get_cart_url(); ?> >
                        <i class="fa-solid fa-cart-shopping"></i>

                        <?php if($cartItemsNumber){ ?>
                            <span class="header__cart_icon"><?php echo $cartItemsNumber; ?></span>
                        <?php } ?>
                    </a>

                    <a href=<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>>
                        <i class="fa-regular fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="header__main_menu">
                    <?php foreach($mainMenu as $menuItem){                     
                        if(!hasChildren($mainMenu, $menuItem->ID) && $menuItem->menu_item_parent == 0){ ?>
                            <a class="header__submenu_title" href="<?php echo $menuItem->url; ?>" target="<?php echo $menuItem->target; ?>">
                                <?php echo $menuItem->title; ?>
                            </a>
                        <?php }else if(hasChildren($mainMenu, $menuItem->ID)){ ?>
                            <div class="header__submenu">
                                <span class="header__submenu_title"><?php echo $menuItem->title; ?></span>
    
                                <?php foreach($mainMenu as $submenuItem){ 
                                    if($submenuItem->menu_item_parent == $menuItem->ID){ ?>
                                        <a href="<?php echo $submenuItem->url; ?>" target="<?php echo $submenuItem->target; ?>" class="header__submenu_item">
                                            <?php echo $submenuItem->title; ?> 
                                        </a>
                                    <?php } ?>
                               <?php } ?>
                            </div>
                        <?php }
                        ?>
                   <?php } ?>
            </div>
        </div>
    </div>
</header>