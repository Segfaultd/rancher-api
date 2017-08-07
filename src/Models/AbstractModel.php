<?php
namespace Tyldar\Rancher\Models;

class AbstractModel
{
    public function set($data) {
        foreach ($data as $key => $value)
        {
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }
}