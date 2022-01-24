@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/locations/css/locations.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="New location"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Locations', 'url' => route('lego.locations.index')],
            ['title' => 'New'],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
    >
        <livewire:astrogoat.locations.location-form :location="\Astrogoat\Locations\Models\Location::make()"/>
    </x-fab::layouts.page>
@endsection
