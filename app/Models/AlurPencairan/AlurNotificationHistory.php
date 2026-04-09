<?php

namespace App\Models\AlurPencairan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Muhammadyunus1072\TrackHistory\HasTrackHistory;

class AlurNotificationHistory extends Model
{
    use HasFactory, SoftDeletes, HasTrackHistory;

    protected $fillable = [
        'remarks_id',
        'remarks_type',
        'title',
        'note',
        'status',
    ];

    protected $guarded = ['id'];


    const STATUS_CREATED = 'primary';
    const STATUS_UPDATED = 'success';
    const STATUS_CANCEL = 'warning';
    const STATUS_DELETE = 'danger';
    const STATUS_CHOICE = [
        self::STATUS_CREATED => 'primary',
        self::STATUS_UPDATED => 'success',
        self::STATUS_CANCEL => 'warning',
        self::STATUS_DELETE => 'danger',
    ];

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
}
