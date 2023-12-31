{{-- confirm add && edit device --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->deviceId) ? __('Edit Device') : __('Create New Device') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Device Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter device name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="serial" value="{{ __('Serial') }}" />
                <x-input id="serial" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="serial"
                    placeholder="{{ __('Enter device serial') }}" />
                <x-input-error for="serial" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="specifications" value="{{ __('Specifications') }}" />
                <x-textarea id="specifications" type="text" class="mt-1 block w-full"
                    wire:model.debounce.500ms="specifications" placeholder="{{ __('Enter device specifications') }}">
                </x-textarea>
                <x-input-error for="specifications" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveDevice()" wire:loading.attr="disabled">
            {{ __('Save Device') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit device --}}
