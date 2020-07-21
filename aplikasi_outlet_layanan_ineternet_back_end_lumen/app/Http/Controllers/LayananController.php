<?php

namespace App\Http\Controllers;
use App\Layanan;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LayananController extends Controller
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
    
  
        public function layanan()
        {
            @$token=request()->token;
            if(@isset($token)){
                $result=User::where('token', $token)
                ->select("*")
                ->get();
    
                if($result->isEmpty()){
                    return response()->json(['status' => 'token salah', 'token' => $token]);
                }else{
                   if($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                    $data=Layanan::all();
                    return response()->json(['data_user'=>$data,'status' => 'sukses', 'token' => $token]);
                   }
                }
                
            }else{
                return response()->json(['status' => 'error', 'token' => $token]);
            }
        }
        public function deatail_layanan($id){
            @$token=request()->token;
    
            if(@isset($token)){
                $result=User::where('token', $token)
                ->select("*")
                ->get();
    
                if($result->isEmpty()){
                    return response()->json(['status' => 'token salah', 'token' => $token]);
                }else{
                    $data=Layanan::find($id);
                    return response()->json(['data'=>$data,'status' => 'sukses', 'token' => $token]);
                   
                }
                
            }else{
                return response()->json(['status' => 'erorr', 'token' => $token]);
            }
        }
        public function create_layanan(Request $request){
            @$token=request()->token;
    
            if(@isset($token)){
                $result=User::where('token', $token)
                ->select("*")
                ->get();
                if($result->isEmpty()){
                    return response()->json(['status' => 'token salah', 'token' => $token]);
                }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                    $this->validate($request, [
                        'Nama_layanan' => 'required|string|max:255',
                        'Biaya_berlangganan' => 'required|numeric|digits_between:1,11',
                        'Bandwith' => 'required|string|max:255',
                        'Kapasitas_jaringan' => 'required|string|max:255',
                        'Kecepatan_transfer_data' => 'required|string|max:255',
                        'Type' => 'required'
                    ]);
    
                    $Layanan = new Layanan;
                    $Layanan->Nama_layanan = $request->Nama_layanan;
                    $Layanan->Biaya_berlangganan = $request->Biaya_berlangganan;
                    $Layanan->Bandwith = $request->Bandwith;
                    $Layanan->Kapasitas_jaringan = $request->Kapasitas_jaringan;
                    $Layanan->Kecepatan_transfer_data = $request->Kecepatan_transfer_data;
                    $Layanan->Type = $request->Type;
                    $Layanan->save();
    
                    return response()->json(['status' => 'sukses', 'token' => $token]);
                }else{
                    return response()->json(['status' => 'eror, hanya Admin yang dapat create user baru', 'token' => $token]);
                }
                
            }else{
                return response()->json(['status' => 'eror', 'token' => $token]);
            }
        }
        public function edit_layanan(Request $request,$id){
            @$token=request()->token;
    
            if(@isset($token)){
                $result=User::where('token', $token)
                ->select("*")
                ->get();
                if($result->isEmpty()){
                    return response()->json(['status' => 'token salah', 'token' => $token]);
                }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                    $this->validate($request, [
                        'Nama_layanan' => 'required|string|max:255',
                        'Biaya_berlangganan' => 'required|numeric|digits_between:1,11',
                        'Bandwith' => 'required|string|max:255',
                        'Kapasitas_jaringan' => 'required|string|max:255',
                        'Kecepatan_transfer_data' => 'required|string|max:255',
                        'Type' => 'required',
                        'Status'=> 'required'
                    ]);

                    $Layanan=Layanan::find($id);
                    $Layanan->Nama_layanan = $request->Nama_layanan;
                    $Layanan->Biaya_berlangganan = $request->Biaya_berlangganan;
                    $Layanan->Bandwith = $request->Bandwith;
                    $Layanan->Kapasitas_jaringan = $request->Kapasitas_jaringan;
                    $Layanan->Kecepatan_transfer_data = $request->Kecepatan_transfer_data;
                    $Layanan->Type = $request->Type;
                    $Layanan->Status = $request->status;
                    $Layanan->save();
    
                    return response()->json(['status' => 'sukses', 'token' => $token]);
                }else{
                    return response()->json(['status' => 'eror, hanya Admin yang dapat update user baru', 'token' => $token]);
                }
                
            }else{
                return response()->json(['status' => 'eror', 'token' => $token]);
            }
        }
}
