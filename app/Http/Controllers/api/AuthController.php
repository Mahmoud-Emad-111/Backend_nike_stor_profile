<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Basecotroller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class AuthController extends Basecotroller
{
    //
    public function login(Request $request){
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $auth=Auth::user();
            $success['token']=$auth->createToken('elsyed_hot')->plainTextToken;
            $success['name']=$auth->name;
            $success['email']=$auth->email;

            return $this->handelResponse($success,'User loggin');
        }
        else{
            return $this->handelError('Unauthoriset',['error'=>'Unauthoriset']);
        }
    }
    public function resgister(Request $request){
        $validator=Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password'=>'required',
                'confirm_password'=>'same:password|required',
            ]

        );

        if ($validator->fails()) {
            return $this->handelError($validator->errors());
        }
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $success['token']=$user->createToken('elsyed_hot')->plainTextToken;
        $success['name']=$user->name;
        $success['email']=$user->email;
        return $this->handelResponse($success,'User successful Register');
    }
     public function logout(Request $request){
        $user= $request->user();
        return $user->currentAccessToken()->delete();

    }
    public function upload_img(Request $request){
        $user=Auth::user();
        $image=$request->hasFile('file')
        ? $request->file('file')
        : null;
        $file_name=Str::random(32).'.'.$image->getClientOriginalExtension();
        $image->move('user_images/',$file_name);
        $user->img=$file_name;
        $user->save();
        return $this->handelResponse('','User successful Register');
    }

    public function get_image(){
        $image=Auth::user()->img;
        return $this->handelResponse($image,'successful get image profile');


    }
}
