<?php
namespace Astrogoat\Locations\Http\Controllers;

use Astrogoat\Locations\Models\Location;
use Illuminate\Routing\Controller;

class LocationsController extends Controller {

    public function index() {
        $locations = Location::paginate(20);
        return view('locations::models.locations.index', compact('locations'));
    }

    public function create() {
        return view('locations::models.locations.create');
    }

    public function edit(Location $location) {
        return view('locations::models.locations.edit', compact('location'));
    }
}
