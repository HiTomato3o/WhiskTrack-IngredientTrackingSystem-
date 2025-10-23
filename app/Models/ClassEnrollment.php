<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassUserEnrollment extends Pivot
{
    protected $table = 'class_user_enrollment';
    public $timestamps = false;

    protected $fillable = [
        'class_id', 'user_id', 'enrolled_at', 'is_creator'
    ];
}