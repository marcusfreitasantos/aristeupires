<?php $siteUrl = site_url(); ?>
<?php $productCat = getProductCategories(); ?>

<section id="contato" class="py-5"> 
    <div class="container">
        <h2 class="section__title">Entre em contato</h2>
        <?php echo do_shortcode('[contact-form-7 id="f15653c" title="Contact"]'); ?>
    </div>
</section>

<footer>
	<div class="container">
		<div class="row gx-5">
			<div class="col-md-3">
				<h5 class="footer__column_title">Info</h5>
				
				<div class="footer__items_group">
					<a href="">Sobre</a>
					<a href="">Produtos</a>
					<a href="">Notícias</a>
					<a href="">Onde encontrar</a>
					<a href="">Vendas corporativas</a>
					<a href="">Termos e condições</a>
				</div>
			</div>
			
            <div class="col-md-3">
				<h5 class="footer__column_title">Produtos</h5>
				
				<div class="footer__items_group">
                    <?php foreach($productCat as $cat){ ?>
					<a href="<?php echo "$siteUrl/categoria-produto/$cat->slug";?>">
                        <?php echo $cat->name; ?>
                    </a>

                    <?php } ?>
				</div>
			</div>

            <div class="col-md-3">
				<h5 class="footer__column_title">Encontre-nos</h5>
				
				<div class="footer__items_group">
					<a href="#contato">Contato</a>
					<a href="mailto:contato@aristeupires.com.br">contato@aristeupires.com.br</a>
					<a href="tel:+550543278 1762">(54) 3278 1762</a>
					<a href="https://maps.app.goo.gl/FfT4rwDhLLPLTPhR8" target="_blank">Rua Perimetral, 394 Distrito Industrial</a>
				</div>
			</div>

            <div class="col-md-3">
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