{{-- confirm add && edit User --}}
<x-dialog-modal wire:model="confirmForm">
    <x-slot name="title">
        {{ isset($this->userId) ? __('Edit User') : __('Create New User') }}
    </x-slot>

    <x-slot name="content">
        <form>
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="name"
                    placeholder="{{ __('Enter user name') }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="text" class="mt-1 block w-full" wire:model.debounce.500ms="email"
                    placeholder="{{ __('Enter user email') }}" />
                <x-input-error for="email" class="mt-2" />
            </div>
            @if (!$this->userId)
                <div class="col-span-6 sm:col-span-4 mt-3">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" type="password" class="mt-1 block w-full"
                        wire:model.debounce.500ms="password" placeholder="{{ __('Enter user password') }}" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            @endif
            <div class="col-span-6 sm:col-span-4 mt-3">
                <x-label for="role" value="{{ __('Role') }}" />
                <x-select id="role" class="mt-1 block w-full" wire:model="role">
                    <option value="#">{{ __('Select Role') }}</option>
                    <option value="admin">{{ __('Admin') }}</option>
                    <option value="support">{{ __('Support') }}</option>
                    <option value="user">{{ __('User') }}</option>
                </x-select>
                <x-input-error for="role" class="mt-2" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmForm',false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>
        <x-indigo-button class="ml-3" wire:click.prevent="saveUser()" wire:loading.attr="disabled">
            {{ __('Save User') }}
        </x-indigo-button>
    </x-slot>
</x-dialog-modal>
{{-- end confirm add && edit User --}}
