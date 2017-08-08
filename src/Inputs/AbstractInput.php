<?php
namespace Tyldar\Rancher\Inputs;

class AbstractInput
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