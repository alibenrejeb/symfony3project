<?php
require '../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$params = [
    'index' => 'my_index_1',
    'type' => 'my_type_1',
    'id' => '100'
];

$client = ClientBuilder::create()->build();

$response = $client->get($params);

echo "<pre>";
print_r($response);
die;