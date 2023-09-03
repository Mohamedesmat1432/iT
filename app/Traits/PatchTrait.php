<?php

namespace App\Traits;

use Livewire\WithPagination;

trait PatchTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $patch, $patchId, $port;

    protected function rules()
    {
        return [
            'port' => 'required|string|min:2',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['patchId', 'port']);
    }
}
