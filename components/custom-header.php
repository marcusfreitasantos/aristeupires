<?php 
$mainMenu = wp_get_nav_menu_items("main_menu");
$siteUrl = site_url();
$childThemeDirectory = get_stylesheet_directory_uri();
$logo = "$childThemeDirectory/assets/img/aristeu.pires-logo-dark-2024.png";
$headerIconSize = "24px";
?>

<header class="pt-4 pb-4 custom__header">
    <div class="container">
        <div class="row justify-content-between align-items-center">

           <div class="col-4">
                <div class="header__left_menu">
                    <a href="">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>
            </div>

            <div class="header__logo_wrapper col-4">
                <a href=<?php echo $siteUrl; ?>>
                    <img class="img-fluid" src=<?php echo $logo; ?>  alt="ariteu pires logo" />
                </a>
            </div>

            <div class="col-4 col-4 d-flex justify-content-end">
                <div class="d-flex align-items-center justify-content-end header__right_menu">
                    
                <div class="header__search_form">
                    <?php get_search_form(); ?>
                </div>
                    <a class="header__search_form_btn" >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    <a href="/cart" >
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>

                    <a href="/myaccount">
                        <i class="fa-regular fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- <ul class="d-flex justify-content-end align-items-center">
                <?php foreach($mainMenu as $menuItem){ ?>
                    <a href=<?php echo $menuItem->url; ?>>
                        <li>
                            <?php echo $menuItem->title; ?>
                        </li>
                    </a>
               <?php } ?>
            </ul> -->
            
    </div>
</header>