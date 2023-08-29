<?php

namespace App\Traits;

use Livewire\WithPagination;

trait CompanyTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $company, $companyId, $name, $address, $phone;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'address' => 'required|string',
            'phone' => 'required|string|min:10'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['companyId', 'name', 'phone', 'address']);
    }
}
