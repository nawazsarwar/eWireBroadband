<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'orders';

    protected $dates = [
        'transacted_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'parameters',
        'amount',
        'currency',
        'status',
        'transacted_on',
        'narration',
        'response',
        'receivable_id',
        'merchant_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTransactedOnAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTransactedOnAttribute($value)
    {
        $this->attributes['transacted_on'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function receivable()
    {
        return $this->belongsTo(Receivable::class, 'receivable_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
