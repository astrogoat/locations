<?php

namespace Astrogoat\Locations\Bricks;

use Helix\Lego\Bricks\Brick;

class Location extends Brick
{
    public function brickView(): string
    {
        return 'locations::bricks.location';
    }
}
