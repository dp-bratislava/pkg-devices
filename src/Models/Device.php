<?php

namespace Dpb\Package\Devices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'location',
        'serial_number',
        'model_id',
    ];

    public function getTable()
    {
        return config('pkg-devices.table_prefix') . 'devices';
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class, "model_id");
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            DeviceGroup::class,
            config('pkg-devices.table_prefix') . "device_group",
            'device_id',
            'group_id'
        );
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(
            DeviceLocation::class,
            config('pkg-devices.table_prefix') . "device_location_history",
            'device_id',
            'location_id',
        )
            ->using(DeviceLocationHistory::class)
            ->withPivot(['date_from', 'date_to']);
    }

    /**
     * Get code currently assigned to this device
     * 
     * @return object|object{pivot: \Illuminate\Database\Eloquent\Relations\Pivot|DeviceLocation|null}
     */
    public function getLocationAttribute(): ?DeviceLocation
    {
        return $this->locations()
            ->orderByDesc('date_from')
            ->first();
    }

}
