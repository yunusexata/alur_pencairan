<?php

namespace App\Models\AlurPencairan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class AlurPencairanHistory extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'alur_pencairan_id',
        'alur_proses_id',
        'alur_proses_detail_id',
        'user_id',
        'status',
        'keterangan',
        "status_updated_by",
        "status_updated_at",
        "status_updated_name",
    ];

    protected $guarded = ['id'];


    const STATUS_CANCEL = 'cancel';
    const STATUS_DONE = 'done';
    const STATUS_CHOICE = [
        self::STATUS_CANCEL => 'Cancel',
        self::STATUS_DONE => 'Done',
    ];

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    protected static function onBoot()
    {
        self::created(function ($model) {
            AlurPencairanStatus::updateOrCreate(
                [
                    'alur_pencairan_id' => $model->alur_pencairan_id,
                    'alur_proses_id' => $model->alur_proses_id,
                    'alur_proses_detail_id' => $model->alur_proses_detail_id,
                    'user_id' => $model->user_id,
                ],
                [
                    'user_id' => $model->user_id,
                    'alur_pencairan_id' => $model->alur_pencairan_id,
                    'status' => $model->status,
                    'keterangan' => $model->keterangan,
                    'status_updated_by' => $model->status_updated_by,
                    'status_updated_at' => $model->status_updated_at,
                    'status_updated_name' => $model->status_updated_name,
                ]
            );
        });
    }
}
