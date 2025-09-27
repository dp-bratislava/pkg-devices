<?php

namespace Dpb\Package\Devices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceLocation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
    ];

    public function getTable()
    {
        return config('pkg-devices.table_prefix') . 'device_locations';
    }

    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(
            Device::class,
            config('pkg-devices.table_prefix') . "device_location_history",
            'device_location_id',
            'device_id',
            'id',
            'id'
        )
            ->using(DeviceLocationHistory::class)
            ->withPivot(['date_from', 'date_to']);
    }

    /**
     * Get device currently assigned to this location
     * 
     * @return object|object{pivot: \Illuminate\Database\Eloquent\Relations\Pivot|Devices|null}
     */
    public function getDeviceAttribute(): ?Device
    {
        return $this->devices()
            ->orderByDesc('date_from')
            ->first();
    }

}
