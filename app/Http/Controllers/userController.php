<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Jadwal;
use App\Mahasiswa;
use App\PesertaUjian;
use App\StatusMahasiswa;
use App\Bukti;
use App\Http\Controllers\Controller;

use Session;
use DB;
use Carbon;

class userController extends Controller
{  
      //menampilkan home user
      public function home(){
            
          if (Session::has('user')) {
            $nim = Session::get('nim');

            $jadwal = Jadwal::where('status','active')->get();

            foreach ($jadwal as $perjadwal) {
                  if ($perjadwal->tanggal_3 < date("Y-m-d")) {
                        

                        $peserta = PesertaUjian::where('id_jadwal',$perjadwal->id_jadwal)->get();
                        
                        $temp = 'status_'.$perjadwal->jenis_sertifikasi;

                        foreach ($peserta as $perpeserta) {
                              $mahasiswa = StatusMahasiswa::find($perpeserta->nim);

                              $mahasiswa->$temp = 'inactive';
                              $stat = $mahasiswa->save();
                              
                        }
                        $perjadwal->status = 'inactive';
                        $perjadwal->save();
                  }
            }

            $status = DB::table('status_mahasiswa')->where('nim',$nim)->first();

            if ( $status->status_mta == 'active' || $status->status_mta == 'active-jadwal') {
                   $status->status_mta = 'Terdaftar';
            }elseif ( $status->status_mta == 'inactive') {
                   $status->status_mta = 'Tidak Terdaftar';
            }elseif ( $status->status_mta == 'waiting'){
                   $status->status_mta = 'Menunggu';
            }elseif ($status->status_mta == 'lulus') {
                  $status->status_mta = 'Lulus';
            }

            if ( $status->status_mos == 'active' || $status->status_mos == 'active-jadwal') {
                   $status->status_mos = 'Terdaftar';
            }elseif ( $status->status_mos == 'inactive') {
                   $status->status_mos = 'Tidak Terdaftar';
            }elseif ( $status->status_mos == 'waiting'){
                   $status->status_mos = 'Menunggu';
            }elseif ($status->status_mos == 'lulus') {
                  $status->status_mos = 'Lulus';
            }

            if ( $status->status_scm == 'active' || $status->status_scm == 'active-jadwal') {
                   $status->status_scm = 'Terdaftar';
            }elseif ( $status->status_scm == 'inactive') {
                   $status->status_scm = 'Tidak Terdaftar';
            }elseif ( $status->status_scm == 'waiting'){
                   $status->status_scm = 'Menunggu';
            }elseif ($status->status_scm == 'lulus') {
                  $status->status_scm = 'Lulus';
            }

            if ( $status->status_mtcna == 'active' || $status->status_mtcna == 'active-jadwal') {
                   $status->status_mtcna = 'Terdaftar';
            }elseif ( $status->status_mtcna == 'inactive') {
                   $status->status_mtcna = 'Tidak Terdaftar';
            }elseif ( $status->status_mtcna == 'waiting'){
                   $status->status_mtcna = 'Menunggu';
            }elseif ($status->status_mtcna == 'lulus') {
                  $status->status_mtcna = 'Lulus';
            }


            $jadwal = DB::table('jadwal')->whereDate('tanggal_1', '>', date('Y-m-d'))->get();
            foreach ($jadwal as $perjadwal) {
                  $explode = explode("-", $perjadwal->tanggal_1);
                  $perjadwal->bulan = substr(monthCreator($explode[1]),0,3);
                  $perjadwal->tanggal = $explode[2];

                  if ($perjadwal->jenis_sertifikasi == 'mta') {
                        $perjadwal->sertifikasi = 'Microsoft Technology Associate (MTA)';
                  }elseif ($perjadwal->jenis_sertifikasi == 'mos') {
                        $perjadwal->sertifikasi = 'Microsoft Office Specialist (MOS)';
                  }elseif ($perjadwal->jenis_sertifikasi == 'scm') {
                        $perjadwal->sertifikasi = 'Security Compliance Manager (SCM)';
                  }else{
                        $perjadwal->sertifikasi = 'MikroTik Certified Network Associate (MTCNA)';
                  }

                  $perjadwal->jadwallengkap1 = dateDayCreator($perjadwal->tanggal_1);
                  $perjadwal->jadwallengkap2 = dateDayCreator($perjadwal->tanggal_2);
                  $perjadwal->jadwallengkap3 = dateDayCreator($perjadwal->tanggal_3);
            }
            
            $arrayall = array(
                  'statusall'  => $status,
                  'jadwal'   => $jadwal
            );
            return view('user/home_user',['all'=>$arrayall]);
          }else{
            return redirect('/');
          }
      }

//change password mahasiswa
	public function changePassword(){
            date_default_timezone_set("Asia/Jakarta");
		if (Session::has('user')) {
			return view('user/changepassword');
		}else{
			return redirect('/');
		}
	}

//FAQ untuk user
	public function bantuan(){
            date_default_timezone_set("Asia/Jakarta");
		if (Session::has('user')) {
			return view('user/bantuan');
		}else{
			return redirect('/');
		}
	}

//list jadwal mahasiswa
	public function jadwal(Request $request){
            date_default_timezone_set("Asia/Jakarta");
		if (Session::has('user')) {
			$nim = Session::get('nim');
			$jadwalmta = DB::table('peserta_ujian')
                  ->join('jadwal', 'peserta_ujian.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('kelas AS k1','jadwal.id_kelas_1','=','k1.id_kelas')
                  ->join('kelas AS k2','jadwal.id_kelas_2','=','k2.id_kelas')
                  ->join('kelas AS k3','jadwal.id_kelas_3','=','k3.id_kelas')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('jadwal.*','k1.*','k2.*','k3.*','pengajar.*','k1.nama_kelas AS kelas1','k2.nama_kelas AS kelas2','k3.nama_kelas AS kelas3')
                  ->where([['nim',Session::get('nim')],['jenis_sertifikasi','mta'],['tanggal_3','>=',date("Y-m-d")]])->first();

                  $jadwalmos = DB::table('peserta_ujian')
                  ->join('jadwal', 'peserta_ujian.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('kelas AS k1','jadwal.id_kelas_1','=','k1.id_kelas')
                  ->join('kelas AS k2','jadwal.id_kelas_2','=','k2.id_kelas')
                  ->join('kelas AS k3','jadwal.id_kelas_3','=','k3.id_kelas')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('jadwal.*','k1.*','k2.*','k3.*','pengajar.*','k1.nama_kelas AS kelas1','k2.nama_kelas AS kelas2','k3.nama_kelas AS kelas3')
                  ->where([['nim',Session::get('nim')],['jenis_sertifikasi','mos'],['tanggal_3','>=',date("Y-m-d")]])->first();

                  $jadwalscm = DB::table('peserta_ujian')
                  ->join('jadwal', 'peserta_ujian.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('kelas AS k1','jadwal.id_kelas_1','=','k1.id_kelas')
                  ->join('kelas AS k2','jadwal.id_kelas_2','=','k2.id_kelas')
                  ->join('kelas AS k3','jadwal.id_kelas_3','=','k3.id_kelas')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('jadwal.*','k1.*','k2.*','k3.*','pengajar.*','k1.nama_kelas AS kelas1','k2.nama_kelas AS kelas2','k3.nama_kelas AS kelas3')
                  ->where([['nim',Session::get('nim')],['jenis_sertifikasi','scm'],['tanggal_3','>=',date("Y-m-d")]])->first();

                  $jadwalmtcna = DB::table('peserta_ujian')
                  ->join('jadwal', 'peserta_ujian.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('kelas AS k1','jadwal.id_kelas_1','=','k1.id_kelas')
                  ->join('kelas AS k2','jadwal.id_kelas_2','=','k2.id_kelas')
                  ->join('kelas AS k3','jadwal.id_kelas_3','=','k3.id_kelas')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('jadwal.*','k1.*','k2.*','k3.*','pengajar.*','k1.nama_kelas AS kelas1','k2.nama_kelas AS kelas2','k3.nama_kelas AS kelas3')
                  ->where([['nim',Session::get('nim')],['jenis_sertifikasi','mtcna'],['tanggal_3','>=',date("Y-m-d")]])->first();

                  $stringjadwal_mtcna_1='';
                  $stringjadwal_mtcna_2='';
                  $stringjadwal_mtcna_3='';
                  $stringjadwal_mta_1='';
                  $stringjadwal_mta_2='';
                  $stringjadwal_mta_3='';
                  $stringjadwal_mos_1='';
                  $stringjadwal_mos_2='';
                  $stringjadwal_mos_3='';
                  $stringjadwal_scm_1='';
                  $stringjadwal_scm_2='';
                  $stringjadwal_scm_3='';

                  if ($jadwalmta==null) {
                  	$statusmta = DB::table('status_mahasiswa')->where('nim',$nim);
                  	$statusmta = $statusmta->first();
                  	if ($statusmta->status_mta == 'active' || $statusmta->status_mta == 'active-jadwal') {
                  		$sessionmta = 'active';
                  	}else if ($statusmta->status_mta == 'inactive'){
                  		$sessionmta = 'inactive';
                  	}else{
                  		$sessionmta = 'waiting';
                  	}
                  }else{
                  	$sessionmta = $jadwalmta;
                        $stringjadwal_mta_1 = dateDayCreator($jadwalmta->tanggal_1);
                        $stringjadwal_mta_2 = dateDayCreator($jadwalmta->tanggal_2);
                        $stringjadwal_mta_3 = dateDayCreator($jadwalmta->tanggal_3);
                  }

                  if ($jadwalmos==null) {
                  	$statusmos = DB::table('status_mahasiswa')->where('nim',$nim);
                  	$statusmos = $statusmos->first();
                  	if ($statusmos->status_mos == 'active' || $statusmos->status_mos == 'active-jadwal') {
                  		$sessionmos = 'active';
                  	}else if ($statusmos->status_mos == 'inactive'){
                  		$sessionmos = 'inactive';
                  	}else{
                  		$sessionmos = 'waiting';
                  	}
                  }else{
                  	$sessionmos = $jadwalmos;
                  	$stringjadwal_mos_1 = dateDayCreator($jadwalmos->tanggal_1);
                        $stringjadwal_mos_2 = dateDayCreator($jadwalmos->tanggal_2);
                        $stringjadwal_mos_3 = dateDayCreator($jadwalmos->tanggal_3);
                  }

                  if ($jadwalscm==null) {
                  	$statusscm = DB::table('status_mahasiswa')->where('nim',$nim);
                  	$statusscm = $statusscm->first();
                  	if ($statusscm->status_scm == 'active' || $statusscm->status_scm == 'active-jadwal') {
                  		$sessionscm = 'active';
                  	}else if ($statusscm->status_scm == 'inactive'){
                  		$sessionscm = 'inactive';
                  	}else{
                  		$sessionscm = 'waiting';
                  	}
                  }else{
                  	$sessionscm = $jadwalscm;
                  	$stringjadwal_scm_1 = dateDayCreator($jadwalscm->tanggal_1);
                        $stringjadwal_scm_2 = dateDayCreator($jadwalscm->tanggal_2);
                        $stringjadwal_scm_3 = dateDayCreator($jadwalscm->tanggal_3);
                  }

                  if ($jadwalmtcna==null) {
                  	$statusmtcna = DB::table('status_mahasiswa')->where('nim',$nim);
                  	$statusmtcna = $statusmtcna->first();
                  	if ($statusmtcna->status_mtcna == 'active' || $statusmtcna->status_mtcna == 'active-jadwal') {
                  		$sessionmtcna = 'active';
                  	}else if ($statusmtcna->status_mtcna == 'inactive'){
                  		$sessionmtcna = 'inactive';
                  	}else{
                  		$sessionmtcna = 'waiting';
                  	}
                  }else{
                  	$sessionmtcna = $jadwalmtcna;
                  	$stringjadwal_mtcna_1 = dateDayCreator($jadwalmtcna->tanggal_1);
                        $stringjadwal_mtcna_2 = dateDayCreator($jadwalmtcna->tanggal_2);
                        $stringjadwal_mtcna_3 = dateDayCreator($jadwalmtcna->tanggal_3);
                  }

                  $data = array(
			    'jadwalmta'  => $sessionmta,
			    'jadwalmos'   => $sessionmos,
			    'jadwalscm' => $sessionscm,
			    'jadwalmtcna' => $sessionmtcna,
			    'tanggal_mtcna_1' => $stringjadwal_mtcna_1,
			    'tanggal_mtcna_2' => $stringjadwal_mtcna_2,
			    'tanggal_mtcna_3' => $stringjadwal_mtcna_3,
			    'tanggal_mos_1' => $stringjadwal_mos_1,
			    'tanggal_mos_2' => $stringjadwal_mos_2,
			    'tanggal_mos_3' => $stringjadwal_mos_3,
			    'tanggal_mta_1' => $stringjadwal_mta_1,
			    'tanggal_mta_2' => $stringjadwal_mta_2,
			    'tanggal_mta_3' => $stringjadwal_mta_3,
			    'tanggal_scm_1' => $stringjadwal_scm_1,
			    'tanggal_scm_2' => $stringjadwal_scm_2,
			    'tanggal_scm_3' => $stringjadwal_scm_3
			);

			return view('user/jadwal',['data'=>$data]);
		}else{
			return redirect('/');
		}
	}

//menampilkan rekap nilai mahasiswa trtentu
	public function rekapNilai(Request $request){
            date_default_timezone_set("Asia/Jakarta");
		if (Session::has('user')) {
                  $nim = Session::get('nim');
			$datanilaimta = DB::table('nilai')
                  ->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('*','nilai.status AS statusakhir')
                  ->where([['nilai.jenis_sertifikasi','mta'],['nim',$nim]])
                  ->orderBy('pengambilan_ke', 'desc')
                  ->limit(1)
                  ->get();

                  $datanilaimos = DB::table('nilai')
                  ->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('*','nilai.status AS statusakhir')
                  ->where([['nilai.jenis_sertifikasi','mos'],['nim',$nim]])
                  ->orderBy('pengambilan_ke', 'desc')
                  ->limit(1)
                  ->get();

                  $datanilaiscm = DB::table('nilai')
                  ->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('*','nilai.status AS statusakhir')
                  ->where([['nilai.jenis_sertifikasi','scm'],['nim',$nim]])
                  ->orderBy('pengambilan_ke', 'desc')
                  ->limit(1)
                  ->get();

                  $datanilaimtcna = DB::table('nilai')
                  ->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
                  ->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
                  ->select('*','nilai.status AS statusakhir')
                  ->where([['nilai.jenis_sertifikasi','mtcna'],['nim',$nim]])
                  ->orderBy('pengambilan_ke', 'desc')
                  ->limit(1)
                  ->get();

                  $array_nilai = array();
                  if ($datanilaimta!=null) {
                        //dd($datanilaimta);
                        $jadwalmta = $datanilaimta[0]->tanggal_3;
                        
                        $jadwalmta_array = explode("-", $jadwalmta);
                        $jadwalmta_array[1] = monthCreator($jadwalmta_array[1]);
                        $stringjadwal_mta = $jadwalmta_array[2].' '.$jadwalmta_array[1].' '.$jadwalmta_array[0];

                        $datanilaimta[0]->tanggal_3 = $stringjadwal_mta;

                        array_push($array_nilai, $datanilaimta);
                  }

                  if ($datanilaimos!=null) {
                        $jadwalmos = $datanilaimos[0]->tanggal_3;
                        
                        $jadwalmos_array = explode("-", $jadwalmos);
                        $jadwalmos_array[1] = monthCreator($jadwalmos_array[1]);
                        $stringjadwal_mos = $jadwalmos_array[2].' '.$jadwalmos_array[1].' '.$jadwalmos_array[0];

                        $datanilaimos[0]->tanggal_3 = $stringjadwal_mos;

                        array_push($array_nilai, $datanilaimos);
                  }

                  if ($datanilaiscm!=null) {
                        $jadwalscm = $datanilaiscm[0]->tanggal_3;
                        
                        $jadwalscm_array = explode("-", $jadwalscm);
                        $jadwalscm_array[1] = monthCreator($jadwalscm_array[1]);
                        $stringjadwal_scm = $jadwalscm_array[2].' '.$jadwalscm_array[1].' '.$jadwalscm_array[0];

                        $datanilaiscm[0]->tanggal_3 = $stringjadwal_scm;

                        array_push($array_nilai, $datanilaiscm);
                  }

                  if ($datanilaimtcna!=null) {
                        $jadwalmtcna = $datanilaimtcna[0]->tanggal_3;
                        
                        $jadwalmtcna_array = explode("-", $jadwalmtcna);
                        $jadwalmtcna_array[1] = monthCreator($jadwalmtcna_array[1]);
                        $stringjadwal_mtcna = $jadwalmtcna_array[2].' '.$jadwalmtcna_array[1].' '.$jadwalmtcna_array[0];

                        $datanilaimtcna[0]->tanggal_3 = $stringjadwal_mtcna;

                        array_push($array_nilai, $datanilaimtcna);
                  }
			return view('user/rekap_nilai',['data'=>$array_nilai]);
		}else{
			return redirect('/');
		}
	}

//menampilkan registrasi baru mahasiswa
	public function registrasiBaru(){
            date_default_timezone_set("Asia/Jakarta");
		if (Session::has('user')) {
			return view('user/registrasi_baru');
		}else{
			return redirect('/');
		}
	}

//proses change password
	public function prosesChangePassword(Request $request){
            date_default_timezone_set("Asia/Jakarta");
		$password_lama = $request->old_password;
		$password_lama = md5($password_lama);

		$password_baru = $request->new_password;

		$nim = Session::get('nim');
		$data = DB::table('mahasiswa')->where([['password',$password_lama],['nim',$nim]]);
		$count = $data->count();
		if ($count>=1) {
			if (strlen($password_baru)<6) {
				return redirect('/change_password')->with('alert_fail', 'Password baru terlalu pendek. Minimal 6 karakter');
			}
			$password_baru = md5($password_baru);
			
			$saved = Mahasiswa::find($nim);
                  $saved->password = $password_baru;
                  $saved2 = $saved->save();

			if (!$saved) {
				return redirect('/change_password')->with('alert_fail','Password gagal disimpan. silahkan coba lagi');
			}
			return redirect('/change_password')->with('alert_success','Password anda berhasil dirubah!');
		}else{
			return redirect('/change_password')->with('alert_fail','Password lama anda salah!');
		}
	}

//proses cek registrasi ujian baru
      public function prosesCekRegistrasi(Request $request){
            date_default_timezone_set("Asia/Jakarta");
            $nim = Session::get('nim');
            $statusall = DB::table('status_mahasiswa')->where('nim',$nim)->first();
            $status_mta = $statusall->status_mta;
            $status_mos = $statusall->status_mos;
            $status_mtcna = $statusall->status_mtcna;
            $status_scm = $statusall->status_scm;
            $jenis_sertifikasi = $request->jenissertifikasi;
            switch ($jenis_sertifikasi) {
                  case 'MTA':
                        if ($status_mta == 'active' || $status_mta == 'active-jadwal') {
                              return redirect('/registrasi_baru')->with('error','akun MTA anda sudah diaktifkan! anda tidak perlu mendaftar ulang!');
                        }else if ($status_mta == 'inactive') {
                              
                        }else if($status_mta == 'waiting'){
                              return redirect('/registrasi_baru')->with('error','anda sudah melakukan pengajuan sertifikasi. mohon menunggu informasi admin!');
                        }else{
                              return redirect('/registrasi_baru')->with('error','anda sudah lulus pada sertifikasi ini.');
                        }
                        break;
                  
                  case 'MTCNA':
                        if ($status_mtcna == 'active' || $status_mtcna == 'active-jadwal') {
                              return redirect('/registrasi_baru')->with('error','akun MTCNA anda sudah diaktifkan! anda tidak perlu mendaftar ulang!');
                        }else if ($status_mtcna == 'inactive') {
                              
                        }else if($status_mtcna == 'waiting'){
                              return redirect('/registrasi_baru')->with('error','anda sudah melakukan pengajuan sertifikasi. mohon menunggu informasi admin!');
                        }else{
                              return redirect('/registrasi_baru')->with('error','anda sudah lulus pada sertifikasi ini.');
                        }
                        break;

                  case 'MOS':
                        if ($status_mos == 'active' || $status_mos == 'active-jadwal') {
                              return redirect('/registrasi_baru')->with('error','akun MOS anda sudah diaktifkan! anda tidak perlu mendaftar ulang!');
                        }else if ($status_mos == 'inactive') {
                              
                        }else if($status_mos == 'waiting'){
                              return redirect('/registrasi_baru')->with('error','anda sudah melakukan pengajuan sertifikasi. mohon menunggu informasi admin!');
                        }else{
                              return redirect('/registrasi_baru')->with('error','anda sudah lulus pada sertifikasi ini.');
                        }
                        break;

                  case 'SCM':
                        if ($status_scm == 'active' || $status_scm == 'active-jadwal') {
                              return redirect('/registrasi_baru')->with('error','akun SCM anda sudah diaktifkan! anda tidak perlu mendaftar ulang!');
                        }else if ($status_scm == 'inactive') {
                              
                        }else if($status_scm == 'waiting'){
                              return redirect('/registrasi_baru')->with('error','anda sudah melakukan pengajuan sertifikasi. mohon menunggu informasi admin!');
                        }else{
                              return redirect('/registrasi_baru')->with('error','anda sudah lulus pada sertifikasi ini.');
                        }
                        break;
            }

            $bukti = $request->file('bukti');
            
            $file_parts = pathinfo($bukti->getClientOriginalName());

            if ($request->file('bukti')->getClientSize() == 0) {
                  return redirect('/registrasi_baru')->with('error','Ukuran file maksimum adalah 2048 Kb');
            }

            switch($file_parts['extension'])
            {
                case "jpg":

                break;

                case "png":

                break;

                case "jpeg":

                break;

                default:
                  return redirect('/registrasi_baru')->with('error','file harus berupa file gambar ! (.jpg atau .png) dan tidak melebihi 2Mb');
                break;
            }

            $nama = Session::get('user');
            $nim = Session::get('nim');
            $database = DB::table('data_pengambilan')->where('nim',$nim)->first();

            if ($database!=null) {
                  switch ($jenis_sertifikasi) {
                        case 'MTA':
                              $pengambilan = $database->mta + 1;
                              $jenissert = 'mta';
                              break;
                        
                        case 'MTCNA':
                              $pengambilan = $database->mtcna + 1;
                              $jenissert = 'mtcna';
                              break;

                        case 'MOS':
                              $pengambilan = $database->mos + 1;
                              $jenissert = 'mos';
                              break;

                        case 'SCM':
                              $pengambilan = $database->scm + 1;
                              $jenissert = 'scm';
                              break;
                        default:
                              $pengambilan = 'error';
                              break;
                  }
            }else{
                  echo "error";
            }

            $destinationPath = public_path().'/data/bukti';
            $namagambar = 'BUKTI_'.$nim.'_'.$jenis_sertifikasi.'_'.$pengambilan.'.'.$file_parts['extension'];
            $request->file('bukti')->move($destinationPath,$namagambar);


            $bukti = new Bukti();
            $bukti->nim = Session::get('nim');
            $bukti->bukti = $namagambar;
            $bukti->jenis_sertifikasi = $jenissert;
            $bukti->pengambilan_ke = $pengambilan;
            $bukti->status = 'unchecked';

            $bukti->save();

            switch ($jenissert) {
                  case 'mta':
                        $update_data_pengambilan = DB::table('data_pengambilan')
                        ->where('nim',$nim)
                        ->increment('mta');
                        
                        $update_status = DB::table('status_mahasiswa')
                        ->where('nim',$nim)
                        ->update(['status_mta' => 'waiting']);

                        break;
                  case 'mtcna':
                        $update_data_pengambilan = DB::table('data_pengambilan')
                        ->where('nim',$nim)
                        ->increment('mtcna');
                        
                        $update_status = DB::table('status_mahasiswa')
                        ->where('nim',$nim)
                        ->update(['status_mtcna' => 'waiting']);
                        break;
                  case 'mos':
                        $update_data_pengambilan = DB::table('data_pengambilan')
                        ->where('nim',$nim)
                        ->increment('mos');
                        
                        $update_status = DB::table('status_mahasiswa')
                        ->where('nim',$nim)
                        ->update(['status_mos' => 'waiting']);
                        break;
                  case 'scm':
                        $update_data_pengambilan = DB::table('data_pengambilan')
                        ->where('nim',$nim)
                        ->increment('scm');
                        
                        $update_status = DB::table('status_mahasiswa')
                        ->where('nim',$nim)
                        ->update(['status_scm' => 'waiting']);
                        break;
            }

            return redirect('/registrasi_baru')->with('success','Permintaan anda telah dikirimkan dan akan diproses secepatnya');
      }
}