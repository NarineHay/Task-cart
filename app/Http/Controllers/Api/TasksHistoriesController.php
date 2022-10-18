<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Http\Request;

class TasksHistoriesController extends Controller
{
    // ============ историю изменений задачи ===============
    public function index(){
        $tasks = Task::where('id', '>', 0);
        $task_histories = $tasks->with('task_histories')->get();
        
        return $task_histories;
    }
}
