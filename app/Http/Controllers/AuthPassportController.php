<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthPassportController extends Controller
{
    public function register(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8',
        ]
        );
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        $token = $user->createToken('hatem')->accessToken;
        return response()->json(['token'=>$token],200);

    }

    public function login(Request $request){
        $data = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(auth()->attempt($data)){
            $token = auth()->user()->createToken('hatem')->accessToken;
            return response()->json(['token'=>$token],200);
        }else{
            return response()->json(['error'=>'Login failed ¿¿' ],401);
        }

    }

    public function userInfo(Request $request){
        $user = auth()->user();
        return response()->json(['user'=>$user],200);
    }

    public function users(){
        $user = User::all();
        return response()->json(['user'=>$user],200);
    }

    public function delete(Request $request){
        $id=$request->id;
        $user = User::find($id);
        $user->delete();
        $data=User::all();

        return response()->json($request, 200);

    }
}
