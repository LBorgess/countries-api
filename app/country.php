<?php
defined('CONTROL') or die('Acesso negado.');

$api = new ApiConsumer();
$country = $_GET['country_name'] ?? null;

if (!$country) {
    header('Location: ?route=home');
    die();
}

// Dados dos países
$country_data = $api->get_country($country);

$population = $country_data[0]['population'];
$population = number_format($population, 0, ',','.');

$area = $country_data[0]['area'];
$area = number_format($area, 0, ',','.');

?>
<div class="container mt-5">
    <div class="d-flex">
        <div class="card p-2 shadow">
            <img src="<?= $country_data[0]['flags']['png'] ?>">
        </div>
        <div class="ms-5 align-self-center">
            <p class="display-3"><strong><?= $country_data[0]['name']['common'] ?></strong></p>
            <p class="p-0 m-0">Capital:</p>
            <h4 class="p-0 m-0"><?= $country_data[0]['capital'][0] ?? '<span class="text-secondary">Não disponível</span>' ?></h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <p>Região: <br><strong><?= $country_data[0]['region'] ?? '<span class="text-secondary">Não disponível</span>' ?></strong></p>
            <p>Sub-região: <br><strong><?= $country_data[0]['subregion'] ?? '<span class="text-secondary">Não disponível</span>' ?></strong></p>

            <p>População: <br><strong><?= $population ?? '<span class="text-secondary">Não disponível</span>' ?></strong> habitantes</p>
            <p>Área: <br><strong><?= $area ?? '<span class="text-secondary">Não disponível</span>' ?></strong> km<sup>2</sup></p>            
        </div>
    </div>

    <div>
        <a href="?route=home" class="btn btn-primary" px-5>Voltar</a>
    </div>
</div>