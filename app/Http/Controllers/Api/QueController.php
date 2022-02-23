<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class QueController extends Controller
{

    public function one() {
        $arr_values = [5,-9,-8,4,-9,4,7,10,7];
        sort($arr_values);
        foreach($arr_values as $key => $value) {
            if(!in_array($key+1, $arr_values)) {
                return response()->json($key+1);
            }
        }    
    }

    public function two() {
        $validator = \Validator::make(request()->all(), [
            'start'     => 'required|numeric',
            'end'       => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->all()], 200);
        }   

        if(request('start') >= request('end')) {
            return response()->json(['success' => false, 'error' => ['End Must Be Greater Than Start']], 200);
        }
        $start = request('start');
        $end = request('end');
        $range = range($start, $end);
        foreach($range as $key => $value) {

            if(strpos(strval($value), '5') !== false) {
                unset($range[$key]);
            }
        }
        return response()->json(count($range));
    }

    public function three() {
        $array = array(4,4, 3,2,3,2,5, 3, 15, 3, 9, 5, 7, 9, 7);
        $all = array_count_values($array);
        foreach($all as $key => $one) {
            if($one == 1) {
                return response()->json($key);
            }
        }      
    }
    public function four() {
        $array = array(4,4, 3,2,3,2,5, 3, 15, 3, 9, 5, 7, 9, 7);
        $all = array_count_values($array);
        foreach($all as $key => $one) {
            if($one == 1) {
                return response()->json($key);
            }
        }      
    }

    public function five() {
        $array = [];
        $counter = 1;
        for ($i = 'A'; $i !== 'AAAA'; $i++){
            $array[$counter] = $i;
            $counter ++;
        }
        $input_string1 = array_flip($array)['BFG'];
        $input_string2 = array_flip($array)['AAA'];
        $input_string3 = array_flip($array)['AZA'];
        return response()->json(['input_string1' => $input_string1 , 'input_string2' => $input_string2 , 'input_string3' => $input_string3]);
         
    }

}
