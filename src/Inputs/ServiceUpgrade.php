<?php
namespace Tyldar\Rancher\Inputs;

use Tyldar\Rancher\Inputs\AbstractInput;

class ServiceUpgrade extends AbstractInput {
    public $inServiceStrategy;

    public $toServiceStrategy;
}