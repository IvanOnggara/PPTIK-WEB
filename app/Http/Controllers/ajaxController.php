<?php

namespace App\Http\Controllers;

use Request;
use App\Jadwal;
use App\Mahasiswa;
use App\PesertaUjian;
use App\StatusMahasiswa;
use App\Bukti;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ajaxController extends Controller
{
	//update diagram batang di halaaman admin saat dilakukan perubahan pada dropbox
    public function updateGraph(){
		if (Request::ajax()) {
			$q = $_REQUEST["q"];
			$p = $_REQUEST["p"];
			$s = $_REQUEST["s"];

			switch ($p) {
				case 'TIF':
					$id = '31%';
					break;
				case 'SI':
					$id = '32%';
					break;
				case 'MAN':
					$id = '11%';
					break;
				case 'AKUN':
					$id = '12%';
					break;
				case 'PBM':
					$id = '22%';
					break;
				case 'ING':
					$id = '21%';
					break;
				case 'KIM':
					$id = '51%';
					break;
				case 'FAR':
					$id = '61%';
					break;
				case 'TI':
					$id = '41%';
					break;
				case 'DKV':
					$id = '33%';
					break;
				
				case 'ALL':
					$id = '%';
					break;
			}

			$datalulusmta = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namalulusmta = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();
			
			$datatidaklulusmta = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namatidaklulusmta = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();

			$datalulusmos = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namalulusmos = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();
			
			$datatidaklulusmos = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namatidaklulusmos = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();

			$datalulusmtcna = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namalulusmtcna = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();
			
			$datatidaklulusmtcna = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namatidaklulusmtcna = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();

			$datalulusscm = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namalulusscm = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();
			
			$datatidaklulusscm = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->count();

			$namatidaklulusscm = DB::table('nilai')
			->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
			->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
			->get();

			$alldata = array(
				'mtalulus' => $datalulusmta,
				'mtatidaklulus' => $datatidaklulusmta,
				'mtcnalulus' => $datalulusmtcna,
				'mtcnatidaklulus' => $datatidaklulusmtcna,
				'moslulus' => $datalulusmos,
				'mostidaklulus' => $datatidaklulusmos,
				'scmlulus' => $datalulusscm,
				'scmtidaklulus' => $datatidaklulusscm,
				'namamtalulus' => $namalulusmta,
				'namamtatidaklulus' => $namatidaklulusmta,
				'namamtcnalulus' => $namalulusmtcna,
				'namamtcnatidaklulus' => $namatidaklulusmtcna,
				'namamoslulus' => $namalulusmos,
				'namamostidaklulus' => $namatidaklulusmos,
				'namascmlulus' => $namalulusscm,
				'namascmtidaklulus' => $namatidaklulusscm,
			);

			return $alldata;
		}
		
	}

//menampilkan chart MTA di halaaman admin
	public function mtashow(){
		if (Request::ajax()) {
			$q = $_REQUEST["q"];
			$s = $_REQUEST["s"];
			$if = '31%';
			$si = '32%';
			$kim = '51%';
			$far = '61%';
			$man = '11%';
			$akun = '12%';
			$dkv = '33%';
			$ti = '41%';
			$mandarin = '22%';
			$sasing = '21%';
			$j = 'mta';

			$pendaftarmtaif = databaseShowHomeAdmin($q,$if,$s,$j);

			$pendaftarmtasi = databaseShowHomeAdmin($q,$si,$s,$j);

			$pendaftarmtakim = databaseShowHomeAdmin($q,$kim,$s,$j);

			$pendaftarmtafar = databaseShowHomeAdmin($q,$far,$s,$j);

			$pendaftarmtaman = databaseShowHomeAdmin($q,$man,$s,$j);

			$pendaftarmtaakun = databaseShowHomeAdmin($q,$akun,$s,$j);

			$pendaftarmtadkv = databaseShowHomeAdmin($q,$dkv,$s,$j);

			$pendaftarmtati = databaseShowHomeAdmin($q,$ti,$s,$j);

			$pendaftarmtamandarin = databaseShowHomeAdmin($q,$mandarin,$s,$j);

			$pendaftarmtasasing = databaseShowHomeAdmin($q,$sasing,$s,$j);

			$arraymta = array(
				'if'=> $pendaftarmtaif,
				'si'=> $pendaftarmtasi,
				'kim'=> $pendaftarmtakim,
				'far'=> $pendaftarmtafar,
				'man'=> $pendaftarmtaman,
				'akun'=> $pendaftarmtaakun,
				'dkv'=> $pendaftarmtadkv,
				'ti'=> $pendaftarmtati,
				'mandarin'=> $pendaftarmtamandarin,
				'sasing'=> $pendaftarmtasasing
			);

			return $arraymta;
		}
	}

//menampilkan chart MOS di halaaman admin
	public function mosshow(){
		if (Request::ajax()) {
			$q = $_REQUEST["q"];
			$s = $_REQUEST["s"];

			$if = '31%';
			$si = '32%';
			$kim = '51%';
			$far = '61%';
			$man = '11%';
			$akun = '12%';
			$dkv = '33%';
			$ti = '41%';
			$mandarin = '22%';
			$sasing = '21%';
			$j = 'mos';

			$pendaftarmosif = databaseShowHomeAdmin($q,$if,$s,$j);

			$pendaftarmossi = databaseShowHomeAdmin($q,$si,$s,$j);
			
			$pendaftarmoskim = databaseShowHomeAdmin($q,$kim,$s,$j);

			$pendaftarmosfar = databaseShowHomeAdmin($q,$far,$s,$j);

			$pendaftarmosman = databaseShowHomeAdmin($q,$man,$s,$j);

			$pendaftarmosakun = databaseShowHomeAdmin($q,$akun,$s,$j);

			$pendaftarmosdkv = databaseShowHomeAdmin($q,$dkv,$s,$j);

			$pendaftarmosti = databaseShowHomeAdmin($q,$ti,$s,$j);

			$pendaftarmosmandarin = databaseShowHomeAdmin($q,$mandarin,$s,$j);

			$pendaftarmossasing = databaseShowHomeAdmin($q,$sasing,$s,$j);

			$arraymos = array(
				'if'=> $pendaftarmosif,
				'si'=> $pendaftarmossi,
				'kim'=> $pendaftarmoskim,
				'far'=> $pendaftarmosfar,
				'man'=> $pendaftarmosman,
				'akun'=> $pendaftarmosakun,
				'dkv'=> $pendaftarmosdkv,
				'ti'=> $pendaftarmosti,
				'mandarin'=> $pendaftarmosmandarin,
				'sasing'=> $pendaftarmossasing
			);

			return $arraymos;
		}
	}

//menampilkan chart SCM di halaaman admin
	public function scmshow(){
		if (Request::ajax()) {
			$q = $_REQUEST["q"];
			$s = $_REQUEST["s"];

			$if = '31%';
			$si = '32%';
			$kim = '51%';
			$far = '61%';
			$man = '11%';
			$akun = '12%';
			$dkv = '33%';
			$ti = '41%';
			$mandarin = '22%';
			$sasing = '21%';
			$j = 'scm';

			$pendaftarscmif = databaseShowHomeAdmin($q,$if,$s,$j);

			$pendaftarscmsi = databaseShowHomeAdmin($q,$si,$s,$j);
			
			$pendaftarscmkim = databaseShowHomeAdmin($q,$kim,$s,$j);

			$pendaftarscmfar = databaseShowHomeAdmin($q,$far,$s,$j);

			$pendaftarscmman = databaseShowHomeAdmin($q,$man,$s,$j);

			$pendaftarscmakun = databaseShowHomeAdmin($q,$akun,$s,$j);

			$pendaftarscmdkv = databaseShowHomeAdmin($q,$dkv,$s,$j);

			$pendaftarscmti = databaseShowHomeAdmin($q,$ti,$s,$j);

			$pendaftarscmmandarin = databaseShowHomeAdmin($q,$mandarin,$s,$j);

			$pendaftarscmsasing = databaseShowHomeAdmin($q,$sasing,$s,$j);

			$arrayscm = array(
				'if'=> $pendaftarscmif,
				'si'=> $pendaftarscmsi,
				'kim'=> $pendaftarscmkim,
				'far'=> $pendaftarscmfar,
				'man'=> $pendaftarscmman,
				'akun'=> $pendaftarscmakun,
				'dkv'=> $pendaftarscmdkv,
				'ti'=> $pendaftarscmti,
				'mandarin'=> $pendaftarscmmandarin,
				'sasing'=> $pendaftarscmsasing
			);

			return $arrayscm;
		}
	}

//menampilkan chart MTCNA di halaaman admin
	public function mtcnashow(){
		if (Request::ajax()) {
			$q = $_REQUEST["q"];
			$s = $_REQUEST["s"];

			$if = '31%';
			$si = '32%';
			$kim = '51%';
			$far = '61%';
			$man = '11%';
			$akun = '12%';
			$dkv = '33%';
			$ti = '41%';
			$mandarin = '22%';
			$sasing = '21%';
			$j = 'mtcna';

			$pendaftarmtcnaif = databaseShowHomeAdmin($q,$if,$s,$j);

			$pendaftarmtcnasi = databaseShowHomeAdmin($q,$si,$s,$j);
			
			$pendaftarmtcnakim = databaseShowHomeAdmin($q,$kim,$s,$j);

			$pendaftarmtcnafar = databaseShowHomeAdmin($q,$far,$s,$j);

			$pendaftarmtcnaman = databaseShowHomeAdmin($q,$man,$s,$j);

			$pendaftarmtcnaakun = databaseShowHomeAdmin($q,$akun,$s,$j);

			$pendaftarmtcnadkv = databaseShowHomeAdmin($q,$dkv,$s,$j);

			$pendaftarmtcnati = databaseShowHomeAdmin($q,$ti,$s,$j);

			$pendaftarmtcnamandarin = databaseShowHomeAdmin($q,$mandarin,$s,$j);

			$pendaftarmtcnasasing = databaseShowHomeAdmin($q,$sasing,$s,$j);

			$arraymtcna = array(
				'if'=> $pendaftarmtcnaif,
				'si'=> $pendaftarmtcnasi,
				'kim'=> $pendaftarmtcnakim,
				'far'=> $pendaftarmtcnafar,
				'man'=> $pendaftarmtcnaman,
				'akun'=> $pendaftarmtcnaakun,
				'dkv'=> $pendaftarmtcnadkv,
				'ti'=> $pendaftarmtcnati,
				'mandarin'=> $pendaftarmtcnamandarin,
				'sasing'=> $pendaftarmtcnasasing
			);

			return $arraymtcna;
		}
	}
}
