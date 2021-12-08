@extends('lego::layouts.lego')

@section('content')
    <x-fab::layouts.page
        title="New location"
        :breadcrumbs="[
            ['title' => 'Locations', 'url' => route('lego.locations.index')],
            ['title' => 'New'],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('saving')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('saving')"{{-- For PC  --}}
    >
        <livewire:astrogoat.locations.location-form :location="\Astrogoat\Locations\Models\Location::make()"/>

    </x-fab::layouts.page>

@endsection
