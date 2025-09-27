<?php

namespace Dpb\Package\Devices\Models;

use Dpb\Package\Eav\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceModel extends Model
{
    use SoftDeletes;    
    use HasAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'type_id',
    ];

    public function getTable()
    {
        return config('pkg-devices.table_prefix') . 'device_models';
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class, "type_id");
    }

}
