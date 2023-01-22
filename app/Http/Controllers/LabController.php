<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metadatas = ambil_satudata('metadata',7);
        $labs = ambil_semuadata('lab');
        return view('lab.index',['labs'=> $labs],['metadatas'=>$metadatas]);  
    }
    public function tambah_lab () 
    {    
        $metadatas = ambil_satudata('metadata',8);
        return view('lab.tambah',['metadatas'=>$metadatas]);   
    }
    
       public function simpan_lab(Request $request)
    { 
        $this->validate($request, [
            'nama_lab' => 'required|min:4|max:25',
            'harga' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required|max:10',
        ]);
        DB::table('lab')->insert([
            'nama' => $request->nama_lab,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'created_time' => Carbon::now(),
            'updated_time' => Carbon::now(),
        ]);
           $ids= DB::table('lab')->orderby('id','desc')->first();         
            switch($request->simpan) {
                case 'simpan': 
                    $buka=url('lab/edit/'. $ids->id);
                    $pesan='Data lab berhasil disimpan!';
                break;             
                case 'simpan_baru': 
                    $buka=route('lab.tambah');
                    $pesan='Data lab berhasil disimpan!';
                break;
            }
        return redirect($buka)->with('pesan',$pesan);
    }
    
        //Proses Update Pasien
        public function update_lab(Request $request)
    {
            $this->validate($request, [
                'nama_lab' => 'required|min:4|max:25',
                'harga' => 'required|numeric|digits_between:1,7',
                'satuan' => 'required|max:10',
            ]);
            
            DB::table('lab')->where('id',$request->id)->update([
                'nama' => $request->nama_lab,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'updated_time' => Carbon::now()
            ]);
     
            switch($request->simpan) {
                 case 'simpan':
                    $buka='/lab/edit/'.$request->id;
                    $pesan='Data pasien berhasil disimpan!';
                break;           
                case 'simpan_baru': 
                    $buka='/lab/tambah';
                    $pesan='Data pasien berhasil disimpan!';
                break;
            }
        return redirect($buka)->with('pesan',$pesan);
    }
    
    public function edit_lab($id)
    {
        $metadatas = ambil_satudata('metadata',9);
        $datas= ambil_satudata('lab',$id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        return view('lab.edit',['metadatas'=>$metadatas],['datas'=>$datas]);
    }
    
    public function hapus_lab($id)
    {
        DB::table('lab')->where('id',$id)->update([
            'deleted' => 1,
        ]);
        $pesan="Data lab berhasil dihapus!";
        return redirect(route("lab"))->with('pesan',$pesan);
    }
}
