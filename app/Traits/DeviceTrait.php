<?php

namespace App\Traits;

use Livewire\WithPagination;

trait DeviceTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $device, $deviceId, $name, $serial, $specifications;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2',
            'serial' => 'required|numeric|min:2',
            'specifications' => 'nullable|string|max:500',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['deviceId', 'name', 'serial', 'specifications']);
    }
}
