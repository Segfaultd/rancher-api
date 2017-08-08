<?php
namespace Tyldar\Rancher;

use Tyldar\Rancher\Client;
use Tyldar\Rancher\Resources\Containers;
use Tyldar\Rancher\Resources\Services;

class Rancher
{
    private $client;

    public function __construct($url, $access, $secret, $project = "")
    {
        $this->client = new Client($url, $access, $secret, $project);
    }

    public function containers()
    {
        return new Containers($this->client);
    }

    public function services()
    {
        return new Services($this->client);
    }
}

?>