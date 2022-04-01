<?php

namespace App\Http\Controllers;      // php artisan make:controller UserController

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function AddUser(Request $request) {
        $validator              =       Validator::make($request->all(), [
            "full_name"         =>     "required",
            "email"             =>     "required|email|unique:email"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        $userDataArray          =       array(
           
            "full_name"          =>          $request->full_name,
            "email"              =>          $request->email
        );

        $user_status  =   User::where("email", $request->email)->first();  // email exists or not

        if(!is_null($user_status)) {
          
			$user  =    User::create($userDataArray);   // Data store
		
		 $response = ["status" => "True", "message" => "User added Successfully"];
        }
		else {
            $response = ["status" => "failed","message" => "failed to add"];
        }
    }
	
public function UserDetails()
    {
        $users = DB::table('users')->select('id','full_name','email')->get();

        $response = ["UserDetails" => $users,"message" => "Data Fetched Successfully"];
    }
	
echo json_encode($response)
}