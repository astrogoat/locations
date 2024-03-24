<?php

namespace Astrogoat\Locations\Settings;

use Astrogoat\Locations\Actions\LocationsAction;
use Helix\Lego\Settings\AppSettings;

class LocationsSettings extends AppSettings
{
    public string $api_key;

    protected array $rules = [
         'api_key' => ['required'],
    ];


    public function description(): string
    {
        return 'Interact with Locations.';
    }
}
