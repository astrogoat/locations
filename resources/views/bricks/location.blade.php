<div>
    @php($brickKey = isset($repeaterBrickName) ? "{$repeaterBrickName}.{$index}.{$brickName}" : $brickName)
    @php($locationInputId = md5($this->_id . '.' . $brickKey))

    <div
        x-on:{{ $locationInputId }}.window="$wire.set('{{ $brickKey }}', $event.detail)"
    >
        <label for="" class="block text-sm font-medium text-gray-700 pb-1">Store</label>
        @if($this->get($brickKey)->getLocationModel())
            <span class="locations-inline-flex locations-items-center locations-py-0.5 locations-pl-2.5 locations-pr-1 locations-rounded-md locations-text-sm locations-font-medium locations-bg-gray-100 locations-text-gray-700">
                {{ $this->get($brickKey)->getLocationModel()->name }}
                <button
                    type="button"
                    class="locations-flex locations-shrink-0 locations-rounded-md locations-ml-1 locations-h-4 locations-w-4 locations-inline-flex locations-items-center locations-justify-center locations-text-gray-400 hover:locations-bg-gray-200 hover:locations-text-gray-500 focus:locations-outline-none focus:locations-bg-gray-500 focus:locations-text-white"
                    x-on:click="$wire.set('{{ $brickKey }}', null)"
                >
                    <span class="locations-sr-only">Remove Location</span>
                    <x-fab::elements.icon icon="x" type="solid" class="locations-h-3 locations-w-3" />
              </button>
            </span>
        @else
            <x-fab::elements.button
                size="sm"
                x-on:click="$modal.open('astrogoat.locations.browse-locations', {{ json_encode([
                'locationInputId' => $locationInputId
            ]) }})"
            >
                Select Location
            </x-fab::elements.button>
        @endif
    </div>
</div>

@push('styles')
    <link href="{{ asset('vendor/locations/css/locations.css') }}" rel="stylesheet">
@endpush
