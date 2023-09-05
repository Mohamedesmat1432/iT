<?php

namespace App\Http\Livewire\Branchs;

use App\Models\SwitchBranch;
use App\Traits\SwitchTrait;
use Livewire\Component;

class SwitchComponent extends Component
{
    use SwitchTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(SwitchBranch $switch)
    {
        $this->switch = $switch;
    }

    public function render()
    {
        $switchs = $this->switch->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('port', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.branchs.switch-component', [
            'switchs' => $switchs
        ]);
    }

    public function confirmSwitchAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmSwitchEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $switch = $this->switch->findOrFail($id);
        $this->switchId = $switch->id;
        $this->port = $switch->port;
    }

    public function saveSwitch()
    {
        $validated = $this->validate();
        if (isset($this->switchId)) {
            $switch = $this->switch->findOrFail($this->switchId);
            $switch->update($validated);
            $this->updateMessage('Switch');
        } else {
            $this->switch->create($validated);
            $this->createMessage('Switch');
        }

        $this->confirmForm = false;
    }

    public function confirmSwitchDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->switchId = $id;
    }

    public function deleteSwitch()
    {
        $switch = $this->switch->findOrFail($this->switchId);
        $switch->edokis()->update(['switch_id' => null]);
        $switch->emadEdeens()->update(['switch_id' => null]);
        $switch->delete();
        $this->deleteMessage('Switch');
        $this->confirmDeletion = false;
    }

}
