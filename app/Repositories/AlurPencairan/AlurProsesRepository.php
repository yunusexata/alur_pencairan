<?php

namespace App\Repositories\AlurPencairan;

use App\Models\AlurPencairan\AlurProses;
use App\Repositories\MasterDataRepository;

class AlurProsesRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return AlurProses::class;
    }

    public static function allOrdered()
    {
        return AlurProses::orderBy('nomor_urut', 'ASC')->get();
    }
}
