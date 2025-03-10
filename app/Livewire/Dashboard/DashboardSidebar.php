<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DashboardSidebar extends Component
{
    public $users;
    public function render()
    {
        $this->users = session('data_login');
        return view('livewire.dashboard.dashboard-sidebar', [
            'users' => $this->users,
        ]);
    }
}
