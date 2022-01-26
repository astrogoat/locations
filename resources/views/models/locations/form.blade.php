
<div x-data="googleApi()">

    <x-fab::layouts.main-with-aside>
    <x-fab::layouts.panel>
        <x-fab::forms.input
            label="Store name"
            wire:model="location.name"
        />

        <x-fab::forms.input
            wire:model="location.slug"
            label="URL and handle (slug)"
            addon="{{ url('') . Route::getRoutes()->getByName('locations.show')->getPrefix() . '/' }}"
            help="The URL where this location can be viewed. Changing this will break any existing links users may have bookmarked."
            :disabled="! $location->exists"
        />

    </x-fab::layouts.panel>

        @include('lego::metafields.define', ['metafieldable' => $location])

    <x-fab::layouts.panel>
        <x-fab::forms.input
            label="Contact phone number"
            wire:model="location.contact_phone_number"
            help="Only numbers. For user to be able to click a phone number on their device."
        />

        <x-fab::forms.input
            label="Contact Display phone number"
            wire:model="location.display_phone_number"
            help="Use this field to show the formatted phone number. Example: '+1 123-456-7890'"
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>

        <x-fab::forms.input
            wire:model="location.address"
            x-on:input.debounce.500="getSuggestions($event.target.value)"
            label="Store address"
            help="Click an address from the suggestions list below to grab latitude and longitude values."
        />

        <div x-show="!suggestions.length == 0" class="z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
            <ul class="py-1">
                <template x-for="suggestion in suggestions">
                    <li class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" x-on:click="$wire.setLatLng(suggestion.formatted_address, suggestion.geometry.location.lat, suggestion.geometry.location.lng, suggestion.place_id); suggestions = [];"  x-text="suggestion.formatted_address">
                    </li>
                </template>
            </ul>
        </div>

        <x-fab::forms.input
            wire:model="location.lat"
            label="Latitude"
            help="This value would be populated when you select a suggested location and used for map marker."
            :disabled="true"
        />

        <x-fab::forms.input
            wire:model="location.lng"
            label="Longitude"
            help="This value would be populated when you select a suggested location and used for map marker."
            :disabled="true"
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>

{{--        <x-fab::forms.textarea--}}
{{--            wire:model="location.open_hours"--}}
{{--            label="Store hours"--}}
{{--        />--}}
        <x-fab::forms.editor
            wire:model="location.open_hours"
            label="Store hours"
            help="Use this field to format the store open hours."

        />

{{--        <x-fab::forms.input--}}
{{--            wire:model="location.open_hours"--}}
{{--            label="Store hours"--}}
{{--        />--}}

    </x-fab::layouts.panel>

    <x-slot name="aside">
        @if($location->exists)
            <x-fab::elements.button
                type="link"
                :url="Route::getRoutes()->getByName('locations.show')->getPrefix() . '/' . $location->slug"
                target="_blank"
                class="mb-4 mr-2"
            >
                <x-fab::elements.icon
                    icon="eye"
                    type="solid"
                    class="-ml-1 mr-2 h-5 w-5"
                />
                View
            </x-fab::elements.button>

            <x-fab::elements.button
                type="link"
                :url="route('lego.locations.editor', $location)"
                class="mb-4"
            >
                <x-fab::elements.icon
                    icon="adjustments"
                    type="solid"
                    class="-ml-1 mr-2 h-5 w-5"
                />
                Customize
            </x-fab::elements.button>
        @endif

            <x-fab::layouts.panel heading="Structure" class="mb-4">
                <x-fab::forms.select
                    wire:model="location.layout"
                    label="Layout"
                    help="The base layout for the page."
                >
                    <option disabled>-- Select layout</option>
                    <option value="">Default</option>
                    @foreach(siteLayouts() as $key => $layout)
                        <option value="{{ $key }}">{{ $layout }}</option>
                    @endforeach
                </x-fab::forms.select>

                <x-fab::forms.select
                    wire:model="location.footer_id"
                    label="Footer"
                >
                    <option value="">No footer</option>
                    @foreach($this->footers() as $id => $footer)
                        <option value="{{ $id }}">{{ $footer }}</option>
                    @endforeach
                </x-fab::forms.select>
            </x-fab::layouts.panel>

            @if($location->exists)
                <x-fab::layouts.panel>
                    <x-fab::elements.button
                        wire:click="deleting"
                        class="text-red-500"
                    >
                        <x-fab::elements.icon
                            icon="trash"
                            type="solid"
                            class="-ml-1 mr-2 h-5 w-5 text-red-500"
                        />
                        Delete location
                    </x-fab::elements.button>
                </x-fab::layouts.panel>
                @endif
    </x-slot>

</x-fab::layouts.main-with-aside>
    @push('styles')
        <link href="{{ asset('vendor/locations/css/locations.css') }}" rel="stylesheet">
    @endpush
    <script>
        function googleApi() {
            return {
                loading: false,
                error: '',
                 suggestions: [],
                getSuggestions(value) {
                    let address = value;
                    address = address.replace(/\s+/g, '%20').replace(/\#/g, '');

                    let requestUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address + "&key={{settings(\Astrogoat\Locations\Settings\LocationsSettings::class, 'api_key')}}";

                    fetch(requestUrl)
                        .then((res) => res.json())
                        .then((res) => {
                            if(res.status === 'OK') {
                                this.suggestions = res.results;
                            } else {
                                // console.log(res);
                            }
                        });
                }
            }
        }
    </script>
</div>

