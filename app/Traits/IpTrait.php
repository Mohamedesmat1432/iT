<?php

namespace App\Traits;

use Livewire\WithPagination;

trait IpTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $ip, $ipId, $number;

    protected function rules()
    {
        return [
            'number' => 'required|string|min:2|unique:ips,number,' . $this->ipId,
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['ipId', 'number']);
    }
}
