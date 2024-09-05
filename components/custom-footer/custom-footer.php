<?php $siteUrl = site_url(); ?>
<?php $productCat = getProductCategories(); ?>
<?php $footerMenu = wp_get_nav_menu_items("footer_menu"); ?>

<section id="contato" style="padding: 100px 0;"> 
    <div class="container">
        <h2 class="section__title">Entre em contato</h2>
        <?php echo do_shortcode('[contact-form-7 id="f15653c" title="Contact"]'); ?>
    </div>
</section>

<footer class="py-5">
	<div class="container">
		<div class="row gx-5">
			<div class="col-md-3 mt-5">
				<h5 class="footer__column_title">Info</h5>
				
				<div class="footer__items_group">
					<?php foreach($footerMenu as $menuItem){ ?>
						<a href=<?php echo $menuItem->url; ?>>
							<?php echo $menuItem->title; ?>
						</a>
				<?php } ?>
				</div>
			</div>
			
            <div class="col-md-3 mt-5">
				<h5 class="footer__column_title">Produtos</h5>
				
				<div class="footer__items_group">
                    <?php foreach($productCat as $cat){ ?>
					<a href="<?php echo "$siteUrl/categoria-produto/$cat->slug";?>">
                        <?php echo $cat->name; ?>
                    </a>

                    <?php } ?>
				</div>
			</div>

            <div class="col-md-3 mt-5">
				<h5 class="footer__column_title">Encontre-nos</h5>
				
				<div class="footer__items_group">
					<a href="mailto:contato@aristeupires.com.br">contato@aristeupires.com.br</a>
					<a href="tel:+550543278 1762">(54) 3278 1762</a>
					<a href="https://maps.app.goo.gl/FfT4rwDhLLPLTPhR8" target="_blank">Rua Perimetral, 394 Distrito Industrial.<br/> Canela/RS</a>
				</div>
			</div>

            <div class="col-md-3 mt-5">
				<h5 class="footer__column_title">Mantenha-se Conectado</h5>
				
				<div class="footer__items_group">
					<p>Para receber nossa newsletter e ficar por dentro das novidades e eventos, adicione seu endereço de e-mail abaixo.</p>

					<div id="newsletter_form">
						<?php echo do_shortcode('[zcwp id = 1]'); ?>
					</div>

                    <div class="footer__social_links">
                        <a href="https://www.facebook.com/aristeupiresdesign" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/aristeupiresdesign/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    </div>
				</div>
			</div>
		</div>
	</div>
</footer>