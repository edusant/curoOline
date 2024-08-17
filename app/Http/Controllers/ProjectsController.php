<?php

namespace App\Http\Controllers;

use App\Cqrs\CreaterProjectsComand;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ProjectsController extends Controller
{
    //

    public function create(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'data_encerramento' => 'required|date'
        ]);
        try
        {
            (new CreaterProjectsComand)->create(titulo: $request->titulo, descricao: $request->descricao,
            dataEncerramento: $request->data_encerramento, userId: auth()->user()->id);
            return back()->with('status', 'Projeto cadastrado');

        } catch (\Throwable $th) {
           info($th);
        }

    }

    public function list(Request $request)
    {
        //nada
    }
}
