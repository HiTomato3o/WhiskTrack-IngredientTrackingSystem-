<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    protected $table = 'academic_sessions';
    protected $fillable = ['session_name', 'start_date', 'end_date', 'is_current'];

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}