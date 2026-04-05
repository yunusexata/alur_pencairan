<?php

namespace App\Repositories\AlurPencairan;

use App\Models\AlurPencairan\AlurPencairanStatus;
use App\Repositories\MasterDataRepository;

class AlurPencairanStatusRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return AlurPencairanStatus::class;
    }

    public static function datatable()
    {
        return AlurPencairanStatus::query();
    }

    public static function getAlurPencairan($alur_pencairan_id)
    {
        return AlurPencairanStatus::orderBy('nomor_urut', 'ASC')
            ->get();
    }
}
