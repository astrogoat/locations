<?php

namespace Astrogoat\Locations\Http\Livewire\Models;

use Astrogoat\Locations\Models\Location;
use Helix\Lego\Http\Livewire\Models\Index;

class LocationIndex extends Index
{
    public function model() : string
    {
        return Location::class;
    }

    public function columns() : array
    {
        return [
            'name' => 'Name',
            'updated_at' => 'Last updated',
        ];
    }

    public function mainSearchColumn() : string|false
    {
        return 'name';
    }

    public function render()
    {
        return view('locations::models.locations.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
