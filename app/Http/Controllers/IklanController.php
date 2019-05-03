<?php

namespace App\Http\Controllers;

use App\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class IklanController extends Controller
{
    public function __construct()
    {
        //middleware utk user yang sudah login
        $this->middleware('auth');
        /*if (Auth::check()) {
            return 'login';
        }else{
            return 'no login';
        }*/
    }

    public function iklan(){
        $user = Auth::user();
        $data = Iklan::orderBy('id', 'DESC')->get();
        return view('iklan.iklan', ['iklan' => 1, 'user' => $user, 'data' => $data]);
    }

    public function add(){
        $user = Auth::user();
        return view('iklan.add', ['iklan' => 1, 'user' => $user]);
    }

    public function store(Request $request){
        //validasi data dlu sebelum di proses
        $this->validate($request, [
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required',
        ]);

        //menyimpan data file yang diupload ke variabel file
        $file = $request->file('image');
        $nama_file = time().".".$file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'upload/image/';
        $file->move($tujuan_upload, $nama_file);

        Iklan::create([
            'image' => $nama_file,
            'judul' => $request->judul,
        ]);

        return redirect(action('IklanController@add'))->with('alert-success','Data berhasil ditambahkan!');
    }

    public function destroy($id){
        //hapus file
        //ambil data sesuai id
        $gambar = Iklan::where('id', $id)->first();
        //hapus File gambar sesuai nama gambarnya
        File::delete('upload/image/'.$gambar->image);

        //hapus data sesuai id
        Iklan::where('id', $id)->delete();
        return redirect('/iklan')->with('alert-success','Data berhasil dihapus!');
    }

    public function show($id){
        $user = Auth::user();
        //ambil data sesuai dengan id
        $iklan = Iklan::find($id);
        return view('iklan.edit')->with(['data' => $iklan, 'user' => $user, 'iklan' => 1]);
    }

    public function update(Request $request, $id){
//        dd($request->all());
        $image = $request->file('image');

        if($image != '')
        {
            //jika tidak kosong
            $request->validate([
                'judul' => 'required',
                'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            //menyimpan data file yang diupload ke variabel file
            $file = $request->file('image');
            $nama_file = time().".".$file->getClientOriginalExtension();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'upload/image/';
            $file->move($tujuan_upload, $nama_file);

            $iklan = Iklan::find($id);
            $gambar = $iklan->image;
            File::delete('upload/image/'.$gambar);
            $iklan->judul = $request->judul;
            $iklan->image = $nama_file;
            $iklan->save();

            $user = Auth::user();
            $data = Iklan::orderBy('id', 'DESC')->get();
            return redirect(action('IklanController@iklan'))->with(['alert-success' => 'Data berhasil ditambahkan!',
                'data' => $data, 'user' => $user, 'iklan' => 1]);
        }
        else
        {
            $iklan = Iklan::find($id);
            //kosong
            $request->validate([
                'judul' => 'required',
            ]);

            $gambar = $iklan->image;
            $iklan->judul = $request->judul;
            $iklan->image = $gambar;

            $iklan->save();

            $user = Auth::user();
            $data = Iklan::orderBy('id', 'DESC')->get();
            return redirect(action('IklanController@iklan'))->with(['alert-success' => 'Data berhasil ditambahkan!',
                'data' => $data, 'user' => $user, 'iklan' => 1]);
        }
    }
}