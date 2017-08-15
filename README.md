# rancher-api
Bundle of PHP classes to interact with Rancher (Container Management System) API.

## Installation
RancherAPI uses compose to make installation easier.


**Install via composer** 
``` bash
composer require tyldar/rancher-api
```

## Usage
RancherAPI is incredibly intuitive to use. 

### Introduction
```php
<?php
require 'vendor/autoload.php';
use Tyldar\Rancher\Rancher;
try
{
    $rancher = new Rancher("RANCHERHOSTURL", "RANCHERACCESSKEY", "RANCHERSECRETKEY", "PROJECT");
    echo json_encode($rancher->containers()->getAll());
}
catch(Exception $e)
{
    var_dump($e->getResponse()->getBody()->getContents());
}
?>
```
