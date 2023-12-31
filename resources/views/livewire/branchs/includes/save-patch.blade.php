{{-- confirm add && edit patch --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->patchId) ? __('Edit Patch') : __('Create New Patch') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="port" value="{{ __('Port') }}" />
                <x-input id="port" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="port"
                    placeholder="{{ __('Enter patch port') }}" />
                <x-input-error for="port" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="savePatch()" wire:loading.attr="disabled">
            {{ __('Save Patch') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit patch --}}
