<?php declare(strict_types=1);

require_once "vendor/autoload.php";

use Models\App;

$application = new App();

try {
    $application->mainMenu();
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo $e . PHP_EOL;
}