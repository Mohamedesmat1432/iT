<?php

namespace App\Traits;

use Livewire\WithPagination;

trait SwitchTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $switch, $switchId, $port;

    protected function rules()
    {
        return [
            'port' => 'required|string|min:2|unique:switch_branchs,port,' . $this->switchId,
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['switchId', 'port']);
    }
}
