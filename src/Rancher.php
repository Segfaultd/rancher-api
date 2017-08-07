<?php
namespace Tyldar\Rancher;

use Tyldar\Rancher\Client;
use Tyldar\Rancher\Resources\Container;

class Rancher
{
    private $client;

    public function __construct($url, $access, $secret)
    {
        $this->client = new Client($url, $access, $secret);
    }

    public function containers()
    {
        return new Container($this->client);
    }
}

?>