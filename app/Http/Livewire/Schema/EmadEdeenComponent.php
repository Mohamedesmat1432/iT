<?php

namespace App\Http\Livewire\Schema;

use App\Models\Department;
use App\Models\EmadEdeen;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\SwitchBranch;
use App\Traits\EmadEdeenTrait;
use Livewire\Component;

class EmadEdeenComponent extends Component
{
    use EmadEdeenTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(EmadEdeen $emadEdeen)
    {
        $this->emadEdeen = $emadEdeen;
    }

    public function render()
    {
        $departments = Department::select('id', 'name')->get();
        $ips = Ip::select('id', 'number')->get();
        $patchs = PatchBranch::select('id', 'port')->get();
        $switchs = SwitchBranch::select('id', 'port')->get();

        $emadEdeens = $this->emadEdeen->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.schema.emad-edeen-component', [
            'emadEdeens' => $emadEdeens,
            'departments' => $departments,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
        ]);
    }

    public function confirmEmadEdeenAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmEmadEdeenEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $emadEdeen = $this->emadEdeen->findOrFail($id);
        $this->emadEdeenId = $emadEdeen->id;
        $this->name = $emadEdeen->name;
        $this->email = $emadEdeen->email;
        $this->department_id = $emadEdeen->department_id;
        $this->ip_id = $emadEdeen->ip_id;
        $this->switch_id = $emadEdeen->switch_id;
        $this->patch_id = $emadEdeen->patch_id;
    }

    public function saveEmadEdeen()
    {
        $validated = $this->validate();
        if (isset($this->emadEdeenId)) {
            $emadEdeen = $this->emadEdeen->findOrFail($this->emadEdeenId);
            $emadEdeen->update($validated);
            $this->updateMessage('EmadEdeen');
        } else {
            $this->emadEdeen->create($validated);
            $this->createMessage('EmadEdeen');
        }

        $this->confirmForm = false;
    }

    public function confirmEmadEdeenDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->emadEdeenId = $id;
    }

    public function deleteEmadEdeen()
    {
        $emadEdeen = $this->emadEdeen->findOrFail($this->emadEdeenId);
        $emadEdeen->delete();
        $this->deleteMessage('EmadEdeen');
        $this->confirmDeletion = false;
    }
}
