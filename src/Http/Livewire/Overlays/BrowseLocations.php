<?php

namespace Astrogoat\Locations\Http\Livewire\Overlays;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Modal;
use Helix\Lego\Lego;
use Helix\Lego\Models\Contracts\Publishable;
use Illuminate\Support\Str;

class BrowseLocations extends Modal
{
    public string $locationInputId;

    public string $query = '';

    public $locations = [];

    public function mount($locationInputId)
    {
        $this->locationInputId = $locationInputId;
    }

    public function updatedQuery($query)
    {
        if (! $query) {
            return $this->locations = [];
        }

        $this->locations = Location::where(Location::getStoreKeyName(), 'LIKE', "%{$query}%")
            ->orWhere(Location::getAddressKeyName(), 'LIKE', "%{$query}%")
            ->get();
    }

    public function select($location)
    {
        $this->dispatchBrowserEvent($this->locationInputId, $location);

        $this->closeModal();
    }

    public function render()
    {
        return view('locations::livewire.overlays.browse-locations');
    }
}
