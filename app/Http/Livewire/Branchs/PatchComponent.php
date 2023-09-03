<?php

namespace App\Http\Livewire\Branchs;

use App\Models\PatchBranch;
use App\Traits\PatchTrait;
use Livewire\Component;

class PatchComponent extends Component
{
    use PatchTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(PatchBranch $patch)
    {
        $this->patch = $patch;
    }

    public function render()
    {
        $patchs = $this->patch->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('port', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.branchs.patch-component', [
            'patchs' => $patchs
        ]);
    }

    public function confirmPatchAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmPatchEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $patch = $this->patch->findOrFail($id);
        $this->patchId = $patch->id;
        $this->port = $patch->port;
    }

    public function savePatch()
    {
        $validated = $this->validate();
        if (isset($this->patchId)) {
            $patch = $this->patch->findOrFail($this->patchId);
            $patch->update($validated);
            $this->updateMessage('Patch');
        } else {
            $this->patch->create($validated);
            $this->createMessage('Patch');
        }

        $this->confirmForm = false;
    }

    public function confirmPatchDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->patchId = $id;
    }

    public function deletePatch()
    {
        $patch = $this->patch->findOrFail($this->patchId);
        $patch->delete();
        $this->deleteMessage('Patch');
        $this->confirmDeletion = false;
    }

}
