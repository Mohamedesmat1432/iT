<?php

namespace App\Http\Livewire\Department;

use App\Models\Department;
use App\Traits\DepartmentTrait;
use Livewire\Component;

class DepartmentComponent extends Component
{
    use DepartmentTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(Department $department)
    {
        $this->department = $department;
    }

    public function render()
    {
        $departments = $this->department->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.department.department-component', [
            'departments' => $departments
        ]);
    }

    public function confirmDepartmentAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmDepartmentEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $department = $this->department->findOrFail($id);
        $this->departmentId = $department->id;
        $this->name = $department->name;
    }

    public function saveDepartment()
    {
        $validated = $this->validate();
        if (isset($this->departmentId)) {
            $department = $this->department->findOrFail($this->departmentId);
            $department->update($validated);
            $this->updateMessage('Department');
        } else {
            $this->department->create($validated);
            $this->createMessage('Department');
        }
        $this->confirmForm = false;
    }

    public function confirmDepartmentDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->departmentId = $id;
    }

    public function deleteDepartment()
    {
        $department = $this->department->findOrFail($this->departmentId);
        $department->users()->update(['department_id' => null]);
        $department->delete();
        $this->deleteMessage('Department');
        $this->confirmDeletion = false;
    }
}
