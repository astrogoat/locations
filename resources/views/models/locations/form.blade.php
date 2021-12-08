
<x-fab::layouts.main-with-aside>
    <x-fab::layouts.panel>
        <x-fab::forms.input
            label="Store name"
            wire:model="location.store_name"
        />

        <x-fab::forms.input
            label="Partner name"
            wire:model="location.partner_name"
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>
        <x-fab::forms.input
            label="Contact phone number"
            wire:model="location.store_contact_phone_number"
            help="Only numbers. For user to be able to click a phone number on their device."
        />

        <x-fab::forms.input
            label="Contact Display phone number"
            wire:model="location.store_display_phone_number"
            help="Use this field to show the formatted phone number. Example: '+1 123-456-7890'"
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>

        <x-fab::forms.input
            wire:model="location.store_address"
            label="Store address"
            help="Address provided would also be used for Google Maps display on store page."
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>

        <x-fab::forms.input
            wire:model="location.store_page_url"
            label="Store page url"
        />

    </x-fab::layouts.panel>

    <x-fab::layouts.panel>

        <x-fab::forms.textarea
            wire:model="location.store_hours"
            label="Store hours"
        />

    </x-fab::layouts.panel>

    <x-slot name="aside">
        @if($location->exists)
            <x-fab::elements.button
                wire:click="deleting"
                class="text-red-500"
            >
                <x-fab::elements.icon
                    icon="trash"
                    type="solid"
                    class="-ml-1 mr-2 h-5 w-5 text-red-500"
                />
                Delete
            </x-fab::elements.button>
        @endif
    </x-slot>
</x-fab::layouts.main-with-aside>
