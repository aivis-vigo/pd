<?php declare(strict_types=1);

require_once "vendor/autoload.php";

$url = "https://www.latvijasbanka.lv/vk/ecb.xml";
use Thelia\CurrencyConverter;


$xml = simplexml_load_file($url);
$json = json_encode($xml);
$response = json_decode($json, true);
$allCurrencies = $response["Currencies"]["Currency"];

foreach ($allCurrencies as $currency) {
    echo $currency["ID"] . " - " . $currency["Rate"] . PHP_EOL;
}