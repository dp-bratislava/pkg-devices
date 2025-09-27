<?php

namespace Dpb\Package\Devices\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceLocationHistory extends Pivot
{
    use SoftDeletes;

    protected $fillable = [
        'device_id', 
        'device_location_id', 
        'date_from', 
        'date_to'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_from' => 'date',
            'date_to' => 'date',
        ];
    } 

    public function getTable(): string
    {
        return config('pkg-devices.table_prefix') . 'device_location_history';
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(DeviceLocation::class);
    }
}
