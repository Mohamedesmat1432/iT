<?php

namespace App\Traits;

use Livewire\WithPagination;

trait CompanyTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $company, $companyId, $name, $email, $address, $phone;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'email' => 'nullable|string|email',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|min:10'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['companyId', 'name', 'email', 'phone', 'address']);
    }
}
