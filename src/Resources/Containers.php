<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Models\Container;

class Containers
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoint = 'containers';
    }

    private function format($container)
    {
        unset($container->links);
        unset($container->actions);

        $tmp = new Container();
        $tmp->set($container);

        unset($tmp->_readOnlyFields);

        return $tmp;
    }

    public function getAll()
    {
        $retn = [];

        $containers = $this->client->request('GET', $this->endpoint, [])->data;
        foreach($containers as $key=>$container)
        {
            if($container->type != "container")
                continue;

            array_push($retn, $this->format($container));
        }
        return $retn;
    }
}