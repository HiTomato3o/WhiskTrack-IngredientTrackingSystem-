<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $fillable = [
        'name',
        'password', // This should be hashed in the controller
        'semester_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'updated_by' => 'integer',
    ];

    // Relationships
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'class_user_enrollment', 'class_id', 'user_id')
            ->withPivot('enrolled_at', 'is_creator')
            ->withTimestamps();
    }
}