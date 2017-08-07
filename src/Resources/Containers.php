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

    public function get($id)
    {
        $container = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($container);
    }

    public function start($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=start', []);
        return $this->format($container);
    }

    public function stop($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=stop', []);
        return $this->format($container);
    }

    public function restart($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=restart', []);
        return $this->format($container);
    }
}