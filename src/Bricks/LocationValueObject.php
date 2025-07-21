<?php

namespace Astrogoat\Locations\Bricks;

use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class LocationValueObject extends BrickValueObject
{
    protected array $cache = [];

    public function getLocationModel()
    {
        if (isset($this->cache[$this->getValue()])) {
            return $this->cache[$this->getValue()];
        }

        $this->cache[$this->getValue()] = \Astrogoat\Locations\Models\Location::find($this->getValue());

        return $this->cache[$this->getValue()];
    }

    public function forJavascript()
    {
        return $this->value ?? '';
    }

    public function __toString()
    {
        return '';
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}
