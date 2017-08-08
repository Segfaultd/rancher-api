<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class Service extends AbstractModel
{
    public $assignServiceIpAddress;

    public $createIndex;

    public $currentScale;

    public $data;

    public $description;

    public $externalId;

    public $fqdn;

    public $healthState;

    public $id;

    public $instanceIds;

    public $launchConfig;

    public $lbConfig;

    public $linkedServices;

    public $metadata;

    public $name;

    public $publicEndpoints;

    public $retainIp;

    public $scale;

    public $scalePolicy;

    public $secondaryLaunchConfigs;

    public $selectorContainer;

    public $selectorLink;

    public $stackId;

    public $startOnCreate;

    public $system;

    public $upgrade;

    public $vip;

    public $_readOnlyFields = ["createIndex", "currentScale", "data", "fqdn", "healthState", "id", "instanceIds", "linkedServices", "system", "upgrade"];
};