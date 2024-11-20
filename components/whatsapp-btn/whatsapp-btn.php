<?php

function whatsappBtnAdminMenu() {
    add_menu_page(
        'Whatsapp Button Options', 
        'Whatsapp Button',
        'manage_options', 
        'whatsapp-btn-options-page', 
        'whatsappBtnOptionsPage',  
        'dashicons-whatsapp', 
        100                       
    );
}
add_action('admin_menu', 'whatsappBtnAdminMenu');


function whatsappBtnOptionsPage() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        check_admin_referer('whatsapp_custom_btn_number_nonce'); // Verify nonce for security

        update_option('whatsapp_custom_btn_number', sanitize_text_field($_POST['whatsapp_custom_btn_number']));
        update_option('whatsapp_custom_btn_msg', sanitize_text_field($_POST['whatsapp_custom_btn_msg']));
        update_option('whatsapp_custom_popup_msg', sanitize_text_field($_POST['whatsapp_custom_popup_msg']));

        // Handle checkbox: If checked, save '1'; if not, save '0'
        update_option('whatsapp_custom_activate', isset($_POST['whatsapp_custom_activate']) ? '1' : '0');

        echo '<div class="updated"><p>Options saved!</p></div>';
    }

    $whatsappCustomBtnNumber = get_option('whatsapp_custom_btn_number', '');
    $whatsappCustomBtnMsg = get_option('whatsapp_custom_btn_msg', '');
    $whatsappCustomPopupMsg = get_option('whatsapp_custom_popup_msg', '');
    $whatsappCustomActivate = get_option('whatsapp_custom_activate', '0');
    ?>
    <div class="wrap">
        <h1>WhatsApp Button Options</h1>
        <form method="post" action="">
            <?php wp_nonce_field('whatsapp_custom_btn_number_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Activate WhatsApp Button</th>
                    <td>
                        <input type="checkbox" name="whatsapp_custom_activate" value="1" <?php checked($whatsappCustomActivate, '1'); ?> />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">WhatsApp Number (Only numbers, no spaces or "-")</th>
                    <td><input type="text" name="whatsapp_custom_btn_number" value="<?php echo esc_attr($whatsappCustomBtnNumber); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">WhatsApp Default Message</th>
                    <td><input type="text" name="whatsapp_custom_btn_msg" value="<?php echo esc_attr($whatsappCustomBtnMsg); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">WhatsApp Popup Text</th>
                    <td><input type="text" name="whatsapp_custom_popup_msg" value="<?php echo esc_attr($whatsappCustomPopupMsg); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function renderWhatsappButton(){
    $currentPageID = get_the_ID();
    $currentPostType = get_post_type($currentPageID);
    $whatsappCustomBtnNumber = get_option('whatsapp_custom_btn_number', '');
    $whatsappCustomBtnMsg = get_option('whatsapp_custom_btn_msg', '');
    $whatsappCustomPopupMsg = get_option('whatsapp_custom_popup_msg', '');
    $whatsappCustomActivate = get_option('whatsapp_custom_activate', '0');
    $whatsappCustomLink = "https://api.whatsapp.com/send?phone=$whatsappCustomBtnNumber&text=$whatsappCustomBtnMsg";
    $btnSize = "60px";

    if($whatsappCustomActivate){ ?>
        <style>
            .whatsapp__custom_btn{
                display: flex;
                justify-content: center;
                align-items: center;
                position: fixed;
                bottom: 100px;
                right: 20px;
                width: <?php echo $btnSize; ?>;
                height: <?php echo $btnSize; ?>;
                border-radius: 50%;
                background-color: black;
                font-size: 4rem;
                transition: 0.5s;
                text-decoration: none;
                z-index: 5;
            }

            .whatsapp__custom_btn:hover{
                opacity: 0.5;
            }

            .whatsapp__custom_btn i{
                color: white;
            }

            /*WHATS APP POPUP START*/
            @keyframes show__whatsapp_popup_animation {
                0% {
                    opacity: 0;
                    transform: scale(0.8) translateY(50px);
                }
                50% {
                    opacity: 0.8;
                    transform: scale(1.1) translateY(-10px);
                }
                70% {
                    opacity: 1;
                    transform: scale(0.95) translateY(5px);
                }
                100% {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            .whatsapp__popup {
                position: fixed;
                background-color: #f1f1f1;
                padding: 40px;
                bottom: 180px;
                right: 20px;
                z-index: 5;
                width: 300px;
                display: flex;
                opacity: 0;
                border-radius: 80px 10px 10px 10px;
                animation: 0.5s show__whatsapp_popup_animation forwards ease-out;
                animation-delay: 6s;
            }

            .whatsapp__popup h4 {
                font-size: 2.4rem;
                line-height: 3rem;
                font-weight: 300;
                text-align: center;
            }

            .whatsapp__popup .custom__popup_close {
                color: var(--primary_color);
            }
            /*WHATS APP POPUP END*/
        </style>


        <a class="whatsapp__custom_btn" href="<?php echo $whatsappCustomLink; ?>" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>


        <?php if(is_page('corporativo') || is_page('projetos') || $currentPostType == 'project'){ ?>
            <div class="whatsapp__popup">
                <button class="custom__popup_close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h4><?= $whatsappCustomPopupMsg; ?></h4>
            </div>

            <script>
                const closeWhatsappPopup = document.querySelector(".whatsapp__popup .custom__popup_close");
                const whatsappPopup = document.querySelector(".whatsapp__popup");
            
                closeWhatsappPopup.addEventListener("click", function(){
                    whatsappPopup.style.display = "none";
                })
            </script>
        <?php } ?>

    <?php }
}

add_action("wp_footer", "renderWhatsappButton");