<?php

namespace Astrogoat\Locations\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model as LegoModel;

class Location extends LegoModel
{
    protected $table = 'locations_table';

    public static function icon(): string
    {
        return Icon::EYE;
    }
}
