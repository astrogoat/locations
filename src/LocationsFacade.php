<?php

namespace Astrogoat\Locations;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Locations\Locations
 */
class LocationsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'locations';
    }
}
