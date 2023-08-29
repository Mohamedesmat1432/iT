{{-- confirm add && edit license --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->licenseId) ? __('Edit License') : __('Create New License') }}
    </x-slot>

    <x-slot name="content">
        <form enctype="multipart/form-data">
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter license name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="phone"
                    placeholder="{{ __('Enter license phone') }}" />
                <x-input-error for="phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="file" value="{{ __('File') }}" />
                @if (isset($this->licenseId))
                    <x-input id="file" type="file" class="mt-1 block w-full" wire:model="newFile" />
                    <x-input-error for="newFile" class="mt-2" />
                @else
                    <x-input id="file" type="file" class="mt-1 block w-full" wire:model="file" />
                    <x-input-error for="file" class="mt-2" />
                @endif
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="file" value="{{ __('Files') }}" />
                @if (isset($this->licenseId))
                    <x-input id="newFiles" type="file" class="mt-1 block w-full" wire:model="newFiles" multiple/>
                    <x-input-error for="newFiles.*" class="mt-2" />
                @else
                    <x-input id="files" type="file" class="mt-1 block w-full" wire:model="files" multiple/>
                    <x-input-error for="files.*" class="mt-2" />
                @endif
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="start_date" value="{{ __('Start Date') }}" />
                <x-input id="start_date" type="date" class="mt-1 block w-full"
                    wire:model.debounce.500ms="start_date" />
                <x-input-error for="start_date" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="end_date" value="{{ __('End Date') }}" />
                <x-input id="end_date" type="date" class="mt-1 block w-full" wire:model.debounce.500ms="end_date" />
                <x-input-error for="end_date" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        @if (isset($this->licenseId))
            <x-indigo-button class="ml-3" wire:click.prevent="updateLicense()" wire:loading.attr="disabled">
                {{ __('Update License') }}
            </x-indigo-button>
        @else
            <x-indigo-button class="ml-3" wire:click.prevent="saveLicense()" wire:loading.attr="disabled">
                {{ __('Save License') }}
            </x-indigo-button>
        @endif

    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit license --}}
