<?php

namespace App\Traits;

use Livewire\WithPagination;

trait LicenseTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $license, $licenseId, $company, $company_id, $name, $start_date, $end_date;

    protected function rules()
    {
        $rules =  [
            'name' => 'required|string|min:3',
            'company_id' => 'nullable|numeric|exists:companies,id',
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
            'licenseId', 'name', 'company_id', 'start_date', 'end_date',
            'file', 'newFile', 'files', 'newFiles'
        ]);
    }
}
