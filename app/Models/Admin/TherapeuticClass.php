<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TherapeuticClass extends Model
{
    use SoftDeletes;

    protected $table = 'therapeutic_class';

    protected $dates = ['deleted_at'];

    protected $guarded = ['created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * Many-to-many relation with Indications.
     */
    public function genericNames()
    {
        return $this->belongsToMany(GenericName::class, 'generic_name_therapeutic_class', 'therapeutic_id', 'generic_id')->withTimestamps();
    }
}
