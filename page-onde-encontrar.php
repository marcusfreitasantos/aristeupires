<?php get_header(); ?>

<?php
$brazilianStates = [
    (object) ['name' => 'Acre', 'value' => 'AC'],
    (object) ['name' => 'Alagoas', 'value' => 'AL'],
    (object) ['name' => 'Amapá', 'value' => 'AP'],
    (object) ['name' => 'Amazonas', 'value' => 'AM'],
    (object) ['name' => 'Bahia', 'value' => 'BA'],
    (object) ['name' => 'Ceará', 'value' => 'CE'],
    (object) ['name' => 'Distrito Federal', 'value' => 'DF'],
    (object) ['name' => 'Espírito Santo', 'value' => 'ES'],
    (object) ['name' => 'Goiás', 'value' => 'GO'],
    (object) ['name' => 'Maranhão', 'value' => 'MA'],
    (object) ['name' => 'Mato Grosso', 'value' => 'MT'],
    (object) ['name' => 'Mato Grosso do Sul', 'value' => 'MS'],
    (object) ['name' => 'Minas Gerais', 'value' => 'MG'],
    (object) ['name' => 'Pará', 'value' => 'PA'],
    (object) ['name' => 'Paraíba', 'value' => 'PB'],
    (object) ['name' => 'Paraná', 'value' => 'PR'],
    (object) ['name' => 'Pernambuco', 'value' => 'PE'],
    (object) ['name' => 'Piauí', 'value' => 'PI'],
    (object) ['name' => 'Rio de Janeiro', 'value' => 'RJ'],
    (object) ['name' => 'Rio Grande do Norte', 'value' => 'RN'],
    (object) ['name' => 'Rio Grande do Sul', 'value' => 'RS'],
    (object) ['name' => 'Rondônia', 'value' => 'RO'],
    (object) ['name' => 'Roraima', 'value' => 'RR'],
    (object) ['name' => 'Santa Catarina', 'value' => 'SC'],
    (object) ['name' => 'São Paulo', 'value' => 'SP'],
    (object) ['name' => 'Sergipe', 'value' => 'SE'],
    (object) ['name' => 'Tocantins', 'value' => 'TO'],
];
?>

<?php
$storeStateToSearch = "";
if(isset($_GET['store_state'])){
    $storeStateToSearch = $_GET['store_state'];
}

    $getPostsArgs = array(
		'posts_per_page'      => 8,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'loja',
        'meta_query' => array(
            array(
                'key'     => 'state', 
                'value'   => $storeStateToSearch, 
                'compare' => '=',
            ),
        ),
	);	
    
    $stores = new WP_Query($getPostsArgs);


if ($stores->have_posts()) {
    while ($stores->have_posts()) {
        $stores->the_post();
        the_title('<h2>', '</h2>');
        the_content();
    }
    wp_reset_postdata();
} else{
    echo "Não encontrado.";
}

?>


<section class="section__post_content">
    <div class="container">
        <h1 class="section__title text-center">Onde Encontrar</h1>
        <h2 class="text-center">Veja as lojas que você pode encontrar nossos produtos.</h2>

        <form name="search_posts_form" method="get" action="">
            <div class="row justify-content-center pt-5">
                <div class="col-md-4">
                    <select name="store_state" id="store_state">
                        <option value="">Selecione um estado</option>

                        <?php foreach($brazilianStates as $state){ ?>
                            <option value=<?php echo $state->value; ?>><?php echo $state->name; ?></option>
                       <?php } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">Buscar</i></button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>