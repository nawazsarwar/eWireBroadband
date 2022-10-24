<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Subscriber extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'subscribers';

    public static $searchable = [
        'address',
        'lastname',
        'email',
        'subscriberid',
        'firstname',
        'mobileno',
    ];

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'expiry',
        'registrationdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'username',
        'address',
        'gstin',
        'status',
        'expiry',
        'balance',
        'sub_status',
        'remarks',
        'lastname',
        'alternate_mobile_no',
        'email',
        'packagename',
        'billingtypeid',
        'subscriberid',
        'registrationdate',
        'firstname',
        'mobileno',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getExpiryAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getRegistrationdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setRegistrationdateAttribute($value)
    {
        $this->attributes['registrationdate'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function receivables()
    {
        return $this->hasMany(Receivable::class, 'username', 'username');
    }
}
