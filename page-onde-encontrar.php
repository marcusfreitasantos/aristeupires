<?php get_header(); ?>

<?php
$brazilianStates = [
    'AC - Acre',
    'AL - Alagoas',
    'AP - Amapá',
    'AM - Amazonas',
    'BA - Bahia',
    'CE - Ceará',
    'DF - Distrito Federal',
    'ES - Espírito Santo',
    'GO - Goiás',
    'MA - Maranhão',
    'MT - Mato Grosso',
    'MS - Mato Grosso do Sul',
    'MG - Minas Gerais',
    'PA - Pará',
    'PB - Paraíba',
    'PR - Paraná',
    'PE - Pernambuco',
    'PI - Piauí',
    'RJ - Rio de Janeiro',
    'RN - Rio Grande do Norte',
    'RS - Rio Grande do Sul',
    'RO - Rondônia',
    'RR - Roraima',
    'SC - Santa Catarina',
    'SP - São Paulo',
    'SE - Sergipe',
    'TO - Tocantins'
]
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
                            <option value=<?php echo $state; ?>><?php echo $state; ?></option>
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