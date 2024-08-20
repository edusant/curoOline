<?php

namespace App\Http\Controllers;

use App\Cqrs\AdicionaUsuarioEmProjeto;
use App\Cqrs\GetIdUserPorEmail;
use App\Cqrs\GetTasks;
use App\Cqrs\GetTasksExportesExcel;
use App\Cqrs\GetUsuariosProjetos;
use App\Models\ProjectUser;
use App\Repository\ProjectRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\error;

class ProjectsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|max:255',
                'descricao' => 'required',
                'data_encerramento' => 'required|date'
            ]);

            (new ProjectRepository)->create(
                titulo: $request->titulo,
                descricao: $request->descricao,
                dataEncerramento: $request->data_encerramento,
                userId: auth()->user()->id
            );

            return back()->with('status', 'Projeto cadastrado');

        } catch (\Throwable $th) {
            info($th);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|max:255',
                'descricao' => 'required',
                'project_id' => 'required',
                'data_encerramento' => 'required|date'
            ]);

            (new ProjectRepository)->update(
                titulo: $request->titulo,
                descricao: $request->descricao,
                dataEncerramento: $request->data_encerramento,
                id: $request->project_id
            );

            return back()->with('status', 'Projeto atualizado');

        } catch (\Throwable $th) {
            info($th);
        }
    }

    public function list(Request $request)
    {
        if ($request->has('baixar_excel'))
        {
            (new GetTasksExportesExcel)->get($request->project_id, de: $request->de, ate: $request->ate,
            status: $request->status);
        }

        return view('projects.page', [
            'projeto' => (new ProjectRepository)->get($request->project_id),
            'tasks' => (new GetTasks)->get($request->project_id, de: $request->de, ate: $request->ate,
            status: $request->status),
            'usersProject' => (new GetUsuariosProjetos)->get($request->project_id)
        ]);
    }

    public function addUser(Request $request)
    {

        $request->validate([
            'email' => 'required|exists:users,email',
            'project_id' => 'required'
        ]);

        $userId = (new GetIdUserPorEmail)->get($request->email);

        (new AdicionaUsuarioEmProjeto)->create($userId, $request->project_id);

        return back()->with('status', 'Usuário adicionado com sucesso!');
    }

    public function destroy(Request $request)
    {
        try {
            $request->validate([
                'project_id' => 'required',
            ]);

            (new ProjectRepository)->delete(
                id: $request->project_id
            );

            return redirect('/dashboard')->with('status', 'Projeto atualizado');

        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
