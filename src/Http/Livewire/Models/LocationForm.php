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
            'location.store_name' => 'required',
            'location.slug' => [new SlugRule($this->location)],
            'location.partner_name' => 'required',
            'location.store_address' => 'required',
            'location.store_contact_phone_number' => 'required',
            'location.store_display_phone_number' => 'required',
            'location.store_hours' => 'required',
            'location.lat' => 'required',
            'location.lng' => 'required',
            'location.layout' => 'nullable',
            'location.footer_id' => 'nullable',
        ];
    }

    public function save()
    {
        $this->location->save();
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

        if ($property == 'location.store_name' && ! $this->location->exists) {
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

    public function delete()
    {
        $this->location->delete();
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

    public function setLatLng($address, $lat, $lng) {
        $this->location->store_address = $address;
        $this->location->lat = $lat;
        $this->location->lng = $lng;
    }
}
