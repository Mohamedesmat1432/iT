<?php

namespace App\Http\Livewire\Ip;

use App\Models\Ip;
use App\Traits\IpTrait;
use Livewire\Component;

class IpComponent extends Component
{
    use IpTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(Ip $ip)
    {
        $this->ip = $ip;
    }

    public function render()
    {
        $ips = $this->ip->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('number', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.ip.ip-component', [
            'ips' => $ips
        ]);
    }

    public function confirmIpAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmIpEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $ip = $this->ip->findOrFail($id);
        $this->ipId = $ip->id;
        $this->number = $ip->number;
    }

    public function saveIp()
    {
        $validated = $this->validate();
        if (isset($this->ipId)) {
            $ip = $this->ip->findOrFail($this->ipId);
            $ip->update($validated);
            $this->updateMessage('Ip');
        } else {
            $this->ip->create($validated);
            $this->createMessage('Ip');
        }

        $this->confirmForm = false;
    }

    public function confirmIpDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->ipId = $id;
    }

    public function deleteIp()
    {
        $ip = $this->ip->findOrFail($this->ipId);
        $ip->edokis()->update(['ip_id' => null]);
        $ip->emadEdeens()->update(['ip_id' => null]);
        $ip->delete();
        $this->deleteMessage('Ip');
        $this->confirmDeletion = false;
    }
}
