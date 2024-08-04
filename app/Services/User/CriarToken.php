<?php
namespace App\Services\User;

class CriarToken
{

    public function criaToken($credentials)
    {
        if (auth()->attempt($credentials)) {

            $user = auth()->user();

            $success['token'] =   $user->createToken('User_Token')->plainTextToken;
            $success['user']['id'] = $user->id;
            $success['user']['name'] =  $user->name;

            return response()->json($success, 201);
        }

        return response()->json('Não autorizado', 200);

    }

}
