<?php

namespace Panda;

class Request
{
    public function __construct($params = [])
    {
        foreach ($params as $name => $value) {

            if (!property_exists($this, $name)) {
                throw new \InvalidArgumentException("Property [$name] not exists in " . get_class($this));
            }

            $this->{$name} = $value;
        }
    }
}
