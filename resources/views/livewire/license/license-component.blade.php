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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Import') }}
                </x-indigo-button>
                <x-danger-button wire:click="exportLicense()" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
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
                                    {{ __('Company Id') }}
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
                                {{ $license->company_id }}
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
                                <x-status-date start="{{ $license->start_date }}" end="{{ $license->end_date }}" />
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    {{-- {{ __('Edit') }} --}}
                                </x-indigo-button>

                                <x-danger-button wire:click="confirmLicenseDeletion({{ $license->id }})"
                                    wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
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
