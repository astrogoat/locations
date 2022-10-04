<?php

namespace Astrogoat\Locations;

use Astrogoat\Locations\Http\Livewire\Models\LocationForm;
use Astrogoat\Locations\Http\Livewire\Models\LocationIndex;
use Astrogoat\Locations\Http\Livewire\Overlays\BrowseLocations;
use Astrogoat\Locations\Models\Location;
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
            ->models([
                Location::class,
            ])
            ->menu(function (Menu $menu) {
                $menu->addToSection(
                    Menu::MAIN_SECTIONS['PRIMARY'],
                    Link::to(route('lego.locations.index'), 'Locations')
                        ->after('Products')
                        ->icon(Icon::LOCATION_MARKER)
                );
            })
            ->publishOnInstall([
                'locations-assets',
            ])
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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/locations'),
            ], 'locations-assets');
        }

        Livewire::component('astrogoat.locations.location-form', LocationForm::class);
        Livewire::component('astrogoat.locations.http.livewire.models.location-index', LocationIndex::class);
        Livewire::component('astrogoat.locations.browse-locations', BrowseLocations::class);
    }
}
