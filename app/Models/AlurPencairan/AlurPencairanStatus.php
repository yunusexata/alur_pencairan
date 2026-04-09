<?php

namespace App\Models\AlurPencairan;

use App\Models\User;
use App\Repositories\AlurPencairan\AlurNotificationHistoryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;


class AlurPencairanStatus extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [

        'alur_pencairan_id',
        'alur_proses_id',
        'alur_proses_detail_id',
        'status',
        'keterangan',

        'nomor_urut',
        'name',
        'role_id',
        'role_name',
        'is_multi',
        'by_user',
        'user_id',
        'alur_proses_key',
        'role_can_show',
        "status_updated_by",
        "status_updated_at",
        "status_updated_name",
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';
    const STATUS_CANCEL = 'cancel';

    protected $guarded = ['id'];

    public function isDeletable()
    {
        return true;
    }

    public function getProgressStatus()
    {
        switch ($this->alur_proses_key) {
            case AlurProsesDetail::KEY_INFO_REK_SALAH:
                return true;
                break;
            case AlurProsesDetail::KEY_MELENGKAPI_REK_SALAH:
                return count($this->alurPencairanDetailBelumMelengkapiRekeningSalah) ? false : true;
                break;
            case AlurProsesDetail::KEY_TRANSFER_SUSULAN:
                return count($this->alurPencairanDetailBelumTransferSusulan) ? false : true;
                break;

            default:
                return $this->status  == AlurPencairanStatus::STATUS_DONE ? true : false;
                break;
        }
    }
    protected static function onBoot()
    {
        self::creating(function ($model) {

            if ($model->alur_proses_detail_id) {
                $model = $model->alurProsesDetail->saveInfo($model, false, '');
            }
        });
        self::updating(function ($model) {
            if ($model->alur_proses_detail_id) {
                $model = $model->alurProsesDetail->saveInfo($model, false, '');
            }
        });
        self::updated(function ($model) {
            $note = false;
            if ($model->isDirty('status')) {
                $note = 'Status diubah: '
                    . $model->getOriginal('status')
                    . ' menjadi: '
                    . $model->status;
            }
            if ($model->isDirty('keterangan')) {
                $note = 'Keterangan diubah: '
                    . $model->getOriginal('keterangan')
                    . ' menjadi: '
                    . $model->keterangan;
            }
            if ($note) {
                AlurNotificationHistoryRepository::create([
                    'remarks_id' => $model->id,
                    'remarks_type' => self::class,
                    'title' => $model->name,
                    'note' => $note,
                    'status' => AlurNotificationHistory::STATUS_UPDATED
                ]);
            }
        });
    }
    public function isEditable()
    {
        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function statusUpdator()
    {
        return $this->belongsTo(User::class, 'status_updated_by', 'id');
    }

    public function alurProses()
    {
        return $this->belongsTo(AlurProses::class, 'alur_proses_id', 'id');
    }
    public function alurProsesDetail()
    {
        return $this->belongsTo(AlurProsesDetail::class, 'alur_proses_detail_id', 'id');
    }
    public function alurPencairanDetail()
    {
        return $this->hasMany(AlurPencairanDetail::class, 'alur_pencairan_id', 'alur_pencairan_id');
    }
    public function alurPencairanDetailBelumMelengkapiRekeningSalah()
    {
        return $this->hasMany(AlurPencairanDetail::class, 'alur_pencairan_id', 'alur_pencairan_id')
            ->where('rekening_terbaru', null);
    }
    public function alurPencairanDetailBelumTransferSusulan()
    {
        return $this->hasMany(AlurPencairanDetail::class, 'alur_pencairan_id', 'alur_pencairan_id')
            ->where('tanggal_transfer', null);
    }
}
