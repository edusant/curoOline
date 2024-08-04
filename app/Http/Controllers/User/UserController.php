<?php
namespace App\Http\Controllers\User;

use App\Cqrs\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Rules\Request\RateLimit;
use App\Services\User\CriarToken;
use Illuminate\Http\Request;
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
            'name.required' => 'Nome é obrigatório',
            'password.required' => 'password é obrigatório',
            'password.min' => 'password deve ter no mínimo 4 letras',
            'email.unique' => 'Email já cadastrado.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        CreateUser::create($request->all());
        return response()->json(["Cadastro"=> true], 201);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','email', new RateLimit],
            'password' => 'required|min:4',
        ], [
            'password.required' => 'password é obrigatório',
            'password.min' => 'password deve ter no mínimo 4 letras',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $credentials['email'] = strtolower($request->email);
        $credentials['password'] = $request->password;

        return (new CriarToken())->criaToken($credentials);

    }

}
