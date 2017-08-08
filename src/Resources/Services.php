<?php
namespace Tyldar\Rancher\Resources;

use Tyldar\Rancher\Inputs\AddRemoveServiceLink;
use Tyldar\Rancher\Inputs\SetServiceLinks;
use Tyldar\Rancher\Inputs\UpgradeService;

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

    private function format($service)
    {
        unset($service->links);
        unset($service->actions);

        $tmp = new Service();
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

            array_push($retn, $this->format($service));
        }
        return $retn;
    }

    public function get($id)
    {
        $service = $this->client->request('GET', $this->endpoint.'/'.$id, []);
        return $this->format($service);
    }
    
    public function activate($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=activate', []);
        return $this->format($service);
    }

    public function addServiceLink($id, AddRemoveServiceLink $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=addservicelink', $datas);
        return $this->format($service);
    }

    public function cancelUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=cancelupgrade', []);
        return $this->format($service);
    }

    public function continueUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=continueupgrade', []);
        return $this->format($service);
    }

    public function deactivate($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=deactivate', []);
        return $this->format($service);
    }

    public function finishUpgrade($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=finishupgrade', []);
        return $this->format($service);
    }

    public function removeServiceLink($id, AddRemoveServiceLink $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=removeservicelink', $datas);
        return $this->format($service);
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
        return $this->format($service);
    }

    public function rollback($id)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=rollback', []);
        return $this->format($service);
    }

    public function setServiceLinks($id, SetServiceLinks $links)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=setservicelinks', $links);
        return $this->format($service);
    }

    public function upgrade($id, UpgradeService $datas)
    {
        $service = $this->client->request('POST', $this->endpoint.'/'.$id.'?action=upgrade', $datas);
        return $this->format($service);
    }
}