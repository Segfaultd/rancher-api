<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class Stack extends AbstractModel
{
    public $answers;

    public $binding;

    public $data;

    public $description;

    public $dockerCompose;

    public $environment;

    public $externalId;

    public $group;

    public $healthState;

    public $id;

    public $name;

    public $outputs;

    public $previousEnvironment;

    public $previousExternalId;

    public $rancherCompose;

    public $serviceIds;

    public $startOnCreate;

    public $system;

    public $templates;
}