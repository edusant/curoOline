<?php

namespace App\Http\Controllers;

use App\Cqrs\CreateTask;
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

            (new CreateTask)->create(titulo: $request->titulo,
            descricao: $request->descricao,
            dataEncerramento: $request->data_encerramento, userId: auth()->user()->id,
            status:$request->status, projectId: $request->project_id);
            return back()->with('status', 'task cadastrada');

        } catch (\Throwable $th) {
           dd($th);
        }
    }
}
