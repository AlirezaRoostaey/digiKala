<?php

use GuzzleHttp\Client;
class DigiKalaService
{
    protected string $apiUrl = 'https://api.digikala.com/';
    public function search($slug) : array
    {
        $url = $this->apiUrl.'v1/search/?q='.$slug.'&page=1';

        $client = new Client();


        try {
            $response = $client->get($url);

            $body = $response->getBody();
            $data = json_decode($body, true);


            if (isset($data['status']) && $data['status'] == 200) {
                return $data['data']['products'];
            } else {
                return [];
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function product($productId): array
    {
        $url = $this->apiUrl.'v2/product/'.$productId.'/';

        $client = new Client();

        try {
            $response = $client->get($url);

            $body = $response->getBody();
            $data = json_decode($body, true);


            if (isset($data['status']) && $data['status'] == 200) {
                return $data['data']['product'];
            } else {
                return [];
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}