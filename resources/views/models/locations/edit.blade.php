@extends('lego::layouts.lego')

@section('content')
    <x-fab::layouts.page
        title="{{ $location->name }}"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Locations', 'url' => route('lego.locations.index')],
            ['title' => $location->name],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('saving')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('saving')"{{-- For PC  --}}
    >
        <livewire:astrogoat.locations.location-form :location="$location"/>

    </x-fab::layouts.page>

@endsection
