<?php

namespace App\Traits;

use Livewire\WithPagination;

trait UserTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $user, $userId, $name, $email, $password, $department_id, $role;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'department_id' => 'nullable|numeric|exists:departments,id',
            'role' => 'required|in:admin,user',
        ];

        if (!$this->userId) {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetItems()
    {
        $this->resetValidation();
        $this->reset(['userId', 'name', 'email', 'password', 'department_id', 'role']);
    }
}
