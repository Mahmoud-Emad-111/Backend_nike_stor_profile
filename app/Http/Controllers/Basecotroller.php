<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Basecotroller extends Controller
{
    //
    public function handelResponse($result='',$msg){
        $res=[
            'success'=>true,
            'data'=>$result,
            'message'=>$msg
        ];
        return response()->json($res,200);
    }
    public function handelError($error,$errorMSG=[],$code=404){
        $res=[
            'succes'=>false,
            'message'=>$error,
        ];
        if (!empty($errorMSG)) {
            $res['data']=$errorMSG;
        }
        return response()->json($res,$code);
    }
}
