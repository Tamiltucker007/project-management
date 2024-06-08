<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date',
    ];

    protected $dates = ['deleted_at'];  

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', false);
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }
}

