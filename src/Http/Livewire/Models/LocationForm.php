<?php

namespace Astrogoat\Locations\Http\Livewire\Models;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Rules\SlugRule;

class LocationForm extends Form
{
    use CanBePublished;

    public function rules()
    {
        return [
            'model.name' => 'required',
            'model.slug' => [new SlugRule($this->model)],
            'model.indexable' => 'nullable',
            'model.address' => 'nullable',
            'model.contact_phone_number' => 'nullable',
            'model.display_phone_number' => 'nullable',
            'model.lat' => 'nullable',
            'model.lng' => 'nullable',
            'model.place_id' => 'nullable',
            'model.open_hours' => 'nullable',
            'model.layout' => 'required',
            'model.footer_id' => 'nullable',
            'model.published_at' => 'nullable',
        ];
    }

    public function mount($location = null)
    {
        $this->setModel($location);

        if (! $this->model->exists) {
            $this->model->indexable = true;
            $this->model->layout = array_key_first(siteLayouts());
        }
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);

        if ($property == 'location.footer_id' && ! $value) {
            $this->model->footer_id = null;
        }
    }

    public function view(): string
    {
        return 'locations::models.locations.form';
    }

    public function model(): string
    {
        return Location::class;
    }

    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }

    public function setLatLng($address, $lat, $lng, $place_id)
    {
        $this->model->address = $address;
        $this->model->lat = $lat;
        $this->model->lng = $lng;
        $this->model->place_id = $place_id;
    }

    public function getPublishableModel(): Publishable
    {
        return $this->model;
    }
}
