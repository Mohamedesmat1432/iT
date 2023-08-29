{{-- confirm add && edit comapny --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->companyId) ? __('Edit Company') : __('Create New Company') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter company name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" type="text" class="mt-1 block w-full"
                    wire:model.debounce.500ms="address" placeholder="{{ __('Enter company address') }}" />
                <x-input-error for="address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" type="text" class="mt-1 block w-full"
                    wire:model.debounce.500ms="phone" placeholder="{{ __('Enter company phone') }}" />
                <x-input-error for="phone" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        @if ($this->companyId)
            <x-indigo-button class="ml-3" wire:click.prevent="updateCompany()" wire:loading.attr="disabled">
                {{ __('Update Company') }}
            </x-indigo-button>
        @else
            <x-indigo-button class="ml-3" wire:click.prevent="saveCompany()" wire:loading.attr="disabled">
                {{ __('Save Company') }}
            </x-indigo-button>
        @endif

    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit comapny --}}
