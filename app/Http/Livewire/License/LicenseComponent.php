<?php

namespace App\Http\Livewire\License;

use App\Models\License;
use Livewire\Component;
use App\Exports\LicensesExport;
use App\Imports\LicensesImport;
use App\Models\Company;
use App\Traits\LicenseTrait;

class LicenseComponent extends Component
{
    use LicenseTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(License $license, Company $company)
    {
        $this->license = $license;
        $this->company = $company;
    }

    public function render()
    {
        $companies = $this->company->get();

        $licenses = $this->license->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('file', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.license.license-component', [
            'licenses' => $licenses,
            'companies' => $companies
        ]);
    }

    public function confirmLicenseAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmLicenseEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $license = $this->license->findOrFail($id);
        $this->licenseId = $license->id;
        $this->name = $license->name;
        $this->company_id = $license->company_id;
        $this->file = $license->file;
        $this->files = $license->files;
        $this->start_date = $license->start_date;
        $this->end_date = $license->end_date;
    }

    public function confirmLicenseShow($id)
    {
        $this->resetItems();
        $this->confirmShow = true;
        $this->license = $this->license->findOrFail($id);
    }

    public function saveLicense()
    {
        $validated = $this->validate();
        if (isset($this->licenseId)) {
            $license = $this->license->findOrFail($this->licenseId);
            if ($this->newFile && $this->newFile !== '') {
                $this->deleteFile($license->file, 'licenses');
                $validated['file'] = $this->uploadFile($this->newFile, 'licenses');
            }
            if ($this->newFiles && $this->newFiles !== '') {
                $this->deleteFiles($license->files, 'licenses');
                $validated['files'] = $this->uploadFiles($this->newFiles, 'licenses');
            }
            $license->update($validated);
            $this->updateMessage('License');
        } else {
            $validated['file'] = $this->uploadFile($this->file, 'licenses');
            $validated['files'] = $this->uploadFiles($this->files, 'licenses');
            $this->license->create($validated);
            $this->createMessage('License');
        }
        $this->confirmForm = false;
    }

    public function confirmLicenseDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->licenseId = $id;
    }

    public function deleteLicense()
    {
        $license = $this->license->findOrFail($this->licenseId);
        $this->deleteFile($license->file, 'licenses');
        $this->deleteFiles($license->files, 'licenses');
        $license->delete();
        $this->deleteMessage('License');
        $this->confirmDeletion = false;
    }

    public function confirmImport()
    {
        $this->confirmImport = true;
    }

    public function importLicense(LicensesImport $importLicenses)
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        try {
            $this->importMessage(__('Licenses'));
            $this->confirmImport = false;
            return $importLicenses->import($this->file);
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }

    public function exportLicense(LicensesExport $exportLicenses)
    {
        try {
            $this->exportMessage(__('Licenses'));
            return $exportLicenses->download('licenses.xlsx');
        } catch (\Throwable $e) {
            $this->errorMessage($e->getMessage());
        }
    }
}
