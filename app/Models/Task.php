<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',  'title', 'description', 'deadline', 'is_completed',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');  
    }

    public function getDeadlineAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }
}
