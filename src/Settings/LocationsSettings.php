<?php

namespace Astrogoat\Locations\Settings;

use Astrogoat\Locations\Actions\LocationsAction;
use Helix\Lego\Settings\AppSettings;

class LocationsSettings extends AppSettings
{
    // public string $url;
    // public string $access_token;

    protected array $rules = [
        // 'url' => ['required', 'url'],
        // 'access_token' => ['required'],
    ];

    protected static array $actions = [
        // LocationsAction::class,
    ];

    // public static function encrypted(): array
    // {
    //     return ['access_token'];
    // }

    public function description(): string
    {
        return 'Interact with Locations.';
    }
}
