<?php declare(strict_types=1);

namespace Models;

use GuzzleHttp\Exception\GuzzleException;

class App
{
    private Convert $response;

    public function __construct()
    {
        $this->response = new Convert();
    }

    /**
     * @throws GuzzleException
     */
    public function mainMenu(): bool
    {
        while (true) {
            echo "========Currency convert========" . PHP_EOL;
            echo "Select:" . PHP_EOL;
            echo " - All available currencies (1)" . PHP_EOL;
            echo " - Convert Euro (2)" . PHP_EOL;
            echo " - Exit (3)" . PHP_EOL;

            $selected = (int)readline("Select: ");

            switch ($selected) {
                case 1:
                    echo "================================" . PHP_EOL;
                    $this->response->conversionMenu();
                    $userChoice =  readline("Continue/Quit (c/q): ");
                    if ($userChoice == "q") {
                        echo "================================" . PHP_EOL;
                        echo "Bye!" . PHP_EOL;
                        return false;
                    }
                    break;
                case 2:
                    echo "================================" . PHP_EOL;
                    $this->response->conversionMenu();
                    $this->response->convert();
                    $userChoice =  readline("Continue/Quit (c/q): ");
                    if ($userChoice == "q") {
                        echo "Bye!" . PHP_EOL;
                        echo "================================" . PHP_EOL;
                        return false;
                    }
                    break;
                case 3:
                    echo "Bye!" . PHP_EOL;
                    echo "================================" . PHP_EOL;
                    return false;
                default:
                    echo "Invalid input!" . PHP_EOL;
                    echo "================================" . PHP_EOL;
            }
        }
    }
}