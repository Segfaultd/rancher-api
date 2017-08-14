<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class Host extends AbstractModel
{
    public $agentId;

    public $agentIpAddress;

    public $agentState;

    public $amazonec2Config;

    public $apiProxy;

    public $authCertificateAuthority;

    public $authKey;

    public $azureConfig;
    
    public $computeTotal;

    public $data;

    public $description;

    public $digitaloceanConfig;

    public $dockerVersion;

    public $driver;

    public $engineEnv;

    public $engineInsecureRegistry;

    public $engineInstallUrl;

    public $engineLabel;

    public $engineOpt;

    public $engineRegistryMirror;

    public $engineStorageDriver;

    public $hostTemplateId;

    public $id;

    public $info;

    public $instanceIds;
    
    public $labels;

    public $hostname;

    public $localStorageMb;

    public $memory;

    public $milliCpu;

    public $name;

    public $packetConfig;

    public $physicalHostId;

    public $publicEndpoints;

    public $stackId;
}