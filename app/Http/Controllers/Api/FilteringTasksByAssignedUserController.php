<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FilteringTasksByAssignedUserController extends Controller
{
    // ============ Фильтрации задач по закрепленному пользователю. ===============
    public function index($id){
        $user = User::find($id);
        if(is_null($user)){
            return $this->sendError('пользователь не найден.');
        }
        else{
            $user_tasks = $user->tasks()->get();

            return $user_tasks;
        }
    }
}
