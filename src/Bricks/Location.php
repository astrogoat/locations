<?php
namespace Astrogoat\Locations\Bricks;

use Helix\Lego\Bricks\Brick;
use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class Location extends Brick {

    public function hydrate($value): BrickValueObject
    {
        return new LocationValueObject($value);
    }

    public function getDefaults()
    {
        return $this->default;
    }

    public function brickView() : string
    {
        return 'locations::bricks.location';
    }
}
