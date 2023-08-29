<?php

namespace App\Traits;

use Livewire\WithPagination;

trait DepartmentTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $department, $departmentId, $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:departments,name,' . $this->departmentId
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['departmentId', 'name']);
    }
}
