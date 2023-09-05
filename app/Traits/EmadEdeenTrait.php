<?php

namespace App\Traits;

use Livewire\WithPagination;

trait EmadEdeenTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $emadEdeen, $emadEdeenId, $name, $email;
    public $department_id, $ip_id, $switch_id, $patch_id;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:emad_edeens,email,' . $this->emadEdeenId,
            'department_id' => 'nullable|numeric|exists:departments,id',
            'ip_id' => 'nullable|numeric|exists:ips,id',
            'switch_id' => 'nullable|numeric|exists:switch_branchs,id',
            'patch_id' => 'nullable|numeric|exists:patch_branchs,id',
        ];

        return $rules;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset([
            'emadEdeenId', 'name', 'email',
            'ip_id', 'department_id', 'switch_id', 'patch_id'
        ]);
    }
}
