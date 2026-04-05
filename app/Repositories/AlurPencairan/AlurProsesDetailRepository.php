<?php

namespace App\Repositories\AlurPencairan;

use App\Models\AlurPencairan\AlurProsesDetail;
use App\Repositories\MasterDataRepository;

class AlurProsesDetailRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return AlurProsesDetail::class;
    }

    public static function allOrdered()
    {
        return AlurProsesDetail::orderBy('nomor_urut', 'ASC')->get();
    }
}
