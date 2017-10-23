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

}
