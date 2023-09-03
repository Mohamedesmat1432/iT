<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $users = User::count();

        return view('livewire.dashboard.admin-dashboard-component', [
            'users' => $users
        ]);
    }
}
