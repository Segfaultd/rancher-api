<?php
namespace Tyldar\Rancher\Inputs;

abstract class AbstractInput
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