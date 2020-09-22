<?php

require 'vendor/autoload.php';

use Onetoweb\Tuindeco\Client;

$apiKey = 'api_key';
$secret = 'secret';

$client = new Client($apiKey, $secret);

// get products
$products = $client->getProducts();

// create order
$order = $client->createOrder([
    'customer_firstname' => 'Hessel',
    'customer_lastname' => 'Kramer',
    'customer_email' => 'test@test.nl',
    'customer_phone' => '0123123123123123',
    'customer_company' => 'Asscher Holding B.V.',
    'customer_street' => 'Woerstraat',
    'customer_housenumber' => '6',
    'customer_housenumber_extension' => 'A',
    'customer_postalcode' => '7751CE',
    'customer_city' => 'Dalen',
    'customer_country_iso' => 'NL@1',
    'customer_ref' => 'INKOOP_Duitsland12',
    'shipment_code' => 'DDP',
    'article_number[]' => '11.213123',
    'article_quantity[]' => '11',
    'article_number[]' => '40.7065OG',
    'article_quantity[]' => '13',
    'article_number[]' => '1.12400P',
    'article_quantity[]' => '100',
    'article_number[]' => '32424',
    'article_quantity[]' => '11',
    'delivery_weeknr' => '50'
]);