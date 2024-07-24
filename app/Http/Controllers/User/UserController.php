<?php
namespace App\Http\Controllers\User;

use App\Cqrs\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function criarConta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ], [
            'email.unique' => 'Email já cadastrado.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        CreateUser::create($request->all());

        return response()->json(["Cadastro"=> true], 201);
    }

}
