<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Models\Container;
use Tyldar\Rancher\Models\StatsAccess;
use Tyldar\Rancher\Models\HostAccess;
use Tyldar\Rancher\Models\ContainerExec;

use Tyldar\Rancher\Inputs\InstanceConsole;

class Containers
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoint = 'containers';
    }

    private function format($container, $tmp)
    {
        unset($container->links);
        unset($container->actions);

        $tmp->set($container);

        unset($tmp->_readOnlyFields);

        return $tmp;
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy($criteria)
    {
        $retn = [];

        $containers = $this->client->request('GET', $this->endpoint.'/?'.http_build_query($criteria), [])->data;
        foreach($containers as $key=>$container)
        {
            if($container->type != "container")
                continue;

            array_push($retn, $this->format($container, new Container()));
        }
        return $retn;
    }

    /**
     * @param array $criteria
     *
     * @return Container|null
     */
    public function findOneBy($criteria)
    {
        $containers = $this->findBy($criteria);

        if (count($containers) > 0) {
            return $this->format($containers[0], new Container());
        }

        return NULL;
    }

    public function getAll()
    {
        $retn = [];

        $containers = $this->client->request('GET', $this->endpoint, [])->data;
        foreach($containers as $key=>$container)
        {
            if($container->type != "container")
                continue;

            array_push($retn, $this->format($container, new Container()));
        }
        return $retn;
    }

    public function get($id)
    {
        $container = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($container, new Container());
    }

    public function create(Container $cont)
    {
        $container = $this->client->request('POST', $this->endpoint, $cont->toArray());
        return $this->format($container, new Container());
    }

    public function remove($id)
    {
        $container = $this->client->request('DELETE', $this->endpoint.'/'.$id, []);
        return $this->format($container, new Container());
    }

    public function console($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=start', []);
        return $this->format($container, new InstanceConsole());
    }

    public function start($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=start', []);
        return $this->format($container, new Container());
    }

    public function stop($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=stop', []);
        return $this->format($container, new Container());
    }

    public function restart($id)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=restart', []);
        return $this->format($container, new Container());
    }

    public function stats($id)
    {
        $container = $this->client->request('GET', $this->endpoint.'/'.$id.'/containerstats', []);
        return $this->format($container, new StatsAccess());
    }

    public function execute($id, ContainerExec $exec)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=execute', $exec->toArray());
        return $this->format($container, new HostAccess());
    }

    public function logs($id, $follow = false, $lines = null)
    {
        $container = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=logs', ['follow'=>$follow, 'line'=>$lines]);
        return $this->format($container, new StatsAccess());
    }
}