<?php

namespace App\Http\Controllers;

use App\Iklan;
use Illuminate\Http\Request;

class ApiCotroller extends Controller
{
    public function iklan(){
        $data = Iklan::orderBy('id', 'DESC')->get();
        /*return response()->json([
            'pesan' => 'sukses',
            'code' => 200,
            'iklan' => $data
        ]);*/

//        if ($data->count() > 0)
        if(!$data || count($data) <= 0){
            return response()->json([
                'pesan' => 'failed',
                'error' => 'true',
                'code' => 404,
                'iklan' => $data
            ]);
        }else{
            return response()->json([
                'pesan' => 'success',
                'error' => 'false',
                'code' => 200,
                'iklan' => $data
            ]);
        }
    }
}
