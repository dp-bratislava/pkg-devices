<?php

namespace Dpb\Package\Devices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceType extends Model
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
    ];

    public function getTable()
    {
        return config('pkg-devices.table_prefix') . 'device_types';
    }

    public function model(): HasMany
    {
        return $this->hasMany(DeviceModel::class, "type_id");
    }    
}
