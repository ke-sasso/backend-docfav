<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class NewUserCreate{

    public function execute($datos)
    {
        $val=$this->validateUserData($datos);
        if($val){
            return response()->json([
                'error' => 'Error de validación',
                'mensaje' =>$val
            ], 422);
        }
        $user=User::create($datos);
        return response()->json([
            'mensaje' =>'Usuario creado con éxito',
            'user'=>$user
        ], 201);
    }

    private function validateUserData($userData)
    {
        $rules = [
            'name' => 'required|string|max:250',
            'username' => 'required|string|unique:users|max:500',
            'email'   =>'required|string|email|unique:users|max:250',
            'address' => 'required',
            'phonenumber' => 'required',
            'password' => 'required',
        ];
        $v = Validator::make($userData, $rules);
        if ($v->fails()) {
            return $v->messages()->all();
        }
    }

}