{{-- confirm add && edit ip --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->ipId) ? __('Edit Ip') : __('Create New Ip') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="number" value="{{ __('Number') }}" />
                <x-input id="number" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="number"
                    placeholder="{{ __('Enter ip number') }}" />
                <x-input-error for="number" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveIp()" wire:loading.attr="disabled">
            {{ __('Save Ip') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit ip --}}
