<?php

namespace App\Http\Livewire\License;

use App\Models\License;
use Livewire\Component;
use App\Exports\LicensesExport;
use App\Imports\LicensesImport;
use App\Traits\LicenseTrait;

class LicenseComponent extends Component
{
    use LicenseTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(License $license)
    {
        $this->license = $license;
    }

    public function render()
    {
        $licenses = $this->license->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('file', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.license.license-component', [
            'licenses' => $licenses
        ]);
    }

    public function confirmLicenseAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function saveLicense()
    {
        $validated = $this->validate();
        $validated['file'] = $this->uploadFile($this->file, 'licenses');
        $validated['files'] = $this->uploadFiles($this->files, 'licenses');
        $this->license->create($validated);
        $this->createMessage('License');
        $this->confirmForm = false;
    }

    public function confirmLicenseEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $license = $this->license->findOrFail($id);
        $this->licenseId = $license->id;
        $this->name = $license->name;
        $this->phone = $license->phone;
        $this->file = $license->file;
        $this->files = $license->files;
        $this->start_date = $license->start_date;
        $this->end_date = $license->end_date;
    }

    public function updateLicense()
    {
        $validated = $this->validate();
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

    public function importLicense()
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        session()->flash('message', __('Licenses has been improted successfully'));
        $this->confirmImport = false;
        return (new LicensesImport)->import($this->file);
    }

    public function exportLicense()
    {
        session()->flash('message', __('Licenses has been exported successfully'));
        return (new LicensesExport)->download('licenses.xlsx');
    }
}