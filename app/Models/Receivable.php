<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receivable extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const SETTLED_SELECT = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    public $table = 'receivables';

    public static $searchable = [
        'financeref',
        'username',
        'subscriberid',
    ];

    protected $dates = [
        'lastupdate',
        'settled_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'financeref',
        'lastupdate',
        'description',
        'username',
        'subscriberid',
        'amount',
        'amount_received',
        'settled',
        'settled_by_id',
        'settled_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getLastupdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setLastupdateAttribute($value)
    {
        $this->attributes['lastupdate'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function settled_by()
    {
        return $this->belongsTo(User::class, 'settled_by_id');
    }

    public function getSettledAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSettledAtAttribute($value)
    {
        $this->attributes['settled_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
