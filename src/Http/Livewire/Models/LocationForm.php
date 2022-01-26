<?php

namespace Astrogoat\Locations\Http\Livewire\Models;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Str;

class LocationForm extends Form
{
    public Location $location;

    public function rules()
    {
        return [
            'location.name' => 'required',
            'location.slug' => [new SlugRule($this->location)],
            'location.address' => 'required',
            'location.contact_phone_number' => 'nullable',
            'location.display_phone_number' => 'nullable',
            'location.open_hours' => 'nullable',
            'location.lat' => 'nullable',
            'location.lng' => 'nullable',
            'location.place_id' => 'nullable',
            'location.layout' => 'nullable',
            'location.footer_id' => 'nullable',
        ];
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

    public function deleted()
    {
        return redirect()->to(route('lego.locations.index'));
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
}
