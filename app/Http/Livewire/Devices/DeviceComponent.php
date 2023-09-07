<?php

namespace App\Http\Livewire\Devices;

use App\Models\Device;
use App\Traits\DeviceTrait;
use Livewire\Component;

class DeviceComponent extends Component
{
    use DeviceTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(Device $device)
    {
        $this->device = $device;
    }

    public function render()
    {
        $devices = $this->device->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('serial', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.devices.device-component', [
            'devices' => $devices
        ]);
    }
    public function confirmDeviceAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }

    public function confirmDeviceEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $device = $this->device->findOrFail($id);
        $this->deviceId = $device->id;
        $this->name = $device->name;
        $this->serial = $device->serial;
        $this->specifications = $device->specifications;
    }

    public function saveDevice()
    {
        $validated = $this->validate();
        if (isset($this->deviceId)) {
            $device = $this->device->findOrFail($this->deviceId);
            $device->update($validated);
            $this->updateMessage('Device');
        } else {
            $this->device->create($validated);
            $this->createMessage('Device');
        }

        $this->confirmForm = false;
    }

    public function confirmDeviceDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->deviceId = $id;
    }

    public function deleteDevice()
    {
        $device = $this->device->findOrFail($this->deviceId);
        $device->edokis()->update(['device_id' => null]);
        $device->emadEdeens()->update(['device_id' => null]);
        $device->delete();
        $this->deleteMessage('Device');
        $this->confirmDeletion = false;
    }

}
