@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.locations.location-form :location="\Astrogoat\Locations\Models\Location::make()" />
@endsection
