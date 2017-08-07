<?php
namespace Tyldar\Rancher;

use GuzzleHttp\Client as HttpClient;

class Client
{
    private $client;

    public function __construct($url, $access, $secret)
    {
        $this->client = new HttpClient([
            'base_uri'  =>  $url,
            'auth'      =>  [$access, $secret]
        ]);
    }

    public function request($type = 'GET', $endpoint, array $params = [])
    {
        $response = null;
        switch($type)
        {
            case 'GET':
            {
                $response = $this->client->get($endpoint, $params);
            }
            break;

            case 'POST':
            {
                $response = $this->client->post($endpoint, $params);
            }
            break;

            case 'PUT':
            {
                $response = $this->client->put($endpoint, $params);
            }
            break;

            case 'DELETE':
            {
                $response = $this->client->delete($endpoint, $params);
            }
            break;
        }

        return json_decode($response->getBody()->getContents());
    }
}