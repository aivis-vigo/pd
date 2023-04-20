<?php declare(strict_types=1);

require_once "vendor/autoload.php";

use Models\App;

$test = new App();

try {
    $test->mainMenu();
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo $e . PHP_EOL;
}