<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\API\BaseController;

class ApiAuthController extends BaseController
{
    //
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'Pengguna berhasil mendaftar.');
    }

    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'Pengguna berhasil login.');
        } 
        else{ 
            return $this->sendError('Tidak memiliki hak akses.', ['error'=>'Username Atau Password Salah']);
        } 
    }
    // GET [Auth: Token]
    public function logout(){

        auth()->user()->tokens()->delete();
        $user = Auth::user(); 
        return response()->json([
            "status" => true,
            "message" => "User logged out",
            "data" => [$user]
        ]);
    }
}
