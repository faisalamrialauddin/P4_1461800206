<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\User;

class PraktikumController extends Controller
{
    public function dokter(){
        $dokter = Dokter::get();
        return view ('dokter0206',['dokter'=> $dokter]);
    }
    public function kamar(){
        $data = DB::table('kamar')->select(DB::raw('kamar.id,dokter.nama as nama_dokter, pasien.nama as nama_pasien, alamat'))->join('pasien','kamar.id_pasien','pasien.id')->join('dokter','kamar.id_dokter','dokter.id')->get();
        // dd($data->all());
        return view ('kamar0206',['kamar'=>$data]);
    }
    public function pasien(){
        $data = Pasien::get();
        // dd($data->all());
        return view ('pasien0206',['pasien'=>$data]);
    }
    public function user(){
        $data = User::get();
        // dd($data->all());
        return view ('user0206',['user'=>$data]);
    }
    public function user_update(request $request){
        // $data = User::where('id',$request->id)->fir;
        DB::table('user')->where('id',$request->id)->update([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'password'=>$request->password,
        ]);
        // dd($data->all());
        return redirect('/user');
    }
    public function user_edit($id){
        $data = User::where('id',$id)->get();
        // dd($data->all());
        return view ('update_user0206',['user'=>$data]);
    }
    public function kamar_filter(Request $request){
        $data = $data = DB::table('kamar')
        ->select(DB::raw('kamar.id,dokter.nama as nama_dokter, pasien.nama as nama_pasien, alamat'))
        ->join('pasien','kamar.id_pasien','pasien.id')
        ->join('dokter','kamar.id_dokter','dokter.id')
        ->where('alamat',$request->alamat)->get();
        // dd($data->all());
        return view ('kamar0206',['kamar'=>$data]);
    }
    public function dokter_filter(Request $request){
        // dd($request->all());
        $dokter = Dokter::where('jabatan',$request->jabatan)->get();
        return view ('dokter0206',['dokter'=> $dokter]);
    }

    public function tambah_pasien(Request $request){
        DB::table('pasien')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
        ]);
        return redirect('/pasien');
    }
    
    
    
}
