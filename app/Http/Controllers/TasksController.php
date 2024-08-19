<?php

namespace App\Http\Controllers;

use App\Cqrs\AssociarUsuarioAtask;
use App\Cqrs\DestroyTask;
use App\Cqrs\GetUsuariosProjetos;
use App\Cqrs\GetUsuariosProjetosPaginator;
use App\Cqrs\GetUsuariosResponsaveisTask;
use App\Cqrs\UpdateTask;
use App\Models\UserTask;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //

    public function create(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|max:255',
                'descricao' => 'required',
                'data_encerramento' => 'required|date',
                'status' => 'required|string',
                'project_id' => 'required'
            ]);

            $id = (new TaskRepository)->create(
                titulo: $request->titulo,
                descricao: $request->descricao,
                dataEncerramento: $request->data_encerramento,
                userId: auth()->user()->id,
                status: $request->status,
                projectId: $request->project_id
            );

            return redirect()->route('page.task', ['task_id' => $id])->with('status', 'task cadastrada');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function get(Request $request)
    {
        $task =  (new TaskRepository)->get($request->task_id);
        $projectId = $task->project->id;

        $responsaveis =  (new GetUsuariosResponsaveisTask)->get($request->task_id);


        return view('task.page', [

            'task' => $task,
            'usersProject' => (new GetUsuariosProjetos)->get($projectId),
            'userResponsaveis' => $responsaveis

        ]);
    }

    public function associar(Request $request)
    {
        $task =  (new TaskRepository)->get($request->task_id);

        $responsaveis =  (new GetUsuariosResponsaveisTask)->get($request->task_id);

        return view('task.pageassociar', [
            'task' => $task,
            'usersProject' => (new GetUsuariosProjetosPaginator)->get($task->project->id, $request->task_id),
            'userResponsaveis' => $responsaveis
        ]);
    }

    public function associarUsuarioTask(Request $request)
    {

        $request->validate([
            'task_id' => 'required',
            'user_id' => 'required'
        ]);

        (new AssociarUsuarioAtask)->create(userId: $request->user_id, taskId: $request->task_id);

        return back()->with('status', 'usuário associado');
    }

    public function removerUsuarioTask(Request $request)
    {
        UserTask::where('id', $request->user_task_id)->delete();
        return back()->with('status', 'usuário removido');
    }


    public function update(Request $request)
    {
        try {

            $request->validate([
                'titulo' => 'required|max:255',
                'descricao' => 'required',
                'data_encerramento' => 'required|date',
                'status' => 'required|string',
                'task_id' => 'required|numeric'
            ]);

            (new TaskRepository)->update(
                titulo: $request->titulo,
                descricao: $request->descricao,
                id: (int)$request->task_id,
                dataEncerramento: $request->data_encerramento,
                status: $request->status
            );

            return back()->with('status', 'task cadastrada');

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|numeric'
            ]);

            (new DestroyTask)->create(
                id: (int)$request->id,
            );

            return back()->with('status', 'task cadastrada');

        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
