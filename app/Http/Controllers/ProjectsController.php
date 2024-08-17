<?php

namespace App\Http\Controllers;

use App\Cqrs\CreaterProjectsComand;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {

            (new CreaterProjectsComand)->create(titulo: $request->titulo, descricao: $request->descricao,
            dataEncerramento: $request->data_encerramento, userId: auth()->user()->id);
            return back()->with('status', 'Projeto cadastrado');

        } catch (\Throwable $th) {
           dd($th);
        }

    }
}
