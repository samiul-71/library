<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indication extends Model
{
    use SoftDeletes;

    protected $table = 'indications';

    protected $dates = ['deleted_at'];

    protected $guarded = ['created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * Many-to-many relation with Generic Names.
     */
    public function genericNames()
    {
        return $this->belongsToMany(GenericName::class, 'generic_name_indication', 'indication_id', 'generic_name_id')->withTimestamps();
    }

}
