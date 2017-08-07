<?php
namespace Tyldar\Rancher\Resources;

class Container
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoints = 'containers';
    }

    public function getAll()
    {
        return $this->client->request('GET', $endpoint, []);
    }
}