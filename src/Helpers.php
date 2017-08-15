<?php
namespace Tyldar\Rancher;

use Tyldar\Rancher\Resources\Containers;
use Tyldar\Rancher\Resources\Services;

use Tyldar\Rancher\Models\Container;
use Tyldar\Rancher\Models\Service;

class Helpers
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createContainer($name, $image, $ports)
    {
        $containers = new Containers($this->client);

        $cont = new Container();
        $cont->name = $name;

        //Eg: docker:nginx
        $cont->imageUuid = $image;

        //Eg: [30001:80/tcp]
        $cont->ports = $ports;

        $cont->secrets = [];

        //Why ?
        $cont->labels = [
            "io.label.test"=>"test",
            "io.label.test2"=>"test2"
        ];
        $cont->environment = [
            "test"=>"test"
        ];

        return $containers->create($cont);
    }

    public function createService($name, $image, $ports)
    {
        $services = new Services($this->client);

        $cont = new Container();
        $cont->name = $name;

        //Eg: docker:nginx
        $cont->imageUuid = $image;

        //Eg: [30001:80/tcp]
        $cont->ports = $ports;

        $cont->secrets = [];

        //Why ?
        $cont->labels = [
            "io.label.test"=>"test",
            "io.label.test2"=>"test2"
        ];
        $cont->environment = [
            "test"=>"test"
        ];

        $service = new Service();
        $service->name = $name;
        $service->imageUuid = $image;
        $service->launchConfig = $cont;
        $service->stackId = "1st6";
        $service->secondaryLaunchConfigs = [];

        return $services->create($service);
    }
};