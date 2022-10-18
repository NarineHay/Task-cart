<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;
    protected $fillable = [

        'task_id',
        'status'
    ];

    public function tasks(){
        return $this->belongsTo(Task::class, 'task_id');
    }
}
