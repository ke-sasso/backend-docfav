<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UpdateUser{

    public function execute($id,$datos)
    {
        $val=$this->validateUserData($datos);
        if($val){
            return response()->json([
                'error' => 'Error de validación',
                'mensaje' =>$val
            ], 422);
        }
        if($datos['email']){
            $val1=$this->validateEmail($id,$datos['email']);
            if($val1>0){
                return response()->json([
                    'error' => 'Error de validación',
                    'mensaje' =>"El correo electrónico ingresado ya existe"
                ], 422);
            }
        }
        if($datos['username']){
            $val2=User::usernamelval($id,$datos['username']);
            if($val2>0){
                return response()->json([
                    'error' => 'Error de validación',
                    'mensaje' =>"El user name ingresado ya existe"
                ], 422);
            }
        }
        $data=User::updatedata($id,$datos);
            return response()->json([
                'mensaje' =>'Usuario actualizado con éxito',
                'iduser'=>$data
        ], 201);
    }

    private function validateUserData($userData)
    {
        $rules = [
            'name' => 'nullable|string|max:250',
            'address' => 'nullable',
            'phonenumber' => 'nullable',
            'username' => 'nullable|string|max:500',
            'email'   =>'nullable|string|email|max:250',
        ];
        $v = Validator::make($userData, $rules);
        if ($v->fails()) {
            return $v->messages()->all();
        }
    }

    private function validateEmail($id,$email)
    {
        return User::emailval($id,$email);
    }

    
    private function validateUserName($id,$user)
    {
       return User::usernamelval($id,$user);
    }

}