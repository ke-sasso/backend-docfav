<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\CustomValidationException;
use App\Models\User;
use App\UseCases\NewUserCreate;
use App\UseCases\UpdateUser;

class UserRepositoryController extends Controller
{
  

    private $saveNewUserUseCase;
    private $saveUpdateUserUseCase;
    public function __construct(NewUserCreate $saveNewUserUseCase,UpdateUser $saveUpdateUserUseCase)
    {
        $this->saveNewUserUseCase = $saveNewUserUseCase;
        $this->saveUpdateUserUseCase = $saveUpdateUserUseCase;
    }


    public function createUser(Request $request){
        try{
            $newUser = $this->saveNewUserUseCase->execute($request->all());
            return $newUser;
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error server',
                'mensaje' =>'Problemas para procesar la petición'
            ], 500);
        }
    } 

    public function updateUser(Request $request, $id){
        try{
            $user = $this->saveUpdateUserUseCase->execute($id,$request->input());
            return $user;
        }catch (\Exception $e){
            return $e;
            return response()->json([
                'error' => 'Error server',
                'mensaje' =>'Problemas para procesar la petición'
            ], 500);
        }
    } 


    public function deleteUser($id){
        if(!isset($id)){
            return response()->json([
                'error' => 'Error de validación',
                'mensaje' =>'Es requerido ingresar ID',
            ], 422);
        }
        try{
            $val=User::find($id);
            if(!empty($val)){
                User::deletedata($id);
                return response()->json([
                    'mensaje' =>'Usuario eliminado con éxito',
                ], 201);
            }else{
                return response()->json([
                    'mensaje' =>'Usuario no encontrado'
                ], 300);
            }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error server',
                'mensaje' =>'Problemas para procesar la petición'
            ], 500);
        }
    } 

    public function datosUser($id){
        if(!isset($id)){
            return response()->json([
                'error' => 'Error de validación',
                'mensaje' =>'Es requerido ingresar ID',
            ], 422);
        }
        try{
            $datos=User::find($id);
            if(!empty($datos)){
                return response()->json([
                    'mensaje' =>'Usuario encontrado',
                    'datos' => $datos
                ], 201);
            }else{
                return response()->json([
                    'mensaje' =>'Usuario no encontrado'
                ], 300);
            }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error server',
                'mensaje' =>'Problemas para procesar la petición'
            ], 500);
        }
    } 

}

?>
