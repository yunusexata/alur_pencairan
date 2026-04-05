<?php

namespace App\Models\AlurPencairan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;
use Spatie\Permission\Models\Role;


class AlurProses extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'name',
    ];
    protected $guarded = ['id'];

    const TYPE_SPEED_20 = 'SPEED 20';
    const TYPE_NORMAL = 'NORMAL';
    const TYPE_PROSES_80 = 'PROSES 80';
    const TYPE_CHOICE = [
        self::TYPE_SPEED_20 => 'SPEED 20',
        self::TYPE_NORMAL => 'NORMAL',
        self::TYPE_PROSES_80 => 'PROSES 80',
    ];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    public function alurProsesDetails()
    {
        return $this->hasMany(AlurProsesDetail::class, 'alur_proses_id', 'id');
    }
}
