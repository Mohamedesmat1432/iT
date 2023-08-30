{{-- confirm import company --}}
<x-dialog-modal wire:model="confirmImport">
    <x-slot name="title">
        {{ __('Import Companies') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="file" value="{{ __('Choose File') }}" />
                <x-input id="file" type="file" class="mt-1 block w-full border p-1" wire:model.defer="file" />
                <x-input-error for="file" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmImport',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-indigo-button class="ml-3" wire:click="importCompany()" wire:loading.attr="disabled">
            {{ __('Import Comapny') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm import company --}}
