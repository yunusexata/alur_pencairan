<?php

namespace App\Models\AlurPencairan;

use App\Models\User;
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

    protected $guarded = ['id'];

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
