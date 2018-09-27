<?php
require 'vendor/autoload.php';

use Tyldar\Rancher\Rancher;

try
{
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    $rancher = new Rancher(getenv('RANCHER_URL'), getenv('RANCHER_ACCESS'), getenv('RANCHER_SECRET'), "1a5");

    echo json_encode($rancher->stacks()->getAll());
    
}
catch(Exception $e)
{
    var_dump($e->getResponse()->getBody()->getContents());
}

?>