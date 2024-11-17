<?php     
    function Popup($popupObj){ 
        ob_start(); 
        ?>
            <div class="col-md-4">
                <img src="http://localhost/aristeu-pires/wp-content/uploads/2024/11/SGA_TwoDrydock_14-1-1-scaled-1.jpg" />
            </div>

        <?php
        return ob_get_clean();
    }
