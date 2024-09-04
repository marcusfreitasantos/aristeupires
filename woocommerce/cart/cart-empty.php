<?php get_header(); ?>
<?php $productsPage = get_permalink( wc_get_page_id( 'shop' ) ); ?>


<section class="py-5">
	<div class="container">
		<div class="row">
			<div  class="col-12 text-center p-5">
				<h1>Seu carrinho está vazio!</h1>

				<div class="product__details_purchase_btn_wrapper">
					<a href="<?php echo $productsPage; ?>" class="product__details_purchase_btn">
						Voltar para a loja
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>