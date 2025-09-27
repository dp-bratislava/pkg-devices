<?php

namespace Dpb\Package\Devices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceGroup extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'title',
        'description',
    ];

    public function getTable()
    {
        return config('pkg-devices.table_prefix') . 'device_groups';
    }
}
