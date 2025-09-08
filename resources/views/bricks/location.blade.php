<div>
    @php($brickKey = isset($repeaterBrickName) ? "{$repeaterBrickName}.{$index}.{$brickName}" : $brickName)
    @php($locationInputId = md5($this->_id . '.' . $brickKey))

    <div
        x-on:{{ $locationInputId }}.window="$wire.set('{{ $brickKey . '.variations.' . $this->_contentVariation }}', $event.detail)"
        wire:key="{{ $brickKey . '.' . $this->_contentVariation }}"
    >
        <div class="sh-block sh-text-sm sh-font-medium sh-text-gray-700 sh-mb-0.5">Store</div>

        @if($this->get($brickKey, $this->_contentVariation)->getLocationModel())
            <span class="locations-inline-flex locations-items-center locations-py-0.5 locations-pl-2.5 locations-pr-1 locations-rounded-md locations-text-sm locations-font-medium locations-bg-gray-100 locations-text-gray-700">
                {{ $this->get($brickKey, $this->_contentVariation)->getLocationModel()->name }}
                <button
                    type="button"
                    class="locations-flex locations-shrink-0 locations-rounded-md locations-ml-1 locations-h-4 locations-w-4 locations-inline-flex locations-items-center locations-justify-center locations-text-gray-400 hover:locations-bg-gray-200 hover:locations-text-gray-500 focus:locations-outline-none focus:locations-bg-gray-500 focus:locations-text-white"
                    x-on:click="$wire.set('{{ $brickKey . '.variations.' . $this->_contentVariation }}', null)"
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
