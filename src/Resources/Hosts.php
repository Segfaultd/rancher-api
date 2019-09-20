<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Models\Host;

use Tyldar\Rancher\Inputs\InstanceConsole;

class Hosts
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoint = 'hosts';
    }

    private function format($host, $tmp)
    {
        unset($host->links);
        unset($host->actions);

        $tmp->set($host);

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

        $services = $this->client->request('GET', $this->endpoint.'/?'.http_build_query($criteria), [])->data;
        foreach($services as $key=>$service)
        {
            if($service->type != "service")
                continue;

            array_push($retn, $this->format($service, new Host()));
        }
        return $retn;
    }

    /**
     * @param array $criteria
     *
     * @return Host|null
     */
    public function findOneBy($criteria)
    {
        $services = $this->findBy($criteria);

        if (count($services) > 0) {
            return $this->format($services[0], new Host());
        }

        return NULL;
    }

    public function getAll()
    {
        $retn = [];

        $hosts = $this->client->request('GET', $this->endpoint, [])->data;
        foreach($hosts as $key=>$host)
        {
            if($host->type != "host")
                continue;

            array_push($retn, $this->format($host, new Host()));
        }
        return $retn;
    }

    public function get($id)
    {
        $host = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($host, new Host());
    }

    public function create(Host $cont)
    {
        $host = $this->client->request('POST', $this->endpoint, $cont->toArray());
        return $this->format($host, new Host());
    }

    public function remove($id)
    {
        $host = $this->client->request('DELETE', $this->endpoint.'/'.$id, []);
        return $this->format($host, new Host());
    }
}
?>