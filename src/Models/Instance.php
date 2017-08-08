<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class Instance extends AbstractModel
{
    public $accountId;

    public $created;

    public $data;

    public $description;

    public $externalId;

    public $hostId;

    public $id;

    public $kind;

    public $name;

    public $removeTime;

    public $removed;

    public $state;

    public $transitionning;

    public $transitioningMessage;

    public $transitioningProgress;

    public $uuid;
};