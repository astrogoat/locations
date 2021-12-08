<?php

namespace Astrogoat\Locations;

use Astrogoat\Locations\Http\Livewire\Models\LocationForm;
use Astrogoat\Locations\Settings\LocationsSettings;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Menu;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LocationsServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('locations')
            ->settings(LocationsSettings::class)
            ->menu(function (Menu $menu) {
                $menu->addToGroup(
                    Menu::MAIN_GROUPS['PRIMARY'],
                    Link::to(route('lego.locations.index'), 'Locations')
                        ->after('Products')
                        ->icon(Icon::LOCATION_MARKER)
                );
            })
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('locations')->hasViews();
    }

    public function bootingPackage()
    {
        Livewire::component('astrogoat.locations.location-form', LocationForm::class);
    }
}
