<?php $siteUrl = site_url(); ?>
<?php $productCat = getProductCategories(); ?>
<?php $footerMenu = wp_get_nav_menu_items("footer_menu"); ?>

<section id="contato" style="padding: 100px 0;"> 
    <div class="container">
        <h2 class="section__title">Entre em contato</h2>
        <?php echo do_shortcode('[contact-form-7 id="f15653c" title="Contact"]'); ?>
    </div>
</section>

<!--
<section class="section_location">
	<div class="container">
		<h2 class="section__title">Onde estamos</h2>
		<hr/>

		<div class="row align-items-center">
			<div class="col-md-4">
				<div class="row align-items-center">

					<div class="col-md-4">
						<span class="location__title">
							Brasil
						</span>	
					</div>
	
					<div class="col-md-8 location__info_wrapper">
						<div class="location__info">
							<span class="location__subtitle">
								Canela  / RS
							</span>	
							
							<span class="location__text">
								Rua Perimetral, 394<br> Distrito Industrial
							</span>	
	
							<a href="tel:555432781762" class="location__phone">
								(54) 3278 1762
							</a>	

							<a href="mailto:contato@aristeupires.com.br" class="location__text">
								contato@aristeupires.com.br
							</a>	
						</div>

						<div class="location__info mt-4">
							<span class="location__subtitle">
								Vendas Corporativas
							</span>	
	
							<a href="tel:5554991581478" class="location__phone">
								(54) 99158.1478
							</a>	

							<a href="mailto:corporativo@aristeupires.com.br" class="location__text">
								corporativo@aristeupires.com.br
							</a>	
						</div>

						<?php echo ButtonLink("https://www.google.com/maps/place/R.+Perimetral,+364+-+Distrito+Industrial,+Canela+-+RS,+95680-000/@-29.3394999,-50.7887841,17z/data=!3m1!4b1!4m5!3m4!1s0x95192c5fa145a291:0x89d8e2484e00b553!8m2!3d-29.3394999!4d-50.7865954", "Como chegar"); ?>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<img src="<?php echo $siteUrl; ?>/wp-content/uploads/2024/08/brasil.jpg" alt="foto da sede no Brasil" />
			</div>

		<div class="row align-items-center flex-row-reverse mt-4">
			<div class="col-md-4">
				<div class="row align-items-center">

					<div class="col-md-4">
						<span class="location__title">
							EUA
						</span>	
					</div>
	
					<div class="col-md-8 location__info_wrapper">
						<div class="location__info">
							<span class="location__subtitle">
								New York / NY
							</span>	
							
							<span class="location__text">
								Sossego<br>200 Lexington<br> Ave Suite 1301
							</span>	
	
							<a href="tel:2122060245" class="location__phone">
								(212) 206.0245
							</a>	
						</div>

						<?php echo ButtonLink("https://www.google.com/maps/place/New+York+Design+Center/@40.7454845,-73.9805782,15z/data=!4m2!3m1!1s0x0:0x7e290805cb28d637?sa=X&ved=2ahUKEwingbjG79nzAhUfpZUCHS3yBMEQ_BJ6BAh9EAU", "Como chegar"); ?>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<img src="<?php echo $siteUrl; ?>/wp-content/uploads/2024/08/eua.jpg" alt="foto da sede no EUA" />
			</div>
			
		</div>
	</div>
</section>
-->

<footer>
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
					<a href="#contato">Contato</a>
					<a href="mailto:contato@aristeupires.com.br">contato@aristeupires.com.br</a>
					<a href="tel:+550543278 1762">(54) 3278 1762</a>
					<a href="https://maps.app.goo.gl/FfT4rwDhLLPLTPhR8" target="_blank">Rua Perimetral, 394 Distrito Industrial</a>
				</div>
			</div>

            <div class="col-md-3 mt-5">
				<h5 class="footer__column_title">Mantenha-se Conectado</h5>
				
				<div class="footer__items_group">
					<p>Para receber nossa newsletter e ficar por dentro das novidades e eventos, adicione seu endereço de e-mail abaixo.</p>

                    <form name="newsletter_form" method="post" action="">
                        <div class="newsletter_input_row">
                            <input type="email" class="newsletter_input" placeholder="Seu email" name="newsletter_user_email" id="newsletter_user_email"/>
                            <button class="newsletter_btn" type="submit"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </form>

                    <div class="footer__social_links">
                        <a href="https://www.facebook.com/aristeupiresdesign" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/aristeupiresdesign/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    </div>
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="footer__bottom_bar">
    <span>© Copyright Aristeu Pires <?php echo date('Y'); ?>. Móveis de Design Autoral. Todos direitos reservados. </span>
</div>