<?php

namespace Astrogoat\Locations\Http\Livewire\Models;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Str;

class LocationForm extends Form
{
    use CanBePublished;

    public Location $location;

    public function rules()
    {
        return [
            'location.name' => 'required',
            'location.slug' => [new SlugRule($this->location)],
            'location.indexable' => 'nullable',
            'location.address' => 'nullable',
            'location.contact_phone_number' => 'nullable',
            'location.display_phone_number' => 'nullable',
            'location.lat' => 'nullable',
            'location.lng' => 'nullable',
            'location.place_id' => 'nullable',
            'location.mattress_assortment' => 'required',
            'location.open_hours' => 'nullable',
            'location.layout' => 'required',
            'location.footer_id' => 'nullable',
            'location.published_at' => 'nullable',
        ];
    }

    public function mounted()
    {
        if (! $this->location->exists) {
            $this->location->indexable = true;
            $this->location->layout = array_key_first(siteLayouts());
        }
    }

    public function saved()
    {
        if ($this->location->wasRecentlyCreated) {
            return redirect()->to(route('lego.locations.edit', $this->location));
        }
    }

    public function updating($property, $value)
    {
        parent::updating($property, $value);

        if ($property == 'location.name' && ! $this->location->exists) {
            $this->location->slug = Str::slug($value);
        }
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);

        if ($property == 'location.footer_id' && ! $value) {
            $this->location->footer_id = null;
        }
    }

    public function render()
    {
        return view('locations::models.locations.form');
    }

    public function getModel(): Model
    {
        return $this->location;
    }

    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }

    public function setLatLng($address, $lat, $lng, $place_id)
    {
        $this->location->address = $address;
        $this->location->lat = $lat;
        $this->location->lng = $lng;
        $this->location->place_id = $place_id;
    }

    public function getPublishableModel(): Publishable
    {
        return $this->location;
    }
}
