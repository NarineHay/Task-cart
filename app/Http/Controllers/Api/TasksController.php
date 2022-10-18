<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\CreateTask;
use App\Http\Resources\CreateTaskResource;
use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Http\Request;

class TasksController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ========== отображения задач ===========
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // ============= создать задачу =========================
    public function store(CreateTask $request)
    {

        if($request->validated()){
            $task_request = $request->all();
            $task = Task::create($task_request);

        }
        return $this->sendResponse(new CreateTaskResource($task), 'задания успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // =========== показать задачу ===================
    public function show($id)
    {

        $task = Task::find($id);

        return is_null($task) ? $this->sendError('задания не найдена.') :
               $this->sendResponse(new CreateTaskResource($task), 'задания найдено');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // =============== обновить задачу ==========================
    public function update(Request $request, $id)
    {
            $task = Task::find($id);
            if(is_null($task)){
                return $this->sendError('задания не найдена.');
            }
            else{
                if($request->has('status') && $request->status != $task->status){
                    TaskHistory::create([
                        'task_id' => $id,
                        'status' => $request->status
                    ]);
                }
                $task->update($request->all());
            }

            return $this->sendResponse(new CreateTaskResource($task), 'задания успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // =========== удалить задачу ===============
    public function destroy($id)
    {
        $task = Task::find($id);
        if(is_null($task)){
            return $this->sendError('задания не найдена.');
        }
        else{

            TaskHistory::create([
                'task_id' => $task->id,
                'status' => 'Удалено'
            ]);
            $task->delete();
            return $task ? 'задача удалена' : 'произошло ошибка';
        }
    }

}
