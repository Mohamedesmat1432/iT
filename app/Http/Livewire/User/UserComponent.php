<?php

namespace App\Http\Livewire\User;

use App\Models\Department;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserComponent extends Component
{
    use UserTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $users = $this->user->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->paginate(10);

        $departments = Department::select('id', 'name')->get();

        return view('livewire.user.user-component', [
            'users' => $users,
            'departments' => $departments
        ]);
    }

    public function confirmUserAdd()
    {
        $this->resetItems();
        $this->confirmForm = true;
    }


    public function confirmUserEdit($id)
    {
        $this->resetItems();
        $this->confirmForm = true;
        $user = $this->user->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->department_id = $user->department_id;
        $this->role = $user->role;
    }

    public function saveUser()
    {
        $validated = $this->validate();
        if (isset($this->userId)) {
            $user = $this->user->findOrFail($this->userId);
            $user->update($validated);
            $this->updateMessage('User');
        } else {
            $validated['password'] = Hash::make($this->password);
            $this->user->create($validated);
            $this->createMessage('User');
        }

        $this->confirmForm = false;
    }

    public function confirmUserDeletion($id)
    {
        $this->confirmDeletion = true;
        $this->userId = $id;
    }

    public function deleteUser()
    {
        $user = $this->user->findOrFail($this->userId);
        $user->delete();
        $this->deleteMessage('User');
        $this->confirmDeletion = false;
    }
}
