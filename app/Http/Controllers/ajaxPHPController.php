<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Request;
use App\Jadwal;
use App\Mahasiswa;
use App\PesertaUjian;
use App\StatusMahasiswa;
use App\Bukti;
use App\Kelas;
use App\Nilai;
use App\Admin;
use App\Pengajar;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ajaxPHPController extends Controller
{
	//mendapatkan daftar peserta di piechart halaaman admin
	public function getListPesertaPieChart(){
		date_default_timezone_set("Asia/Jakarta");
		$periode = $_REQUEST["periode"];
		$semester = $_REQUEST["semester"];
		$jenis = $_REQUEST["jenis"];

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

		$pendaftarif = databaseListPesertaPieChart($periode,$if,$semester,$jenis);
		$pendaftarif = json_encode($pendaftarif);

		$pendaftarsi = databaseListPesertaPieChart($periode,$si,$semester,$jenis);
		$pendaftarsi = json_encode($pendaftarsi);
		
		$pendaftarkim = databaseListPesertaPieChart($periode,$kim,$semester,$jenis);
		$pendaftarkim = json_encode($pendaftarkim);

		$pendaftarfar = databaseListPesertaPieChart($periode,$far,$semester,$jenis);
		$pendaftarfar = json_encode($pendaftarfar);

		$pendaftarman = databaseListPesertaPieChart($periode,$man,$semester,$jenis);
		$pendaftarman = json_encode($pendaftarman);

		$pendaftarakun = databaseListPesertaPieChart($periode,$akun,$semester,$jenis);
		$pendaftarakun = json_encode($pendaftarakun);

		$pendaftardkv = databaseListPesertaPieChart($periode,$dkv,$semester,$jenis);
		$pendaftardkv = json_encode($pendaftardkv);

		$pendaftarti = databaseListPesertaPieChart($periode,$ti,$semester,$jenis);
		$pendaftarti = json_encode($pendaftarti);

		$pendaftarmandarin = databaseListPesertaPieChart($periode,$mandarin,$semester,$jenis);
		$pendaftarmandarin = json_encode($pendaftarmandarin);

		$pendaftarsasing = databaseListPesertaPieChart($periode,$sasing,$semester,$jenis);
		$pendaftarsasing = json_encode($pendaftarsasing);

		$alldata = array(
			'pendaftarif' => $pendaftarif,
			'pendaftarsi' => $pendaftarsi,
			'pendaftarkim' => $pendaftarkim,
			'pendaftarfar' => $pendaftarfar,
			'pendaftarman' => $pendaftarman,
			'pendaftarakun' => $pendaftarakun,
			'pendaftardkv' => $pendaftardkv,
			'pendaftarti' => $pendaftarti,
			'pendaftarmandarin' => $pendaftarmandarin,
			'pendaftarsasing' => $pendaftarsasing
		);

		return $alldata;
	}

//mengirim data peserta pada diagram batang home admin
	public function downloadGraphData(){
		date_default_timezone_set("Asia/Jakarta");
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

		$namalulusmta = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();
		
		$namatidaklulusmta = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mta'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namalulusmos = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namatidaklulusmos = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mos'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namalulusmtcna = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namatidaklulusmtcna = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','mtcna'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namalulusscm = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		$namatidaklulusscm = DB::table('nilai')
		->join('jadwal', 'nilai.id_jadwal', '=', 'jadwal.id_jadwal')
		->join('mahasiswa', 'mahasiswa.nim', '=', 'nilai.nim')
		->where([['jadwal.periode',$q],['nilai.status','tidak lulus'],['nilai.jenis_sertifikasi','scm'],['nilai.nim','like',$id],['jadwal.semester',$s],['nilai.nilai','!=',-1]])
		->get();

		///
		$namalulusmta = json_encode($namalulusmta);
		$namatidaklulusmta = json_encode($namatidaklulusmta);

		$namalulusmos = json_encode($namalulusmos);
		$namatidaklulusmos = json_encode($namatidaklulusmos);

		$namalulusmtcna = json_encode($namalulusmtcna);
		$namatidaklulusmtcna = json_encode($namatidaklulusmtcna);

		$namalulusscm = json_encode($namalulusscm);
		$namatidaklulusscm = json_encode($namatidaklulusscm);

		
		$alldata = array(
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

//menampilkan list sertifikat di halaman sertifikat
    public function proses(){
    	date_default_timezone_set("Asia/Jakarta");
   		$ka = $_REQUEST["k"];
   		$k = $ka.'%';

		$print = "";

		if ($ka !== "") {
			$object = DB::table('data_sertifikat')
			->join('mahasiswa','mahasiswa.nim','=','data_sertifikat.nim')
			->where('id_sertifikat','LIKE',$k);

			$data = $object->get();
			$datacount = $object->count();

			if ($print == '') {
			 	$print = '<table class="table" style="color: white;font-size: 1.5em;"><thead><tr><th>Kode</th><th>Nama</th><th>NIM</th><th>Jenis Sertifikasi</th></tr></thead><tbody>';

			}
				foreach ($data as $each) {
					$print = $print.'<tr><td>'.$each->id_sertifikat.'</td><td>'.$each->nama.'</td><td>'.$each->nim.'</td><td>'.strtoupper($each->jenis_sertifikasi).'</td></tr>';
				}
				$print = $print.'</tbody></table>';
			

			if ($datacount<=0) {
				$print = '';
			}
		}

		// Output "no suggestion" if no hint was found or output correct values 
		echo $print === "" ? "<h1 class='text-center' style='color:white;'>Kode Tidak Ditemukan</h1>" : $print;
    }

//fungsi menampilkan trainer yang aktif untuk jadwal tertentu
    public function showtrainer(){
    	date_default_timezone_set("Asia/Jakarta");
    	$ka = $_REQUEST["q"];

		$print = "";

		if ($ka !== "") {
			$object = DB::table('pengajar')
			->where([[$ka,1],['status','active']]);

			$data = $object->get();
			$datacount = $object->count();

			foreach ($data as $each) {
				$print = $print.'<option value="'.$each->nip.'" selected="">'.$each->nama.'</option>';
			}
			

			if ($datacount<=0) {
				$print = '<option value="" disabled="" selected="">No Data</option>';
			}
		}

		// Output "no suggestion" if no hint was found or output correct values 
		echo $print;
    }

//menampilkan tanggal yang ada pada halaman edit nilai
    public function showTanggal(){
    	date_default_timezone_set("Asia/Jakarta");
    	$jenis = $_REQUEST["j"];
    	$periode = $_REQUEST["p"];
    	$semester = $_REQUEST["s"];

		$print = "<option value='' disabled selected>Choose Option</option>";

		if ($jenis !== "" && $periode !== "" && $semester !== "") {
			$object = DB::table('jadwal')
			->where([['jenis_sertifikasi',$jenis],['periode',$periode],['semester',$semester]]);

			$data = $object->get();
			$datacount = $object->count();

			foreach ($data as $each) {
				$print = $print.'<option value="'.$each->tanggal_3.'">'.dateCreator($each->tanggal_3).'</option>';
			}
			

			if ($datacount<=0) {
				$print = '<option value="" disabled="" selected="">No Data</option>';
			}
		}

		// Output "no suggestion" if no hint was found or output correct values 
		echo $print;
    }

//menampilkan peserta pada halaman edit nilai
    public function showListPeserta(){
    	date_default_timezone_set("Asia/Jakarta");
    	$jenis = $_REQUEST["j"];
    	$periode = $_REQUEST["p"];
    	$semester = $_REQUEST["s"];
    	$tanggal = $_REQUEST["t"];

		$print = '<table id="mydata" class="table table-striped table-bordered"><thead><tr><th>Nama</th><th>NIM</th><th>Nilai</th></tr></thead><tbody>';

		if ($jenis !== "" && $periode !== "" && $semester !== "" && $tanggal !== "") {
			$object = DB::table('peserta_ujian')
			->join('jadwal','jadwal.id_jadwal','=','peserta_ujian.id_jadwal')
			->join('mahasiswa','mahasiswa.nim','=','peserta_ujian.nim')
			->where([['jenis_sertifikasi',$jenis],['periode',$periode],['semester',$semester],['tanggal_3',$tanggal]]);


			$data = $object->get();
			$datacount = $object->count();


			foreach ($data as $each) {
				$objectnilai = DB::table('nilai')
				->where([['nim',$each->nim],['id_jadwal',$object->first()->id_jadwal]])->first();

				$print = $print.'<tr><td>'.$each->nama.'</td><td>'.$each->nim.'</td><td><input type="number" step="0.01" min="-1" max="100" name="'.$each->nim.'" style="width: 70px;" required value="'.$objectnilai->nilai.'"></td></tr>';
			}
			if ($datacount>0) {
				$print = $print.'</tbody></table><input id="idjadwal" type="hidden" name="idjadwal" value="'.$object->first()->id_jadwal.'">';
			}
			

			if ($datacount<=0) {
				$print = 'No Data';
			}
		}

		// Output "no suggestion" if no hint was found or output correct values 
		echo $print;
    }

//menyimpan nama baru saat edit mahasiswa
    public function savename(){
    	date_default_timezone_set("Asia/Jakarta");
    	$nim = $_REQUEST['nim'];
    	$namabaru = $_REQUEST['nama'];

    	$update = Mahasiswa::where('nim',$nim)
    	->update(['nama' => $namabaru]);
    	if ($update) {
    		return 'Nama Berhasil diubah. tekan F5 untuk merefresh data';
    	}
    }

//update password baru dari mahasiswa
    public function setpassword(){
    	date_default_timezone_set("Asia/Jakarta");
    	$nim = $_REQUEST['nim'];

    	$password = generatePassword();
    	$passwordmd5 = md5($password);

    	$update = Mahasiswa::where('nim',$nim)
    	->update(['password' => $passwordmd5]);
    	if ($update) {
    	
    	return $password;
    	}
    }

//update password baru dari admin
    public function setPasswordAdmin(){
    	date_default_timezone_set("Asia/Jakarta");
    	$admin_id = $_REQUEST['id'];

    	$password = generatePassword();
    	$passwordmd5 = md5($password);

    	$update = Admin::find($admin_id);
    	$update->password = $passwordmd5;
    	$saved = $update->save();

    	if ($saved) {
    		return $password;
    	}
    }

//mendapat rincian jadwal
    public function getRincianJadwal(){
    	date_default_timezone_set("Asia/Jakarta");
    	$id = $_REQUEST['id'];
    	
    	$data = DB::table('jadwal')
    	->where('id_jadwal',$id)
    	->first();

    	$peserta = DB::table('peserta_ujian')
    	->join('mahasiswa','mahasiswa.nim','=','peserta_ujian.nim')
    	->where('id_jadwal',$id)
    	->get();

    	$printed = '<h3><span class="fa fa-calendar-check-o"></span> Jadwal</h3><table class="table table-striped table-bordered"><thead><tr><th>Hari, Tanggal</th><th>Jam Mulai</th><th>Jam Akhir</th></tr></thead><tbody><tr><td>'.dateDayCreator($data->tanggal_1).'</td><td>'.$data->jam_awal_1.'</td><td>'.$data->jam_akhir_1.'</td></tr><tr><td>'.dateDayCreator($data->tanggal_2).'</td><td>'.$data->jam_awal_2.'</td><td>'.$data->jam_akhir_2.'</td></tr><tr><td>'.dateDayCreator($data->tanggal_3).'</td><td>'.$data->jam_awal_3.'</td><td>'.$data->jam_akhir_3.'</td></tr></tbody></table><h3><span class="fa fa-users"></span> Daftar Peserta</h3><table class="table table-striped table-bordered"><thead><tr><th>NIM</th><th>Nama</th></tr></thead><tbody>';

		foreach ($peserta as $perpeserta) {
			$printed = $printed.'<tr><td>'.$perpeserta->nim.'</td><td>'.$perpeserta->nama.'</td></tr>';
		}
		
		$printed = $printed.'</tbody></table>';

		return $printed;
    }

//fungsi menampilkan tab edit jadwal
    public function editJadwal(){
    	date_default_timezone_set("Asia/Jakarta");
    	$id = $_REQUEST['id'];

    	$data = DB::table('jadwal')
    	->where('id_jadwal',$id)
    	->first();

    	$alldosen = DB::table('pengajar')
    	->where($data->jenis_sertifikasi,1)
    	->where('status','active')
    	->get();

    	$allkelas = DB::table('kelas')
    	->where('status','active')
    	->get();

    	$printed = '<input type="hidden" id="ideditjadwal" value="'.$data->id_jadwal.'"><div class="row"><div class="col-md-4"><h5 style="font-weight: bold;">ID : '.$data->id_jadwal.'</h5><h5 style="font-weight: bold;">Jenis Sertifikasi : '.strtoupper($data->jenis_sertifikasi).'</h5></div><div class="col-md-offset-4 col-md-4"><label>Trainer : </label><select class="form-control" required="" name="trainer" id="newtrainer">';

		foreach ($alldosen as $dosen) {
			if ($dosen->nip == $data->id_dosen) {
				$printed = $printed.'<option value="'.$dosen->nip.'" selected>'.$dosen->nama.'</option>';
			}else{
				$printed = $printed.'<option value="'.$dosen->nip.'">'.$dosen->nama.'</option>';
			}
		}

		$printed = $printed.'</select></div></div><br><p class="text-center bg-green " style="font-weight: bold">Hari ke-1</p><div class="row"><div class="col-md-4 col-md-offset-2"><label>Kelas : </label><select class="form-control" required="" id="kelas1">';

		foreach ($allkelas as $kelas1) {
			if ($kelas1->id_kelas == $data->id_kelas_1) {
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'" selected>'.$kelas1->nama_kelas.'</option>';
			}else{
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'">'.$kelas1->nama_kelas.'</option>';
			}
		}

		$printed = $printed.'</select></div><div class="col-md-4 col-md-offset"><label>Tanggal : </label><div class="form-group"><div class="input-group date" id="tanggaledit1"><input id="tanggal1" type="text" class="form-control" required="" value="'.$data->tanggal_1.'"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div></div><div class="row"><div class="col-md-4 col-md-offset-2"><label>Jam Mulai : </label><div class="form-group"><div class="input-group date" id="jamawal1"><input id="jamaw1" type="text" class="form-control" required="" value="'.$data->jam_awal_1.'"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div><div class="col-md-4"><label>Jam Akhir : </label><div class="form-group"><div class="input-group date" id="jamakhir1"><input id="jamak1" type="text" class="form-control" required="" value="'.$data->jam_akhir_1.'"/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div></div><br><p class="red bold text-center" id="pesanhari1"></p><br><p class="text-center bg-green" style="font-weight: bold;" >Hari ke-2</p><div class="row"><div class="col-md-4 col-md-offset-2"><label>Kelas : </label><select class="form-control" required="" id="kelas2">';
		
		foreach ($allkelas as $kelas1) {
			if ($kelas1->id_kelas == $data->id_kelas_2) {
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'" selected>'.$kelas1->nama_kelas.'</option>';
			}else{
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'">'.$kelas1->nama_kelas.'</option>';
			}
		}
		                        

        $printed = $printed.'</select>
		</div>
		<div class="col-md-4 col-md-offset">
		<label>Tanggal : </label>
			<div class="form-group">
                <div class="input-group date" id="tanggaledit2">
                    <input id="tanggal2" type="text" class="form-control" required="" value="'.$data->tanggal_2.'"/>
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
		<label>Jam Mulai : </label>
			<div class="form-group">
                <div class="input-group date" id="jamawal2">
                    <input id="jamaw2" type="text" class="form-control" required="" value="'.$data->jam_awal_2.'"/>
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
		</div>
		<div class="col-md-4">
		<label>Jam Akhir : </label>
			<div class="form-group">
                <div class="input-group date" id="jamakhir2">
                    <input id="jamak2" type="text" class="form-control" required="" value="'.$data->jam_akhir_2.'"/>
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
		</div>
	</div><br><p class="red bold text-center" id="pesanhari2"></p><br>

	<p class="text-center bg-green " style="font-weight: bold">Hari ke-3</p>
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
		<label>Kelas : </label>
			<select class="form-control" required="" id="kelas3">';
		foreach ($allkelas as $kelas1) {
			if ($kelas1->id_kelas == $data->id_kelas_3) {
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'" selected>'.$kelas1->nama_kelas.'</option>';
			}else{
				$printed = $printed.'<option value="'.$kelas1->id_kelas.'">'.$kelas1->nama_kelas.'</option>';
			}
		}
		                        $printed = $printed.'</select>
			        		</div>
			        		<div class="col-md-4 col-md-offset">
			        		<label>Tanggal : </label>
			        			<div class="form-group">
			                        <div class="input-group date" id="tanggaledit3">
			                            <input id="tanggal3" type="text" class="form-control" required="" value="'.$data->tanggal_3.'"/>
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col-md-4 col-md-offset-2">
			        		<label>Jam Mulai : </label>
			        			<div class="form-group">
			                        <div class="input-group date" id="jamawal3">
			                            <input id="jamaw3" type="text" class="form-control" required="" value="'.$data->jam_awal_3.'"/>
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			        		</div>
			        		<div class="col-md-4">
			        		<label>Jam Akhir : </label>
			        			<div class="form-group">
			                        <div class="input-group date" id="jamakhir3">
			                            <input id="jamak3" type="text" class="form-control" required="" value="'.$data->jam_akhir_3.'"/>
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			        		</div>
			        	</div><br><p class="red bold text-center" id="pesanhari3"></p>';
			        	return $printed;
    }

//fungsi update jadwal
    public function updateJadwal(){
    	date_default_timezone_set("Asia/Jakarta");
    	$tanggal1 = $_REQUEST['tanggal1'];
    	$jamawal1 = $_REQUEST['jamawal1'];
    	$jamakhir1 = $_REQUEST['jamakhir1'];

    	$tanggal2 = $_REQUEST['tanggal2'];
    	$jamawal2 = $_REQUEST['jamawal2'];
    	$jamakhir2 = $_REQUEST['jamakhir2'];

    	$tanggal3 = $_REQUEST['tanggal3'];
    	$jamawal3 = $_REQUEST['jamawal3'];
    	$jamakhir3 = $_REQUEST['jamakhir3'];

    	$kelas1 = $_REQUEST['kelas1'];
    	$kelas2 = $_REQUEST['kelas2'];
    	$kelas3 = $_REQUEST['kelas3'];

    	$trainer = $_REQUEST['trainer'];

    	$id = $_REQUEST['id'];

    	$save = Jadwal::find($id);
    	$save->id_dosen = $trainer;
    	$save->id_kelas_1 = $kelas1;
    	$save->id_kelas_2 = $kelas2;
    	$save->id_kelas_3 = $kelas3;
    	$save->tanggal_1 = $tanggal1;
    	$save->tanggal_2 = $tanggal2;
    	$save->tanggal_3 = $tanggal3;
    	$save->jam_awal_1 = $jamawal1;
    	$save->jam_akhir_1 = $jamakhir1;
    	$save->jam_awal_2 = $jamawal2;
    	$save->jam_akhir_2 = $jamakhir2;
    	$save->jam_awal_3 = $jamawal3;
    	$save->jam_akhir_3 = $jamakhir3;
    	$result = $save->save();
		if ($result) {
			return 'success';
		}
    	
    }

//mendapat rincian peserta ujian
    public function getRincianPeserta(){
    	date_default_timezone_set("Asia/Jakarta");
    	$id = $_REQUEST['id'];

    	$jadwal = DB::table('jadwal')
    	->where('id_jadwal',$id)
    	->first();

    	$pesertaujian = DB::table('peserta_ujian')
    	->join('mahasiswa','mahasiswa.nim','=','peserta_ujian.nim')
    	->where('id_jadwal',$id)
    	->get();

    	$notpeserta = DB::table('status_mahasiswa')
    	->join('mahasiswa','status_mahasiswa.nim','=','mahasiswa.nim')
    	->where('status_'.$jadwal->jenis_sertifikasi,'active')
    	->get();

    	$printed = '<h5 class="bold">ID : '.$jadwal->id_jadwal.'</h5>
    	<input type="hidden" id="idjadwal" value="'.$jadwal->id_jadwal.'">
			        		<h5 class="bold">Jenis Sertifikasi : '.strtoupper($jadwal->jenis_sertifikasi).'</h5>
			        		<div class="row">
			        			<div class="col-md-6 col-sm-12">
			        			<h4 class="bg-orange text-center bold">List Peserta</h4>

			        				<table class="table table-striped table-bordered bold">
				                        <thead>
				                          <tr class="headings">
				                            <th class="column-title">NIM </th>
				                            <th class="column-title">Nama </th>
				                            <th>Action</th>
				                          </tr>
				                        </thead>

				                        <tbody>';
		foreach ($pesertaujian as $perpeserta) {
			$printed = $printed.'<tr class=" pointer">
				                            <td class=" ">'.$perpeserta->nim.'</td>
				                            <td class=" ">'.$perpeserta->nama.'</td>
				                            <td><button class="btn btn-sm btn-app " data-toggle="tooltip" data-placement="top" title="Delete" onclick="deletepeserta('.$perpeserta->nim.')"><span class="fa fa-user-times"></span></button></td>
				                          </tr>';
		}

		$printed = $printed.'</tbody>
				                      </table>
			        			</div>
			        			<div class="col-md-6 col-sm-12">
			        			<h4 class="bg-orange text-center bold">Peserta yang belum mendapat Jadwal</h4>
			        				<label>Search :</label>
			        				<input type="text" name="" id="searchform"><br>
			        				<table class="table table-striped table-bordered bold" id="datatablepeserta">
				                        <thead>
				                          <tr class="headings">
				                            
				                            <th class="column-title">NIM </th>
				                            <th class="column-title">Nama </th>
				                            <th>Action</th>
				                          </tr>
				                        </thead>

				                        <tbody>';
		foreach ($notpeserta as $pernotpeserta) {
			$printed = $printed.'<tr class="even pointer">
				                            <td class=" ">'.$pernotpeserta->nim.'</td>
				                            <td class=" ">'.$pernotpeserta->nama.'</td>
				                            <td><button class="btn btn-sm btn-app" data-toggle="tooltip" data-placement="top" title="Add" onclick="addpeserta('.$pernotpeserta->nim.')"><span class="fa fa-user-plus"></span></button></td>
				                          </tr>';
		}
		
		$printed = $printed.'</tbody>
				                      </table>
			        			</div>
			        		</div>';

		return $printed;
    }

//menambah peserta dalam jadwal tertentu
    public function addPesertaJadwal(){
    	date_default_timezone_set("Asia/Jakarta");
    	$idjadwal = $_REQUEST['id'];
    	$nim = $_REQUEST['nim'];

    	$jadwal = DB::table('jadwal')
    	->where('id_jadwal',$idjadwal)
    	->first();

    	$jenis_sertifikasi = "status_".$jadwal->jenis_sertifikasi;
    	$jeniss = $jadwal->jenis_sertifikasi;

    	$data = StatusMahasiswa::find($nim);
    	$data->$jenis_sertifikasi = 'active-jadwal';
    	$saved = $data->save();

    	$data_pengambilan = DB::table('data_pengambilan')
    	->where('nim',$nim)
    	->first();

    	$newPeserta = new PesertaUjian();
    	$newPeserta->nim = $nim;
    	$newPeserta->id_jadwal = $idjadwal;
    	$saved2 = $newPeserta->save();

    	$nilai = new Nilai();
    	$nilai->id_jadwal = $jadwal->id_jadwal;
    	$nilai->nim = $nim;
    	$nilai->jenis_sertifikasi = $jadwal->jenis_sertifikasi;
    	$nilai->nilai = -1;
    	$nilai->pengambilan_ke = $data_pengambilan->$jeniss;
    	$nilai->status = 'belumdinilai';
    	$nilai->id_sertifikat = 'none';
    	$saved3 = $nilai->save();

    	if ($saved && $saved2 &&$saved3) {
    		return 'success';
    	}
    }

//menghapus peserta dalam jadwal tertentu
    public function deletePesertaJadwal(){
    	$idjadwal = $_REQUEST['id'];
    	$nim = $_REQUEST['nim'];

    	$jadwal = DB::table('jadwal')
    	->where('id_jadwal',$idjadwal)
    	->first();

    	$jenis_sertifikasi = "status_".$jadwal->jenis_sertifikasi;

    	$data = StatusMahasiswa::find($nim);
    	$data->$jenis_sertifikasi = 'active';
    	$saved = $data->save();

    	$delPeserta = PesertaUjian::where('nim',$nim)
    	->where('id_jadwal',$idjadwal);

    	$deleted = $delPeserta->delete();

    	$delNilai = DB::table('nilai')
    	->where([['id_jadwal',$idjadwal],['nim',$nim]])
    	->delete();

    	if ($saved && $deleted && $delNilai) {
    		return 'success';
    	}
    	
    }

//merubah status kelas
    public function changeStatusKelas(){
    	$id = $_REQUEST['id'];

    	$statkelas = DB::table('kelas')
    	->where('id_kelas',$id)
    	->first();

    	$update = Kelas::find($id);
    	if ($statkelas->status == 'active') {
    		$update->status = 'inactive';
    	}else{
    		$update->status = 'active';
    	}
    	$update->save();

    	$kelas = DB::table('kelas')
    	->get();

    	$printed = '<table class="table table-striped table-bordered bold" id="tableData">
				  				<thead>
				  					<tr>
				  						<th width="65%">Nama Kelas</th>
				  						<th width="20%">Status</th>
				  						<th width="5%">Switch</th>
				  						<th width="10%">Action</th>
				  					</tr>
				  				</thead>
				  				<tbody>';
		foreach ($kelas as $perkelas) {
			$printed = $printed.'<tr>
			  						<td>'.$perkelas->nama_kelas.'</td>';

			if ($perkelas->status == 'active') {
				$printed = $printed.'<td class="green">'.ucwords($perkelas->status).'</td>';
			}else{
				$printed = $printed.'<td class="red">'.ucwords($perkelas->status).'</td>';
			}
			  						
			$printed = $printed.'<th><input type="checkbox" class="js-switch" id="checkbox'.$perkelas->id_kelas.'"';

			if($perkelas->status == 'active'){
				$printed = $printed.'checked="true"';
			}

			$printed = $printed.'onchange="showModal('.$perkelas->id_kelas.')" /></th>
				  						<input type="hidden" id="hidden'.$perkelas->id_kelas.'" value="'.$perkelas->nama_kelas.'">
				  						<td><button class="btn btn-xs btn-success" onclick="showModalEditNama('.$perkelas->id_kelas.')">Edit Nama Kelas</button></td>
			  					</tr>';
		}
				  					
				  				$printed = $printed.'</tbody>
				  			</table>';
				  			return $printed;
    }

//menampilkan edit edit nama kelas
    public function showModalNamaKelas(){
    	$id = $_REQUEST['id'];

    	$datakelas = DB::table('kelas')
    	->where('id_kelas',$id)
    	->first();

    	$printed = '<label>Nama Baru Kelas : </label>
				        	<input type="text" class="form-control" name="namabaru" value="'.$datakelas->nama_kelas.'">
				        	<input type="hidden" name="idkelas" value="'.$id.'">';
    	return $printed;
    }

//set status admin
    public function setStatusAdmin(){
    	$id = $_REQUEST['id'];

    	$status = Admin::find($id);
    	if ($status->status == 'active') {
    		$status->status = 'inactive';
    	}else{
    		$status->status = 'active';
    	}

    	$saved = $status->save();

    	if ($saved) {
    		return 'saved';
    	}else{
    		return 'error';
    	}
    	
    }

//melakukan edit pada admin
    public function editAdmin(){
    	$nipbaru = $_REQUEST['nipbaru'];
		$namabaru = $_REQUEST['namabaru'];
		$otoritasbaru = $_REQUEST['otoritasbaru'];
		$niplama = $_REQUEST['niplama'];

		$admin = Admin::find($niplama);
		$admin->admin_id = $nipbaru;
		$admin->nama = $namabaru;
		$admin->otoritas = $otoritasbaru;
		$saved = $admin->save();

		dd($saved);

		return 'done';

    }

//set status trainer
    public function setStatusTrainer(){
    	$jenis_sertifikasi = $_REQUEST['js'];
    	$nip = $_REQUEST['nip'];

    	$trainer = Pengajar::find($nip);
    	if ($trainer->$jenis_sertifikasi == 1) {
    		$trainer->$jenis_sertifikasi = 0;
    	}else{
    		$trainer->$jenis_sertifikasi = 1;
    	}
    	$trainer->save();

    	return "";
    }

//menambah trainer
    public function addPengajar(){
    	date_default_timezone_set("Asia/Jakarta");
    	$nip = $_REQUEST['nip'];
    	$nama = $_REQUEST['nama'];
    	$statusmta = $_REQUEST['statusmta'];
    	$statusmos = $_REQUEST['statusmos'];
    	$statusscm = $_REQUEST['statusscm'];
    	$statusmtcna = $_REQUEST['statusmtcna'];
    	$statustrainer = $_REQUEST['statustrainer'];

    	$newtrainer = new Pengajar();
    	$newtrainer->nip = $nip;
    	$newtrainer->nama = $nama;
    	$newtrainer->mta = $statusmta;
    	$newtrainer->mos = $statusmos;
    	$newtrainer->mtcna = $statusmtcna;
    	$newtrainer->scm = $statusscm;
    	$newtrainer->status = $statustrainer;
    	$saved = $newtrainer->save();


    	return " ";
    }

//set status trainer
    function setStatusTrainerGlobal(){
    	$nip = $_REQUEST['nip'];


    	$trainer = Pengajar::find($nip);

    	if ($trainer->status == 'active') {
    		$trainer->status = 'inactive';
    	}else{
    		$trainer->status = 'active';
    	}
    	$saved = $trainer->save();

    	if ($saved) {
    		return 'success';
    	}else{
    		return 'fail';
    	}
    	
    	
    }

//mendapat list peserta pada jadwal tertentu
    function getPesertaJadwal(){
    	$idjadwal = $_REQUEST['id'];

    	$peserta = DB::table('peserta_ujian')
    	->join('mahasiswa','mahasiswa.nim','=','peserta_ujian.nim')
    	->select('peserta_ujian.*','nama')
    	->where('id_jadwal',$idjadwal)
    	->get();

    	$jadwal = DB::table('jadwal')
    	->join('pengajar','jadwal.id_dosen','=','pengajar.nip')
    	->where('id_jadwal',$idjadwal)
    	->first();

    	$jadwal->jenis_sertifikasi = strtoupper($jadwal->jenis_sertifikasi);
    	$jadwal->tanggal_3 = dateDayCreator($jadwal->tanggal_3);

    	$peserta = json_encode($peserta);
    	$jadwal = json_encode($jadwal);

    	$alldata = array(
    		'peserta'=>$peserta,
			'jadwal'=>$jadwal
    	);
    	return $alldata;
    }
}

