<?php

namespace App\Http\Livewire\Schema;

use App\Models\Department;
use App\Models\Device;
use App\Models\Edoki;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\SwitchBranch;
use App\Traits\EdokiTrait;
use Livewire\Component;

class EdokiComponent extends Component
{
    use EdokiTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(Edoki $edoki)
    {
        $this->edoki = $edoki;
    }

    public function render()
    {
        $departments = Department::select('id', 'name')->get();
        $devices = Device::select('id', 'name')->get();
        $ips = Ip::select('id', 'number')->get();
        $patchs = PatchBranch::select('id', 'port')->get();
        $switchs = SwitchBranch::select('id', 'port')->get();

        $edokis = $this->edoki->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.schema.edoki-component', [
            'edokis' => $edokis,
            'departments' => $departments,
            'devices' => $devices,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
        ]);
    }

    public function confirmEdokiAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }


    public function confirmEdokiEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $edoki = $this->edoki->findOrFail($id);
        $this->edokiId = $edoki->id;
        $this->name = $edoki->name;
        $this->email = $edoki->email;
        $this->department_id = $edoki->department_id;
        $this->device_id = $edoki->device_id;
        $this->ip_id = $edoki->ip_id;
        $this->switch_id = $edoki->switch_id;
        $this->patch_id = $edoki->patch_id;
    }

    public function saveEdoki()
    {
        $validated = $this->validate();
        if (isset($this->edokiId)) {
            $edoki = $this->edoki->findOrFail($this->edokiId);
            $edoki->update($validated);
            $this->updateMessage('Edoki');
        } else {
            $this->edoki->create($validated);
            $this->createMessage('Edoki');
        }

        $this->confirmForm = false;
    }

    public function confirmEdokiDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->edokiId = $id;
    }

    public function deleteEdoki()
    {
        $edoki = $this->edoki->findOrFail($this->edokiId);
        $edoki->delete();
        $this->deleteMessage('Edoki');
        $this->confirmDeletion = false;
    }
}
