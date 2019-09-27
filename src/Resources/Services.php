<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Inputs\AddRemoveServiceLink;
use Tyldar\Rancher\Inputs\SetServiceLinks;
use Tyldar\Rancher\Inputs\ServiceUpgrade;

use Tyldar\Rancher\Models\Service;

class Services
{
    private $client;
    private $endpoint;

    public function __construct($client)
    {
        $this->client = $client;
        $this->endpoint = 'services';
    }

    private function format($service, $tmp)
    {
        unset($service->links);
        unset($service->actions);

        $tmp->set($service);

        unset($tmp->_readOnlyFields);

        return $tmp;
    }

    public function getAll()
    {
        $retn = [];

        $services = $this->client->request('GET', $this->endpoint, [])->data;
        foreach($services as $key=>$service)
        {
            if($service->type != "service")
                continue;

            array_push($retn, $this->format($service, new Service()));
        }
        return $retn;
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

            array_push($retn, $this->format($service, new Service()));
        }
        return $retn;
    }

    /**
     * @param array $criteria
     *
     * @return Service|null
     */
    public function findOneBy($criteria)
    {
        $services = $this->findBy($criteria);

        if (count($services) > 0) {
            return $this->format($services[0], new Service());
        }

        return NULL;
    }

    public function get($id)
    {
        $service = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($service, new Service());
    }

    public function create(Service $service)
    {
        $service = $this->client->request('POST', $this->endpoint, $service->toArray());
        return $this->format($service, new Service());
    }

    public function remove($id)
    {
        $service = $this->client->request('DELETE', $this->endpoint.'/'.$id, []);
        return $this->format($service, new Service());
    }

    public function activate($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=activate', []);
        return $this->format($service, new Service());
    }

    public function addServiceLink($id, AddRemoveServiceLink $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=addservicelink', $datas->toArray());
        return $this->format($service, new Service());
    }

    public function cancelUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=cancelupgrade', []);
        return $this->format($service, new Service());
    }

    public function continueUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=continueupgrade', []);
        return $this->format($service, new Service());
    }

    public function deactivate($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=deactivate', []);
        return $this->format($service, new Service());
    }

    public function finishUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=finishupgrade', []);
        return $this->format($service, new Service());
    }

    public function removeServiceLink($id, AddRemoveServiceLink $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=removeservicelink', $datas->toArray());
        return $this->format($service, new Service());
    }

    public function restart($id)
    {
        $data = [
            'rollingRestartStrategy' => [
                "batchSize" =>   1,
                "intervalMillis"    =>  2000
            ]
        ];
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=restart', $data);
        return $this->format($service, new Service());
    }

    public function rollback($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=rollback', []);
        return $this->format($service, new Service());
    }

    public function setServiceLinks($id, SetServiceLinks $links)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=setservicelinks', $links->toArray());
        return $this->format($service, new Service());
    }

    public function upgrade($id, ServiceUpgrade $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=upgrade', $datas->toArray());
        return $this->format($service, new Service());
    }
}
