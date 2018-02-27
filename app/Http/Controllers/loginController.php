<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Quotation;
use Session;

class loginController extends Controller
{
//login mahasiswa
    public function login(Request $request){
    	date_default_timezone_set("Asia/Jakarta");
		$nim=$_POST['nim'];
		$password=$_POST['password'];
		
		$password = md5($password);

		$data = DB::table('mahasiswa')->where([
			['nim',$nim],['password',$password]
		]);
		
		$count = $data->count();
		$data2 = $data->first();
		if ($count>=1) {
			session(['user' => $data2->nama]);
			session(['nim' => $data2->nim]);
			return redirect('/home');
		}else{
			return redirect('/')->with('status', 'Username atau Password anda salah!');
		}
    }
}
