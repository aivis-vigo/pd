<?php declare(strict_types=1);


namespace Models;

use Money\Money;
use Money\Currency;
use Money\Converter;
use Money\Exchange\FixedExchange;
use Money\Currencies\ISOCurrencies;
use GuzzleHttp\Exception\GuzzleException;

class Convert
{
    private ApiUrl $response;

    public function __construct()
    {
        $this->response = new ApiUrl();
    }

    /**
     * @throws GuzzleException
     */
    public function conversionMenu()
    {
        echo "Available: " . PHP_EOL;
        $availableCurrencies = $this->response->getUrlData();
        $i = 0;

        foreach ($availableCurrencies as $availableCurrency) {
            echo " - [$i] Currency: $availableCurrency->ID | Rate: $availableCurrency->Rate" . PHP_EOL;
            $i++;
        }
    }

    /**
     * @throws GuzzleException
     */
    public function convert(): void
    {
        $selected = (int) readline("Select currency: ");
        $amount = (int) readline("Amount to convert (€) : ");

        $currencyRate = $this->response->getUrlData();

        $currencyName = $currencyRate[$selected]->ID;
        $exchangeRate = $currencyRate[$selected]->Rate;

        $exchange = new FixedExchange([
            "$currencyName" => [
                'EUR' => $exchangeRate
            ]
        ]);
        $converter = new Converter(new ISOCurrencies(), $exchange);
        $convertFrom = Money::$currencyName("$amount");
        $convertTo = $converter->convert($convertFrom, new Currency("EUR"));

        $message = "Currency: $currencyName |  Rate: $exchangeRate |  Convert amount: $amount EUR | Converted: $convertTo->amount $currencyName" . PHP_EOL;

        echo "================================" . PHP_EOL;
        echo $message;
        echo "Conversion successful!" . PHP_EOL;
        echo "================================" . PHP_EOL;
    }
}