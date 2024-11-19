<?php     
    function Popup($popupObj){ 
        ob_start(); 
        $title = get_field("title", $popupObj->ID);
        $subtitle = get_field("subtitle", $popupObj->ID);
        $sideImg = get_field("side_image", $popupObj->ID);
        $bgColor = get_field("background_color", $popupObj->ID);
        $formBgColor = get_field("form_background_color", $popupObj->ID);
        $showForm = get_field("lead_form", $popupObj->ID);
        $delay = get_field("delay", $popupObj->ID);
        $button = get_field("button",  $popupObj->ID);

        ?>
        <div class="custom__popup" style="background-color: <?= $bgColor; ?>">
            <button class="custom__popup_close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="custom__popup_img">
                <img src="<?= $sideImg['url']; ?>" alt="<?= $sideImg['alt'] ?>" />
            </div>

            <div class="custom__popup_form_wrapper" style="background-color: <?= $formBgColor; ?>">
                
                <h2><?= $title; ?></h2>
                <h3><?= $subtitle; ?></h2>
                
                <span class="custom__loader"></span>
                <?php if( $showForm && in_array('show', $showForm) ) { ?>
                    <form class="custom__popup_form" action="post">
                        <input type="email" name="user_email"  id="user_email" placeholder="E-mail" class="mb-2" required />
                        <input type="text" name="user_phone" id="user_phone" placeholder="Telefone para contato" class="mb-2"/>
                        <input type="text" name="user_company_name" id="user_company_name" placeholder="Nome da sua empresa" class="mb-2"/>
                        <input type="submit" value="Enviar" />
                    </form>
                <?php } ?>

                <?php if($button){ 
                    echo ButtonLink($button['url'], $button['title']);
                } ?>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function(){
                const popup = document.querySelector('.custom__popup');
                const popupCloseBtn = document.querySelector('.custom__popup_close');
                const popupDelay = <?= intval($delay); ?> * 1000;

                popupCloseBtn.addEventListener("click", function(){
                    popup.classList.remove("show__popup")
                })

                setTimeout(() => {
                    popup.classList.add("show__popup");
                }, popupDelay)
            })
        </script>

        <?php
        return ob_get_clean();
    }
