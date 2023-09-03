<div>
    @include('livewire.company.includes.save-company')

    @include('livewire.company.includes.delete-company')

    @include('livewire.company.includes.import-company')

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Companies') }}
            </h1>
            <x-indigo-button wire:click="confirmCompanyAdd()" wire:loading.attr="disabled">
                <x-icon class="w-4 h-4" name="plus" />
                {{ __('Create') }}
            </x-indigo-button>
        </div>

        <div class="mt-6 text-gray-500 leading-relaxed">
            <div class="mt-3">
                <div class="flex justify-between">
                    <div>
                        <x-input type="search" wire:model.debounce.500ms="search"
                            placeholder="{{ __('Search ...') }}" />
                    </div>
                </div>
            </div>
            <div class="mt-3 flex">
                <x-indigo-button class="mr-2" wire:click="confirmImport()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4" name="arrow-up-circle" />
                    {{ __('Import') }}
                </x-indigo-button>
                <x-danger-button wire:click="exportCompany()" wire:loading.attr="disabled">
                    <x-icon class="w-4 h-4" name="arrow-down-circle" />
                    {{ __('Export') }}
                </x-danger-button>
            </div>
            <x-table>
                <x-slot name="thead">
                    <tr>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button class="flex items-center" wire:click="sortBy('id')">
                                    {{ __('ID') }}
                                </button>
                                <x-sort-icon sortField="id" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('name')">
                                    {{ __('Name') }}
                                </button>
                                <x-sort-icon sortField="name" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('email')">
                                    {{ __('Email') }}
                                </button>
                                <x-sort-icon sortField="email" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('address')">
                                    {{ __('Address') }}
                                </button>
                                <x-sort-icon sortField="address" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('contacts')">
                                    {{ __('Contacts') }}
                                </button>
                                <x-sort-icon sortField="contacts" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('specialization')">
                                    {{ __('Specialization') }}
                                </button>
                                <x-sort-icon sortField="specialization" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                {{ __('Action') }}
                            </div>
                        </td>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($companies as $company)
                        <tr>
                            <td class="p-2 border">
                                {{ $company->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->name }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->email }}
                            </td>
                            <td class="p-2 border">
                                {{ $company->address }}
                            </td>
                            <td class="p-2 border">
                                @foreach (explode(',', $company->contacts) as $contact)
                                    {{ $contact }}
                                    <br />
                                @endforeach
                            </td>
                            <td class="p-2 border">
                                {{ $company->specialization }}
                            </td>
                            <td class="p-2 border">
                                <x-indigo-button wire:click="confirmCompanyEdit({{ $company->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{-- {{ __('Edit') }} --}}
                                </x-indigo-button>
                                <x-danger-button wire:click="confirmCompanyDeletion({{ $company->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="trash" />
                                    {{-- {{ __('Delete') }} --}}
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <div class="mt-4">
                {{ $companies->links() }}
            </div>
        </div>
    </div>

</div>
