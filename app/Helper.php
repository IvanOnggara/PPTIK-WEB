<?php 

function monthCreator($a){
	if ($a == "01") {
		return "Januari";
	}else if ($a == "02") {
		return "Februari";
	}else if ($a == "03") {
		return "Maret";
	}else if ($a == "04") {
		return "April";
	}else if ($a == "05") {
		return "Mei";
	}else if ($a == "06") {
		return "Juni";
	}else if ($a == "07") {
		return "Juli";
	}else if ($a == "08") {
		return "Agustus";
	}else if ($a == "09") {
		return "September";
	}else if ($a == "10") {
		return "Oktober";
	}else if ($a == "11") {
		return "November";
	}else if ($a == "12") {
		return "Desember";
	}
}

function dateDayCreator($a){
	$day = dayCreator(date("l", strtotime($a)));
	$data = explode("-", $a);
	$hasil = $day.', '.$data[2].' '.monthCreator($data[1]).' '.$data[0];
	return $hasil;
}

function dateCreator($a){
	$data = explode("-", $a);
	$hasil = $data[2].' '.monthCreator($data[1]).' '.$data[0];
	return $hasil;
}

function databaseShowHomeAdmin($q,$p,$s,$j){
	$data = DB::table('peserta_ujian')
			->join('jadwal','jadwal.id_jadwal','=','peserta_ujian.id_jadwal')
			->where([['jadwal.periode',$q],['peserta_ujian.nim','like',$p],['jadwal.semester',$s],['jadwal.jenis_sertifikasi',$j]])
			->count();

			return $data;
}

function databaseListPesertaPieChart($q,$p,$s,$j){
	$data = DB::table('peserta_ujian')
			->join('jadwal','jadwal.id_jadwal','=','peserta_ujian.id_jadwal')
			->join('mahasiswa','mahasiswa.nim','=','peserta_ujian.nim')
			->where([['jadwal.periode',$q],['peserta_ujian.nim','like',$p],['jadwal.semester',$s],['jadwal.jenis_sertifikasi',$j]])
			->get();

			return $data;
}

function dayCreator($a){
	switch ($a) {
		case 'Monday':
			return 'Senin';
			break; 
		case 'Tuesday':
			return 'Selasa';
			break; 
		case 'Wednesday':
			return 'Rabu';
			break; 
		case 'Thursday':
			return 'Kamis';
			break;  
		case 'Friday':
			return 'Jumat';
			break;  
		case 'Saturday':
			return 'Sabtu';
			break;  
		case 'Sunday':
			return 'Minggu';
			break; 
	}
}

function generateSertifikat($nim,$jenis_sertifikasi,$tanggal){
	$datatanggal = explode('-', $tanggal);
	$tahun = substr($datatanggal[0], 2);
	
	switch ($jenis_sertifikasi) {
		case 'mta':
			$code = '1';
			break;
		
		case 'mos':
			$code = '2';
			break;
		
		case 'scm':
			$code = '3';
			break;
		
		case 'mtcna':
			$code = '4';
			break;
		
		default:
			break;
	}

	$id = $tahun.$datatanggal[1].$datatanggal[2].$nim.$code.'';
	return $id;
}

function generatePassword(){
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function genereateNewIdJadwal($id){
	$numberId = substr($id, 2);
	$newNumber = $numberId + 1;
	$newId = "JD".$newNumber;

	return $newId;
}



 ?>

 

