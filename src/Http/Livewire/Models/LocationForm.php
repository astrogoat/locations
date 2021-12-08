<?php

namespace Astrogoat\Locations\Http\Livewire\Models;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Models\Page;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class LocationForm extends Form
{

    public Location $location;

    public function rules()
    {
        return [
            'location.store_name' => 'required',
            'location.partner_name' => 'required',
            'location.store_address' => 'required',
            'location.store_contact_phone_number' => 'required',
            'location.store_display_phone_number' => 'required',
            'location.store_page_url' => 'required',
            'location.store_hours' => 'required',
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

    public function getModel() : Model
    {
        return $this->location;
    }
}
