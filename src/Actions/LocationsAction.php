<?php

namespace Astrogoat\Locations\Actions;

use Helix\Lego\Apps\Actions\Action;

class LocationsAction extends Action
{
    public static function actionName(): string
    {
        return 'Locations action name';
    }

    public static function run(): mixed
    {
        return redirect()->back();
    }
}
