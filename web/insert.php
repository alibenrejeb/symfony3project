<?php
require '../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

echo "<pre>";
$date = strftime('%Y-%m-%d %H:%M:%S');
echo $date . "\n";
$client = ClientBuilder::create()->build();

$params = ['body' => []];

for ($i = 1; $i <= 100; $i++) {
    $params['body'][] = [
        'index' => [
            '_index' => 'my_index_1',
            '_type' => 'my_type_1',
            '_id' => $i
        ]
    ];

    $params['body'][] = [
        'field_0' => 'field_0_' . $i,
        'field_1' => 'field_1_' . $i,
        'field_2' => 'field_2_' . $i,
        'field_3' => 'field_3_' . $i,
        'field_4' => 'field_4_' . $i,
        'field_5' => 'field_5_' . $i,
        'field_6' => 'field_6_' . $i,
        'field_7' => 'field_7_' . $i,
        'field_8' => 'field_8_' . $i,
        'field_9' => 'field_9_' . $i,
        'field_10' => 'field_10_' . $i,
        'field_11' => 'field_11_' . $i,
        'field_12' => 'field_12_' . $i,
        'field_13' => 'field_13_' . $i,
        'field_14' => 'field_14_' . $i,
        'field_15' => 'field_15_' . $i,
        'field_16' => 'field_16_' . $i,
        'field_17' => 'field_17_' . $i,
        'field_18' => 'field_18_' . $i,
        'field_19' => 'field_19_' . $i,
    ];
}

// Send the last batch if it exists
if (!empty($params['body'])) {
    $responses = $client->bulk($params);
}

$date = strftime('%Y-%m-%d %H:%M:%S');
echo $date . "\n";
die("ok");