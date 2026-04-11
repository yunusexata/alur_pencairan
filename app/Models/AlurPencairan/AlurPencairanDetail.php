<?php

namespace App\Models\AlurPencairan;

use App\Models\User;
use App\Repositories\AlurPencairan\AlurNotificationHistoryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class AlurPencairanDetail extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'alur_pencairan_id',
        'no_input_jepang',
        'nama_lengkap',
        'tanggal_lahir',
        'nominal_cair',
        'status',
        'rekening_terbaru',
        'tanggal_transfer',
        'mata_uang',

        'rekening_lama',
        'jenis_rekening_lama',

        'rekening_terbaru',
        'jenis_rekening_terbaru',
        "rekening_terbaru_updated_by",
        "rekening_terbaru_updated_at",
        'tanggal_transfer',
        "tanggal_transfer_updated_by",
        "tanggal_transfer_updated_at",

        "keterangan",
        "mata_uang",
    ];


    const STATUS_PROSES = 'proses';
    const STATUS_DONE = 'done';
    const STATUS_CHOICE = [
        self::STATUS_PROSES => 'Proses',
        self::STATUS_DONE => 'Done',
    ];

    const JENIS_REKENING_INDONESIA = 'INDONESIA';
    const JENIS_REKENING_JEPANG = 'JEPANG';
    const JENIS_REKENING_CHOICE = [
        self::JENIS_REKENING_INDONESIA => 'INDONESIA',
        self::JENIS_REKENING_JEPANG => 'JEPANG',
    ];

    const MATA_UANG_RUPIAH = 'RUPIAH';
    const MATA_UANG_YEN = 'YEN';
    const MATA_UANG_CHOICE = [
        self::MATA_UANG_RUPIAH => 'RUPIAH',
        self::MATA_UANG_YEN => 'YEN',
    ];

    protected $guarded = ['id'];
    protected static function onBoot()
    {
        self::created(function ($model) {
            $note = "Dibuat oleh: " . $model->creator->name;
            AlurNotificationHistoryRepository::create([
                'remarks_id' => $model->id,
                'remarks_type' => self::class,
                'title' => AlurProsesDetail::ALUR_SPEED_20_INFO_REKENING_SALAH['name'],
                'note' => $note,
                'status' => AlurNotificationHistory::STATUS_CREATED
            ]);
        });
        self::updated(function ($model) {
            $title = false;
            $note = false;
            if ($model->isDirty('rekening_terbaru')) {
                $note = 'Rekening terbaru diubah: '
                    . $model->getOriginal('rekening_terbaru')
                    . ' menjadi: '
                    . $model->rekening_terbaru;
                $title = 'Perubahan rekening terbaru';
            }
            if ($model->isDirty('tanggal_transfer')) {
                $note = 'Tanggal transfer diubah: '
                    . $model->getOriginal('tanggal_transfer')
                    . ' menjadi: '
                    . $model->tanggal_transfer;
                $title = 'Perubahan tanggal transfer';
            }
            if ($title) {
                AlurNotificationHistoryRepository::create([
                    'remarks_id' => $model->id,
                    'remarks_type' => self::class,
                    'title' => $title,
                    'note' => $note,
                    'status' => AlurNotificationHistory::STATUS_UPDATED
                ]);
            }
        });
    }

    public function isDeletable()
    {
        return true;
    }

    public function isEditable()
    {
        return true;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function updatorRekeningTerbaru()
    {
        return $this->belongsTo(User::class, 'rekening_terbaru_updated_by', 'id');
    }

    public function updatorTanggalTransfer()
    {
        return $this->belongsTo(User::class, 'tanggal_transfer_updated_by', 'id');
    }
}
