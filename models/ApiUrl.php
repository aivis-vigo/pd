<?php declare(strict_types=1);

namespace Models;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiUrl
{
    private Client $client;
    private const API_URL = "https://www.latvijasbanka.lv/vk/ecb.xml";

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     */
    private function urlData(): array
    {
        $response = $this->client->get(self::API_URL);
        $xml = simplexml_load_string($response->getBody()->getContents());
        $xmlData = json_decode(json_encode($xml));
        return $xmlData->Currencies->Currency;
    }

    /**
     * @throws GuzzleException
     */
    public function getUrlData(): array
    {
        return $this->urlData();
    }
}