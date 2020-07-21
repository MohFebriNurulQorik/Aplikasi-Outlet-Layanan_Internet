<?php

namespace App\Http\Controllers;
use App\Layanan;
use App\User;
use App\Transaksi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransaksiController extends Controller
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
    
    
    public function transaksi()
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
                $data = DB::table('transaksi')
                ->join('layanan', 'layanan.Id', '=', 'transaksi.Id_layanan')
                ->join('users', 'users.id', '=', 'transaksi.Id_users')
                ->select('users.*', 'layanan.*', 'transaksi.*')
                ->get();
                return response()->json(['data_user'=>$data,'status' => 'sukses', 'token' => $token]);
               }
            }
            
        }else{
            return response()->json(['status' => 'error', 'token' => $token]);
        }
    }
    public function transaksi_user($id){
        @$token=request()->token;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();

            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }else{
                $data = DB::table('transaksi')
                ->join('layanan', 'layanan.Id', '=', 'transaksi.Id_layanan')
                ->join('users', 'users.id', '=', 'transaksi.Id_users')
                ->select('users.*', 'layanan.*', 'transaksi.*')
                ->where('transaksi.Id_users',$id)
                ->get();
                
                return response()->json(['data'=>$data,'status' => 'sukses', 'token' => $token]);
               
            }
            
        }else{
            return response()->json(['status' => 'erorr', 'token' => $token]);
        }
    }
    public function deatail_transaksi($id){
        @$token=request()->token;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();

            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }else{
                $data = DB::table('transaksi')
                ->join('layanan', 'layanan.Id', '=', 'transaksi.Id_layanan')
                ->join('users', 'users.id', '=', 'transaksi.Id_users')
                ->select('users.*', 'layanan.*', 'transaksi.*')
                ->where('transaksi.Id',$id)
                ->get();
                return response()->json(['data'=>$data,'status' => 'sukses', 'token' => $token]);
               
            }
            
        }else{
            return response()->json(['status' => 'erorr', 'token' => $token]);
        }
    }
    public function create_transaksi(Request $request){
        @$token=request()->token;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();
            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                $this->validate($request, [
                    'Id_users' => 'required|numeric|digits_between:1,11',
                    'Id_layanan' => 'required|numeric|digits_between:1,11',
                    'Priode_start' => 'required',
                    'Priode_end' => 'required',
                    'Status_pembayaran' => 'required',
                    'Tgl_bayar' => 'required',
                    'Nominal_dibayarkan' => 'required|numeric|digits_between:1,11',
                    'Status_penagihan' => 'required',
                ]);

                $Transaksi = new Transaksi;
                $Transaksi->Id_users = $request->Id_users;
                $Transaksi->Id_layanan = $request->Id_layanan;
                $Transaksi->Priode_start = $request->Priode_start;
                $Transaksi->Priode_end = $request->Priode_end;
                $Transaksi->Status_pembayaran = $request->Status_pembayaran;
                $Transaksi->Tgl_bayar = $request->Tgl_bayar;
                $Transaksi->Nominal_dibayarkan = $request->Nominal_dibayarkan;
                $Transaksi->Status_penagihan = $request->Status_penagihan;
                $Transaksi->save();

                return response()->json(['status' => 'sukses', 'token' => $token]);
            }else{
                return response()->json(['status' => 'eror, hanya Admin yang dapat create user baru', 'token' => $token]);
            }
            
        }else{
            return response()->json(['status' => 'eror', 'token' => $token]);
        }
    }
    public function edit_transaksi(Request $request,$id){
        @$token=request()->token;

        if(@isset($token)){
            $result=User::where('token', $token)
            ->select("*")
            ->get();
            if($result->isEmpty()){
                return response()->json(['status' => 'token salah', 'token' => $token]);
            }elseif($result[0]->roles_id==1||$result[0]->roles_id=='1'){
                $this->validate($request, [
                    'Id_users' => 'required|numeric|digits_between:1,11',
                    'Id_layanan' => 'required|numeric|digits_between:1,11',
                    'Priode_start' => 'required',
                    'Priode_end' => 'required',
                    'Status_pembayaran' => 'required',
                    'Tgl_bayar' => 'required',
                    'Nominal_dibayarkan' => 'required|numeric|digits_between:1,11',
                    'Status_penagihan' => 'required',
                ]);

                $Transaksi = Transaksi::find($id);
                $Transaksi->Id_users = $request->Id_users;
                $Transaksi->Id_layanan = $request->Id_layanan;
                $Transaksi->Priode_start = $request->Priode_start;
                $Transaksi->Priode_end = $request->Priode_end;
                $Transaksi->Status_pembayaran = $request->Status_pembayaran;
                $Transaksi->Tgl_bayar = $request->Tgl_bayar;
                $Transaksi->Nominal_dibayarkan = $request->Nominal_dibayarkan;
                $Transaksi->Status_penagihan = $request->Status_penagihan;
                $Transaksi->save();

                return response()->json(['status' => 'sukses', 'token' => $token]);
            }else{
                return response()->json(['status' => 'eror, hanya Admin yang dapat update user baru', 'token' => $token]);
            }
            
        }else{
            return response()->json(['status' => 'eror', 'token' => $token]);
        }
    }

    //
}
