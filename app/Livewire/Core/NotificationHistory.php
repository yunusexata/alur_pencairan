<?php

namespace App\Livewire\Core;

use App\Models\AlurPencairan\AlurNotificationHistory;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $readyToLoad = false;

    protected $listeners = [
        'load-more' => 'loadMore',
        'notification-refresh' => '$refresh',
    ];
    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function loadNotifications()
    {
        $this->readyToLoad = true;
    }

    public function getNotificationsProperty()
    {
        if (!$this->readyToLoad) {
            return collect();
        }

        return AlurNotificationHistory::query()
            ->latest()
            ->limit($this->perPage)
            ->get();
    }
    public function render()
    {
        return view('livewire.core.notification-history');
    }
}
