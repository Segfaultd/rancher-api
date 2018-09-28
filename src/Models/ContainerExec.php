<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class ContainerExec extends AbstractModel
{
    public $attachStdin;

    public $attachStdout;

    public $command;

    public $tty;
}
