<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenericName extends Model
{
    use SoftDeletes;

    protected $table = 'generic_names';

    protected $dates = ['deleted_at'];

    protected $guarded = ['created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * Many-to-many relation with Indications
     */
    public function indications()
    {
        return $this->belongsToMany(Indication::class, 'generic_name_indication', 'generic_name_id', 'indication_id')->withTimestamps();
    }

    /**
     * Many-to-many relation with Therapeutic Classes
     */
    public function therapeuticClasses()
    {
        return $this->belongsToMany(TherapeuticClass::class, 'generic_name_therapeutic_class', 'generic_id', 'therapeutic_id')->withTimestamps();
    }
}
