<div>
    @include('livewire.license.includes.save-license')

    @include('livewire.license.includes.delete-license')

    @include('livewire.license.includes.import-license')


    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex justify-between">
            <h1 class=" text-2xl font-medium text-gray-900">
                {{ __('Licenses') }}
            </h1>
            <x-indigo-button wire:click="confirmLicenseAdd()" wire:loading.attr="disabled">
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
                <x-danger-button wire:click="exportLicense()" wire:loading.attr="disabled">
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
                                <button wire:click="sortBy('company_id')">
                                    {{ __('Company') }}
                                </button>
                                <x-sort-icon sortField="company_id" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('file')">
                                    {{ __('File') }}
                                </button>
                                <x-sort-icon sortField="file" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('files')">
                                    {{ __('Files') }}
                                </button>
                                <x-sort-icon sortField="files" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button>
                                    {{ __('Status') }}
                                </button>
                                <x-sort-icon sortField="status" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('start_date')">
                                    {{ __('Start Date') }}
                                </button>
                                <x-sort-icon sortField="start_date" :sortBy="$sortBy" :sortAsc="$sortAsc" />
                            </div>
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center">
                                <button wire:click="sortBy('end_date')">
                                    {{ __('End Date') }}
                                </button>
                                <x-sort-icon sortField="end_date" :sortBy="$sortBy" :sortAsc="$sortAsc" />
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
                    @foreach ($licenses as $license)
                        <tr>
                            <td class="p-2 border">
                                {{ $license->id }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->name }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->company->name ?? '' }}
                            </td>
                            <td class="p-2 border">
                                <a href="{{ asset('files/licenses/' . $license->file) }}" target="_blank">
                                    {{ $license->file }}
                                </a>

                            </td>
                            <td class="p-2 border">
                                @if ($license->files)
                                    @foreach (explode(',', $license->files) as $file)
                                        <a href="{{ asset('files/licenses/' . $file) }}" target="_blank">
                                            {{ $file }}
                                        </a>
                                        <br />
                                    @endforeach
                                @endif
                            </td>
                            <td class="p-2 border">
                                <x-status-date start="{{ now() }}" end="{{ $license->end_date }}" />
                            </td>
                            <td class="p-2 border">
                                {{ $license->start_date }}
                            </td>
                            <td class="p-2 border">
                                {{ $license->end_date }}
                            </td>
                            <td class="p-2 border">
                                <x-indigo-button wire:click="confirmLicenseEdit({{ $license->id }})"
                                    wire:loading.attr="disabled">
                                    <x-icon class="w-4 h-4" name="pencil-square" />
                                    {{-- {{ __('Edit') }} --}}
                                </x-indigo-button>

                                <x-danger-button wire:click="confirmLicenseDeletion({{ $license->id }})"
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
                {{ $licenses->links() }}
            </div>
        </div>

    </div>
</div>
