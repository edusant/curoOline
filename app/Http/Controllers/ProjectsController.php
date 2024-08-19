<?php

namespace App\Http\Controllers;

use App\Cqrs\AdicionaUsuarioEmProjeto;
use App\Cqrs\DeleteProjectsComand;
use App\Cqrs\GetIdUserPorEmail;
use App\Cqrs\GetProjectPorID;
use App\Cqrs\GetTasks;
use App\Cqrs\GetUsuariosProjetos;
use App\Cqrs\UpdateProjectsComand;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

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
        return view('projects.page', [
            'projeto' => (new GetProjectPorID)->get($request->project_id),
            'tasks' => (new GetTasks)->get($request->project_id),
            'usersProject' => (new GetUsuariosProjetos)->get($request->project_id)
        ]);
    }

    public function addUser(Request $request)
    {

        $request->validate([
            'email' => 'required',
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
