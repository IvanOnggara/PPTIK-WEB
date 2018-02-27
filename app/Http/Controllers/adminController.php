<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Jadwal;
use App\Mahasiswa;
use App\PesertaUjian;
use App\StatusMahasiswa;
use App\Bukti;
use App\Nilai;
use App\Sertifikat;
use App\DataPengambilan;
use App\Kelas;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Session;
use DB;


class adminController extends Controller
{
	
	    public function login(){
	    	//set time
			date_default_timezone_set("Asia/Jakarta");

			
			$admin_id=$_POST['user'];
			$password=$_POST['password'];
			$password = md5($password);

			$data = DB::table('admin')->where([
				['admin_id',$admin_id],['password',$password],['status','active']
		]);
		
		$count = $data->count();
		$data2 = $data->first();
		//check login
		if ($count>=1) {
			
			if ($data2->otoritas == '1') {
				session(['admin' => $data2->nama]);
				session(['nip' => $data2->admin_id]);
				return redirect('/homeadmin');
			}else{
				session(['admin2' => $data2->nama]);
				session(['nip' => $data2->admin_id]);
				return redirect('/homeadministrasi');
			}
			
		}else{
			//login failed
			return redirect('/loginadmin')->with('statuslogadmin', 'Username atau Password anda salah!');
		}
		
	}

	//menampilkan home
	public function homeadmin(Request $request){
		
		date_default_timezone_set("Asia/Jakarta");

		if (Session::has('admin')) {

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
            
			$bukti = DB::table('bukti')
			->join('mahasiswa','mahasiswa.nim','=','bukti.nim')
			->where('status','unchecked')
			->get();

			foreach ($bukti as $data) {
				if ($data->jenis_sertifikasi == 'mta') {
					$data->nama_sertifikasi = 'Microsoft Technology Associate (MTA)';
				}else if ($data->jenis_sertifikasi == 'mos') {
					$data->nama_sertifikasi = 'Microsoft Office Specialist (MOS)';
				}else if ($data->jenis_sertifikasi == 'mtcna') {
					$data->nama_sertifikasi = 'MikroTik Certified Network Associate (MTCNA)';
				}else if ($data->jenis_sertifikasi == 'scm') {
					$data->nama_sertifikasi = 'Security Compliance Manager (SCM)';
				}
			}

			$periode = DB::table('jadwal')
			->distinct()
			->get(['periode']);

			$mtaaktif = DB::table('status_mahasiswa')
			->where('status_mta','active')
            ->orWhere('status_mta', 'active-jadwal')
			->count();

			$mosaktif = DB::table('status_mahasiswa')
			->where('status_mos','active')
			->orWhere('status_mos', 'active-jadwal')
			->count();

			$scmaktif = DB::table('status_mahasiswa')
			->where('status_scm','active')
			->orWhere('status_scm', 'active-jadwal')
			->count();

			$mtcnaaktif = DB::table('status_mahasiswa')
			->where('status_mtcna','active')
			->orWhere('status_mtcna', 'active-jadwal')
			->count();

			$arraytohome = array(
				'periode'  => $periode,
                'bukti'   => $bukti,
                'mtaaktif' =>$mtaaktif,
                'mosaktif' =>$mosaktif,
                'scmaktif' =>$scmaktif,
                'mtcnaaktif' =>$mtcnaaktif
			);
			
			return view('admin/home',['array'=>$arraytohome]);
		}else{
			return redirect('/loginadmin');
		}
	}	

	//menampilkan home untuk admin keuangan
	public function homeadministrasi(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		if (Session::has('admin2')) {
			$bukti = DB::table('bukti')
			->join('mahasiswa','mahasiswa.nim','=','bukti.nim')
			->where('status','unchecked')
			->get();

			$allbukti = DB::table('bukti')
			->join('mahasiswa','mahasiswa.nim','=','bukti.nim')
			->get();

			foreach ($bukti as $data) {
				if ($data->jenis_sertifikasi == 'mta') {
					$data->nama_sertifikasi = 'Microsoft Technology Associate (MTA)';
				}else if ($data->jenis_sertifikasi == 'mos') {
					$data->nama_sertifikasi = 'Microsoft Office Specialist (MOS)';
				}else if ($data->jenis_sertifikasi == 'mtcna') {
					$data->nama_sertifikasi = 'MikroTik Certified Network Associate (MTCNA)';
				}else if ($data->jenis_sertifikasi == 'scm') {
					$data->nama_sertifikasi = 'Security Compliance Manager (SCM)';
				}
			}

			foreach ($allbukti as $data) {
				if ($data->jenis_sertifikasi == 'mta') {
					$data->nama_sertifikasi = 'Microsoft Technology Associate (MTA)';
				}else if ($data->jenis_sertifikasi == 'mos') {
					$data->nama_sertifikasi = 'Microsoft Office Specialist (MOS)';
				}else if ($data->jenis_sertifikasi == 'mtcna') {
					$data->nama_sertifikasi = 'MikroTik Certified Network Associate (MTCNA)';
				}else if ($data->jenis_sertifikasi == 'scm') {
					$data->nama_sertifikasi = 'Security Compliance Manager (SCM)';
				}

				if ($data->status == 'unchecked') {
					$data->nama_status = 'belum diperiksa';
					$data->style = 'orange';
				}else if ($data->status == 'accepted') {
					$data->nama_status = 'diterima';
					$data->style = 'green';
				}else if ($data->status == 'denied') {
					$data->nama_status = 'ditolak';
					$data->style = 'red';
				}
			}

			$arraytohome = array(
                'bukti'   => $bukti,
                'allbukti' => $allbukti
			);
			
			return view('admin/homeadministrasi',['array'=>$arraytohome]);
		}else{
			return redirect('/loginadmin');
		}
	}	

//tidak digunakan
	public function updateDatabase(Request $request){
		// if (Session::has('admin')) {
			
			
		// 	date_default_timezone_set("Asia/Jakarta");
		// 	$tanggal = date('Y-m-d');
		// 	$waktu = date("H:i:sa");
		// 	$lastupdate = DB::table('last_update')->update(['tanggal_update' => $tanggal]);
		// 	$lastupdate = DB::table('last_update')->update(['waktu_update'=>$waktu]);

		// 	return redirect('homeadmin');
		// }else{
		// 	return view('admin/login');
		// }
	}

//untuk handle acc atau decline pengajuan bukti pembayaran
	public function accRequest(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		if (Session::has('admin') || Session::has('admin2')) {
			$decision = $request->decision;
			$id_bukti = $request->id;

			$dataacc = DB::table('bukti')->where('id_bukti',$id_bukti)->first();
			$nim = $dataacc->nim;
			$jenis_sertifikasi = $dataacc->jenis_sertifikasi;
			$pengambilan_ke = $dataacc->pengambilan_ke;

			if ($decision=='true') {
				$saved = Bukti::where('id_bukti',$id_bukti)->update(['status' => 'accepted']);
				
				$updateStatus = StatusMahasiswa::where('nim',$nim)
				->update(['status_'.$jenis_sertifikasi => 'active']);

			}else if ($decision=='false') {
				$saved = Bukti::where('id_bukti',$id_bukti)->update(['status' => 'denied']);

				$updateStatus = StatusMahasiswa::where('nim',$nim)
				->update(['status_'.$jenis_sertifikasi => 'inactive']);

				$updateDataPengambilan = DataPengambilan::where('nim',$nim)
				->update([''.$jenis_sertifikasi => $pengambilan_ke-1]);
			}

			return redirect('homeadmin');

		}else{
			return redirect('/loginadmin');
		}
	}

//menampilkan seluruh mahasiswa di halaman admin
	public function mahasiswa(){
		if (Session::has('admin')) {
			date_default_timezone_set("Asia/Jakarta");
			$mahasiswa = DB::table('mahasiswa')
			->join('status_mahasiswa','mahasiswa.nim','=','status_mahasiswa.nim')
			->get();

			foreach ($mahasiswa as $permahasiswa) {
				if ($permahasiswa->status_mta == 'active-jadwal') {
					$permahasiswa->status_mta = 'active';
				}

				if ($permahasiswa->status_mos == 'active-jadwal') {
					$permahasiswa->status_mos = 'active';
				}

				if ($permahasiswa->status_scm == 'active-jadwal') {
					$permahasiswa->status_scm = 'active';
				}

				if ($permahasiswa->status_mtcna == 'active-jadwal') {
					$permahasiswa->status_mtcna = 'active';
				}

				
			}

			return view('admin/allmahasiswa',['mahasiswa'=>$mahasiswa]);
		}else{
			return redirect('/loginadmin');
		}
	}

//menampilkan seluruh admin di halaman admin
	public function admin(){
		if (Session::has('admin')) {
			date_default_timezone_set("Asia/Jakarta");
			$admin = DB::table('admin')
			->get();
			$adminjson = json_encode($admin);

			$arraydata = array(
				'admin'=>$admin,
				'adminjson'=>$adminjson
			);

			return view('admin/alladmin',['array'=>$arraydata]);
		}else{
			return redirect('/loginadmin');
		}
	}


//menampilkan seluruh trainer di halaman admin
	public function trainer(){
		if (Session::has('admin')) {
			date_default_timezone_set("Asia/Jakarta");
			$trainer = DB::table('pengajar')
			->get();

			$array = array(
				'trainer'=>$trainer,
				'trainerjson'=>json_encode($trainer),
			);

			return view('admin/alltrainer',['array'=>$array]);
		}else{
			return redirect('/loginadmin');
		}
	}

//menampilkan seluruh jadwal di halaman admin
	public function jadwal(){
		if (Session::has('admin')) {
			$data = DB::table('kelas')
			->where('status','active')->get();

			$alljadwal = collect(DB::table('jadwal')
			->join('pengajar','pengajar.nip','=','jadwal.id_dosen')
			->get())
			->keyBy('id_jadwal');

			foreach ($alljadwal as $jadwal) {
				$jadwal->semester = ucwords($jadwal->semester);
				$jadwal->jenis_sertifikasi = strtoupper($jadwal->jenis_sertifikasi);
				if ($jadwal->tanggal_3<date("Y-m-d")) {
					$jadwal->status = 'inactive';
				}else{
					$jadwal->status = 'active';
				}
			}

			$arraydata = array(
				'kelas'=>$data,
				'alljadwal'=>$alljadwal
			);

			return view('admin/jadwal',['array'=>$arraydata]);
		}else{
			return redirect('/loginadmin');
		}
	}

//menampilkan halaman edit nilai di admin
	public function nilai(){
		if (Session::has('admin')) {
			$periode = DB::table('jadwal')
			->distinct()
			->get(['periode']);

			$arraydata = array(
				'periode'=>$periode
			);

			return view('admin/nilai',['array'=>$arraydata]);
		}else{
			return redirect('/loginadmin');
		}
	}

//fungsi untuk melakukan simpan jadwal
	public function savejadwal(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$jenis_sertifikasi = $request->jenissertifikasi;
		$trainer = $request->trainer;
		$tanggal1 = $request->tanggal1;
		$jammulai1 = $request->jammulai1;
		$jamakhir1 = $request->jamakhir1;
		$kelas1 = $request->kelas1;

		$tanggal2 = $request->tanggal2;
		$jammulai2 = $request->jammulai2;
		$jamakhir2 = $request->jamakhir2;
		$kelas2 = $request->kelas2;

		$tanggal3 = $request->tanggal3;
		$jammulai3 = $request->jammulai3;
		$jamakhir3 = $request->jamakhir3;
		$kelas3 = $request->kelas3;

		$arraytanggal = explode("/", $tanggal1);
		$bulan = $arraytanggal[1];
		$tahun = $arraytanggal[0];
		$tahunmin = $tahun-1;
		$tahunmax = $tahun+1;
		
		if ($bulan<'07') {
			$semester = 'genap';
			$periode = $tahunmin."/".$tahun;
		}else{
			$semester = 'ganjil';
			$periode = $tahun."/".$tahunmax;
		}

		$last_id = DB::table('jadwal')
		->orderBy('created_at', 'desc')
		->first();

		if ($last_id == null) {
			$generator = 'JD0';
		}else{
			$generator = $last_id->id_jadwal;
		}
		
		$newId = genereateNewIdJadwal($generator);

		$savedata = new Jadwal();
		$savedata->id_jadwal = $newId;
		$savedata->id_dosen = $trainer;
		$savedata->jenis_sertifikasi = $jenis_sertifikasi;
		$savedata->id_kelas_1 = $kelas1;
		$savedata->id_kelas_2 = $kelas2;
		$savedata->id_kelas_3 = $kelas3;
		$savedata->tanggal_1 = $tanggal1;
		$savedata->tanggal_2 = $tanggal2;
		$savedata->tanggal_3 = $tanggal3;
		$savedata->jam_awal_1 = $jammulai1;
		$savedata->jam_akhir_1 = $jamakhir1;
		$savedata->jam_awal_2 = $jammulai2;
		$savedata->jam_akhir_2 = $jamakhir2;
		$savedata->jam_awal_3 = $jammulai3;
		$savedata->jam_akhir_3 = $jamakhir3;
		$savedata->periode = $periode;
		$savedata->semester = $semester;
		$savedata->status = 'active';
		$savedata->save();

		return redirect('setjadwal');
	}

//fungsi untuk melakukan simpan nilai
	public function savenilai(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$idjadwal = $request->idjadwal;
		$jenissertifikasi = $request->jenissertifikasi;


		$peserta = DB::table('peserta_ujian')
		->join('jadwal','jadwal.id_jadwal','=','peserta_ujian.id_jadwal')
		->where('peserta_ujian.id_jadwal',$idjadwal)
		->get();


		foreach ($peserta as $data) {
			
			$nim = $data->nim;
			if ($request->$nim<90) {
				$status = 'tidak lulus';
				$id_sertifikat = 'none';
			}else{
				$status = 'lulus';
				$id_sertifikat = generateSertifikat($data->nim,$data->jenis_sertifikasi,$data->tanggal_3);  
			}
			$nilailama = DB::table('nilai')
			->where([['nim',$data->nim],['id_jadwal',$data->id_jadwal]])
			->first();
			$valuenilailama = $nilailama->nilai;


			$nilai = Nilai::where('nim', $data->nim)
          	->where('id_jadwal', $data->id_jadwal)
          	->update(['nilai' => $request->$nim]);

          	if ($nilai) {
          		$status1 = 'Data sudah berhasil tersimpan';
          	}else{
          		if ($valuenilailama != $request->$nim) {
          			$status1 = 'Data gagal disimpan';
          		}
          		
          	}


          	$nilai1 = Nilai::where('nim', $data->nim)
          	->where('id_jadwal', $data->id_jadwal)
          	->update(['status' => $status]);

          	if (!$nilai1 && $valuenilailama != $request->$nim) {
          		$status1 = 'Data gagal disimpan';
          	}      	

          	$nilai2 = Nilai::where('nim', $data->nim)
          	->where('id_jadwal', $data->id_jadwal)
          	->update(['id_sertifikat' => $id_sertifikat]);

          	if (!$nilai2  && $valuenilailama != $request->$nim) {
          		$status1 = 'Data gagal disimpan';
          	}

          	if ($id_sertifikat == 'none') {
          		$deleted = DB::table('data_sertifikat')
          		->where([['nim',$nim],['jenis_sertifikasi',$jenissertifikasi]])
          		->delete();
          	}else{
          		$data_sertifikat = DB::table('data_sertifikat')->where('id_sertifikat',$id_sertifikat)->count();
          		if ($data_sertifikat<=0) {
          			$sertifikat = new Sertifikat();
          			$sertifikat->id_sertifikat = $id_sertifikat;
          			$sertifikat->nim = $nim;
          			$sertifikat->jenis_sertifikasi = $data->jenis_sertifikasi;
          			$sertifikat->save();
          		}
          	}
		}
		$status1 = 'Data sudah berhasil tersimpan';
		return redirect('/setnilai')->with('statusSave', $status1);
	}

//menampilkan seluruh list kelas
	public function showDataKelas(){
		date_default_timezone_set("Asia/Jakarta");

		$kelas = DB::table('kelas')
		->get();

		$arraydata = array(
			'kelas'=>$kelas
		);

		return view('admin/kelas',['array'=>$arraydata]);
	}

//menambah kelas
	public function addKelas(){
		date_default_timezone_set("Asia/Jakarta");

		$kelas = new Kelas();
		$kelas->nama_kelas = ucwords(strtolower($_POST['namakelasbaru']));
		$kelas->status = $_POST['statuskelasbaru'];
		$saved = $kelas->save();

		if ($saved) {
			return redirect('datakelas')->with('status','sukses');
		}else{
			return redirect('datakelas')->with('status','gagal');
		}
		
	}

//menyimpan data edit dari kelas
	public function saveEditKelas(){
		date_default_timezone_set("Asia/Jakarta");

		$id = $_POST['idkelas'];
		$nama = $_POST['namabaru'];

		$kelas = Kelas::find($id);
		$kelas->nama_kelas = $nama;
		$saved = $kelas->save();

		if ($saved) {
			return redirect('datakelas')->with('statusEditSucc','Data Berhasil Disimpan');
		}else{
			return redirect('datakelas')->with('statusEditFail','Data Gagal Disimpan');
		}
	}

//change password
	public function prosesChangePassword(Request $request){
		date_default_timezone_set("Asia/Jakarta");
		$password_lama = $request->old_password;
		$password_lama = md5($password_lama);

		$password_baru = $request->new_password;

		$nip = Session::get('nip');
		$data = DB::table('admin')->where([['password',$password_lama],['admin_id',$nip]]);
		$count = $data->count();
		if ($count>=1) {
			if (strlen($password_baru)<6) {
				return redirect('/change_password')->with('alert_fail', 'Password baru terlalu pendek. Minimal 6 karakter');
			}
			$password_baru = md5($password_baru);
			
			$saved = Admin::find($nip);
			$saved->password = $password_baru;
			$saved2 = $saved->save();

			if (!$saved2) {
				return redirect('/change_password_admin')->with('alert_fail','Password gagal disimpan. silahkan coba lagi');
			}
			return redirect('/change_password_admin')->with('alert_success','Password anda berhasil dirubah!');
		}else{
			return redirect('/change_password_admin')->with('alert_fail','Password lama anda salah!');
		}
	}

//menambah admin baru
	public function addAdmin(Request $request){
		date_default_timezone_set("Asia/Jakarta");

		$nip = $request->nip;
		$nama = $request->nama;
		$otoritas = $request->otoritas;
		$password = $request->password;
		$password = md5($password);
		$status = $request->status;

		$newAdmin = new Admin();
		$newAdmin->admin_id = $nip;
		$newAdmin->nama = $nama;
		$newAdmin->password = $password;
		$newAdmin->otoritas = $otoritas;
		$newAdmin->status = $status;
		$saved = $newAdmin->save();

		if ($saved) {
			return redirect('alladmin')->with('status','sukses');
		}else{
			return redirect('alladmin')->with('status','error');
		}
	}
}
