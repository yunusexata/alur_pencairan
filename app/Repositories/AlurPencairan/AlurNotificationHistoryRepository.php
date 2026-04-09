<?php

namespace App\Repositories\AlurPencairan;

use App\Models\AlurPencairan\AlurNotificationHistory;
use App\Repositories\MasterDataRepository;

class AlurNotificationHistoryRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return AlurNotificationHistory::class;
    }

    public static function datatable()
    {
        return AlurNotificationHistory::query();
    }
}
