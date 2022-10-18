<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deadline',
        'description',
        'user_id',
        'status'
    ];

    public function task_histories(){
        return $this->hasMany(TaskHistory::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
