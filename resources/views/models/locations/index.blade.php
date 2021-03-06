@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/locations/css/locations.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="Locations"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Locations'],
        ]"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.locations.create')">Create</x-fab::elements.button>
        </x-slot>

        <x-fab::lists.table>
            <x-slot name="headers">
                <x-fab::lists.table.header>Name</x-fab::lists.table.header>
                <x-fab::lists.table.header>Last updated</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Customize</x-fab::lists.table.header>
            </x-slot>

            @foreach($locations as $location)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.locations.edit', $location) }}">{{ $location->name }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">{{ $location->updated_at->toFormattedDateString() }}</x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right" slim>
                        <a href="{{ route('lego.locations.edit', $location) }}">Edit</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">
                        <a href="{{ route('lego.locations.editor', $location) }}">Customize</a>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        <div class="pt-6">
            {{ $locations->links() }}
        </div>
    </x-fab::layouts.page>
@endsection
