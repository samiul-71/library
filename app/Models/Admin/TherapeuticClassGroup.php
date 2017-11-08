<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TherapeuticClassGroup extends Model
{
    use SoftDeletes;

    protected $table = 'therapeutic_class_group';

    protected $dates = ['deleted_at'];

    protected $guarded = ['created_by', 'updated_by', 'deleted_by', 'deleted_at', 'created_at', 'updated_at'];
}
