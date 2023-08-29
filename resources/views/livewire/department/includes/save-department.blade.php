{{-- confirm add && edit department --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->departmentId) ? __('Edit Department') : __('Create New Department') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter department name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
        </form>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        @if ($this->departmentId)
            <x-indigo-button class="ml-3" wire:click.prevent="updateDepartment()" wire:loading.attr="disabled">
                {{ __('Update Department') }}
            </x-indigo-button>
        @else
            <x-indigo-button class="ml-3" wire:click.prevent="saveDepartment()" wire:loading.attr="disabled">
                {{ __('Save Department') }}
            </x-indigo-button>
        @endif

    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit department --}}
