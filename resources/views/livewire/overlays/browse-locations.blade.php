<x-fab::overlays.simple
    class=""
>
    <div class="p-4"
    >
        <x-fab::forms.input
            placeholder="Search..."
            x-on:fab-input.debounce.500="$wire.set('query', $event.detail)"
        >
            <x-slot name="icon">
                <x-fab::elements.icon icon="search" class="h-5 w-5" />
            </x-slot>
        </x-fab::forms.input>
    </div>

    <nav class="h-full overflow-y-auto">
        <ul role="list" class="relative z-0 divide-y divide-gray-200">
            @foreach($locations as $location)
                <li wire:click="select('{{ $location->id }}')" class="bg-white">
                    <div class="relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                        <div class="flex-shrink-0">
                            <x-fab::elements.icon icon="location-marker" type="outline" class="h-8 w-8" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="#" class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $location->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $location->address }}
                                </p>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </nav>

</x-fab::overlays.simple>
