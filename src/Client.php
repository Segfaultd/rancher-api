<?php
namespace Tyldar\Rancher;

use GuzzleHttp\Client as HttpClient;

class Client
{
    private $client;

    public function __construct($url, $access, $secret, $project = "")
    {
        $url = (strlen($project) > 0) ? $url."projects/".$project."/" : $url;
        $this->client = new HttpClient([
            'base_uri'  =>  $url,
            'auth'      =>  [$access, $secret],
        ]);
    }

    public function request($type = 'GET', $endpoint, array $params = [])
    {
        $response = null;
        $payload = ["json"=>$params];
        switch($type)
        {
            case 'GET':
            {
                $response = $this->client->get($endpoint, $params);
            }
            break;

            case 'POST':
            {
                $response = $this->client->post($endpoint, $payload);
            }
            break;

            case 'PUT':
            {
                $response = $this->client->put($endpoint, $payload);
            }
            break;

            case 'DELETE':
            {
                $response = $this->client->delete($endpoint, $payload);
            }
            break;
        }

        return json_decode($response->getBody()->getContents());
    }
}