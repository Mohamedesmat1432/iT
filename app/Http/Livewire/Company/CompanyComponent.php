<?php

namespace App\Http\Livewire\Company;

use App\Exports\CompaniesExport;
use App\Imports\CompaniesImport;
use App\Models\Company;
use App\Traits\CompanyTrait;
use Livewire\Component;

class CompanyComponent extends Component
{
    use CompanyTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $companies = $this->company->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.company.company-component', [
            'companies' => $companies
        ]);
    }

    public function confirmCompanyAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmCompanyEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $company = $this->company->findOrFail($id);
        $this->companyId = $company->id;
        $this->name = $company->name;
        $this->address = $company->address;
        $this->phone = $company->phone;
    }

    public function saveCompany()
    {
        $validated = $this->validate();
        $this->company->create($validated);
        $this->createMessage('Company');
        $this->confirmForm = false;
    }

    public function updateCompany()
    {
        $validated = $this->validate();
        $company = $this->company->findOrFail($this->companyId);
        $company->update($validated);
        $this->updateMessage('Company');
        $this->confirmForm = false;
    }

    public function confirmCompanyDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->companyId = $id;
    }

    public function deleteCompany()
    {
        $company = $this->company->findOrFail($this->companyId);
        $company->delete();
        $this->deleteMessage('Company');
        $this->confirmDeletion = false;
    }

    public function confirmImport()
    {
        $this->confirmImport = true;
        $this->resetItems();
    }

    public function importCompany()
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls']);
        session()->flash('message', __('Companies has been improted successfully'));
        $this->confirmImport = false;
        return (new CompaniesImport)->import($this->file);
    }

    public function exportCompany()
    {
        session()->flash('message', __('Companies has been exported successfully'));
        return (new CompaniesExport)->download('companies.xlsx');
    }
}