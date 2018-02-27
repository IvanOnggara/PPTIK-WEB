<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Quotation;
use App\Mahasiswa;
use App\DataPengambilan;
use App\StatusMahasiswa;

class registerController extends Controller
{
//register mahasiswa
    public function register(Request $request){
    	date_default_timezone_set("Asia/Jakarta");
    	$nim=$_POST['nim'];
    	if(strlen($nim)!=9){
    		return redirect('/registration_result')->with('statusRegister', 'NIM harus berisi 9 angka!');
    	}

		$password=$_POST['password'];
		$passwordver=$_POST['passwordver'];
		if($password != $passwordver){
    		return redirect('/registration_result')->with('statusRegister', 'Password dan Verifikasi Password berbeda!');
    	}

		if(strlen($password)<6){
    		return redirect('/registration_result')->with('statusRegister', 'Password minimal berisi 6 karakter!');
    	}

		$nama1=$_POST['nama'];
		$nama1 = trim($nama1,' ');
		$nama=ucwords(strtolower($nama1));

		$jenissertifikasi=$_POST['jenissertifikasi'];
		$data = DB::table('mahasiswa')->where('nim',$nim);
		$count = $data->count();
		if ($count>=1) {
			return redirect('/registration_result')->with('statusRegister', 'Registrasi gagal ! NIM anda sudah terdaftar. silahkan login untuk melakukan registrasi sertifikasi lainnya!');
		}else{
			$mahasiswa = new Mahasiswa;

        	$mahasiswa->nim = $request->nim;
        	$mahasiswa->nama = $nama;
        	$mahasiswa->password = md5($request->password);
        	$mahasiswa->save();
//-----------------
        	$datapengambilan = new DataPengambilan;
			$datapengambilan->nim = $request->nim;
        	if ($request->jenissertifikasi == 'MTA') {
	        	$datapengambilan->mta = 1;
	        	$datapengambilan->scm = 0;
	        	$datapengambilan->mos = 0;
	        	$datapengambilan->mtcna = 0;
        	}else if ($request->jenissertifikasi == 'SCM') {
	        	$datapengambilan->mta = 0;
	        	$datapengambilan->scm = 1;
	        	$datapengambilan->mos = 0;
	        	$datapengambilan->mtcna = 0;
        	}else if ($request->jenissertifikasi == 'MOS') {
	        	$datapengambilan->mta = 0;
	        	$datapengambilan->scm = 0;
	        	$datapengambilan->mos = 1;
	        	$datapengambilan->mtcna = 0;
        	}else if ($request->jenissertifikasi == 'MTCNA') {
	        	$datapengambilan->mta = 0;
	        	$datapengambilan->scm = 0;
	        	$datapengambilan->mos = 0;
	        	$datapengambilan->mtcna = 1;
        	}

        	$datapengambilan->save();
//----------------------------
        	$statusmahasiswa = new StatusMahasiswa;
			$statusmahasiswa->nim = $request->nim;
        	if ($request->jenissertifikasi == 'MTA') {
	        	$statusmahasiswa->status_mta = 'active';
	        }else {
	        	$statusmahasiswa->status_mta = 'inactive';
	        }

	        if ($request->jenissertifikasi == 'MOS') {
	        	$statusmahasiswa->status_mos = 'active';
	        }else {
	        	$statusmahasiswa->status_mos = 'inactive';
	        }

	        if ($request->jenissertifikasi == 'SCM') {
	        	$statusmahasiswa->status_scm = 'active';
	        }else {
	        	$statusmahasiswa->status_scm = 'inactive';
	        }

	        if ($request->jenissertifikasi == 'MTCNA') {
	        	$statusmahasiswa->status_mtcna = 'active';
	        }else {
	        	$statusmahasiswa->status_mtcna = 'inactive';
	        }


        	$statusmahasiswa->save();

			return redirect('/registration_result')->with('statusRegisterSukses', 'Registrasi berhasil !');
		}
    }
}