<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function login(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:6'
    ]);

    $user = User::where('email', $request->email)
    ->where('passowrd', $request->password)            
    ->first();
        
        if(!$user->isEmpty()){
            
            
            do {
                $token = Str::random(10); 
                $update_token = User::where('token', $token)          
                ->get();
            } while (!$update_token->isEmpty());
            $user = User::where('email', $request->email)
            ->where('passowrd', $request->password) 
            ->update(['token' => $token]); 
            return response()->json(['status' => 'sukses', 'token' => $token]);
        } 
        
    return response()->json(['status' => 'error']);
}
    public function users()
    {
        @$token=request()->token;
        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();

            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }else{
               if($result[0]->roles_id!=1||$result[0]->roles_id!='1'){
                $data=User::find($result[0]->id);
                return response()->json(['data_user'=>$data,'status' => 'sukses', 'token' => $token]);
               } else{
                
                $data=User::all();
                return response()->json(['data_user'=>$data,'status' => 'sukses', 'token' => $token]);
               }
            }
            
        }else{
            return response()->json(['status' => 'error', 'token' => $token]);
        }
    }
    public function deatail_user($id){
        @$token=request()->token;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();

            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }else{
               if($result[0]->roles_id!=1||$result[0]->roles_id!='1'){
                $data=User::find($result[0]->id);
                return response()->json(['data'=>$data,'status' => 'sukses', 'token' => $token]);
               } else{
                $data=User::find($id);
                return response()->json(['data'=>$data,'status' => 'sukses', 'token' => $token]);
               }
            }
            
        }else{
            return response()->json(['status' => 'erorr', 'token' => $token]);
        }
        return $data;
    }
    public function create_user(Request $request){
        @$token=request()->token;
        @$email=request()->email;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();
            $result2=User::where('email', $email)
            ->select("*")
            ->get();
            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }elseif(!isset($result2)){
                return response()->json(['status' => 'email terpakai', 'token' => $token]);
            }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'phone' => 'required',
                    'adress' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'password_baru' => 'required|min:6',
                    'roles_id' => 'required'
                ]);
                // dd($token_baru);
                do {
                    $token_baru = Str::random(10); 
                    $update_token = User::where('token', $token_baru)          
                    ->get();
                } while (!$update_token->isEmpty());

                $User = new User;
                $User->name = $request->name;
                $User->phone = $request->phone;
                $User->adress = $request->adress;
                $User->email = $request->email;
                $User->password = $request->password_baru;
                $User->roles_id = $request->roles_id;
                $User->token = $token_baru;
                $User->save();

                return response()->json(['status' => 'sukses', 'token' => $token]);
            }else{
                return response()->json(['status' => 'eror, hanya Admin yang dapat create user baru', 'token' => $token]);
            }
            
        }else{
            return response()->json(['status' => 'eror', 'token' => $token]);
        }
    }
    public function edit_user(Request $request,$id){
        @$token=request()->token;
        @$email=request()->email;

        if(@isset($token)){
            $result = User::where('token', $token)
            ->select("*")
            ->get();
            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'phone' => 'required',
                    'adress' => 'required|string',
                    'email' => 'required|email',
                    'password_baru' => 'required|min:6',
                    'roles_id' => 'required',
                    'status' => 'required',
                ]);
                
                do {
                    $token_baru = Str::random(10); 
                    $update_token = User::where('token', $token_baru)          
                    ->get();
                } while (!$update_token->isEmpty());

                $User = User::find($id);
                $User->name = $request->name;
                $User->phone = $request->phone;
                $User->adress = $request->adress;
                $User->email = $request->email;
                $User->password = $request->password_baru;
                $User->roles_id = $request->roles_id;
                $User->token = $token_baru;
                $User->status = $request->status;
                $User->save();

                return response()->json(['status' => 'sukses', 'token' => $token]);
            }else{
                return response()->json(['status' => 'eror, hanya Admin yang dapat update user baru', 'token' => $token]);
            }
            
        }else{
            return response()->json(['status' => 'eror', 'token' => $token]);
        }
    }
}
