<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $fillable = [
        'academic_session_id', 'semester_name', 'start_date', 'end_date'
    ];

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }
}