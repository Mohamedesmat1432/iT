<?php

namespace App\Traits;

use Livewire\WithPagination;

trait LicenseTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $license, $licenseId, $name, $phone, $start_date, $end_date;

    protected function rules()
    {
        $rules =  [
            'name' => 'required|string|min:4',
            'phone' => 'required|string|min:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];

        if (isset($this->licenseId)) {
            $rules['newFile'] = $this->fileRule;
            $rules['newFiles.*'] = $this->fileRule;
        } else {
            $rules['file'] = $this->fileRule;
            $rules['files.*'] = $this->fileRule;
        }
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
            'licenseId', 'name', 'phone', 'start_date', 'end_date',
            'file', 'newFile', 'files', 'newFiles'
        ]);
    }
}
