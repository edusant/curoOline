<?php

namespace App\Http\Controllers;

use App\Cqrs\CreateTask;
use App\Cqrs\GetTaskPorID;
use App\Cqrs\GetUsuariosProjetos;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //

    public function create(Request $request) {
        try
        {
            $request->validate([
                'titulo' => 'required|max:255',
                'descricao' => 'required',
                'data_encerramento' => 'required|date',
                'status' => 'required|string',
                'project_id' => 'required'
            ]);

           $id = (new CreateTask)->create(titulo: $request->titulo,
            descricao: $request->descricao,
            dataEncerramento: $request->data_encerramento, userId: auth()->user()->id,
            status:$request->status, projectId: $request->project_id);

            return redirect()->route('page.task', ['task_id' => $id])->with('status', 'task cadastrada');

        } catch (\Throwable $th) {
           dd($th);
        }
    }

    public function get(Request $request) {
        $task =  (new GetTaskPorID)->get($request->task_id);
        return view('task.page', [

            'task' => $task,
            'usersProject' => (new GetUsuariosProjetos)->get($task->project->id)
        ]);

    }

}
