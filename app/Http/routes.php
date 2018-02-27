<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//proses show home
Route::get('/home','userController@home');

//proses show login form
Route::get('/', function () {
    return view('login-register/loginform');
});

//proses logout
Route::get('logout', function () {
    if (Session::has('user')) {
        Session::forget('user');
        
        return redirect('/');
    }else if (Session::has('admin')) {
        Session::forget('admin');
        return redirect('/loginadmin');
    }
});

Route::get('logoutadmin',function(){
    Session::forget('admin');
    Session::forget('admin2');
    return redirect('/loginadmin');
});

//proses hasil register awal
Route::get('registration_result', function () {
    return view('login-register/registerresult');
});

//proses login
Route::post('login','loginController@login');

//proses register
Route::post('register','registerController@register');

//form change pass
Route::get('change_password','userController@changePassword');

//view bantuan
Route::get('bantuan', 'userController@bantuan');

//view jadwal
Route::get('jadwal', 'userController@jadwal');

//view rekap nilai
Route::get('rekap_nilai', 'userController@rekapNilai');

//view registrasi baru
Route::get('registrasi_baru', 'userController@registrasiBaru');

//proses ubah password
Route::post('proses_ubah_password','userController@prosesChangePassword');

//proses ubah password admin
Route::post('proses_ubah_password_admin','adminController@prosesChangePassword');

//proses cek registrasi baru
Route::post('cek_registrasi','userController@prosesCekRegistrasi');

//login admin
Route::get('loginadmin',function(){
	if (Session::has('admin')) {
        return redirect('homeadmin');
    }else if (Session::has('admin2')){
        return redirect('homeadministrasi');
    }else{
        return view('admin/login');
    }
});

//login admin
Route::get('homeadmin','adminController@homeadmin');

//login admin2
Route::get('homeadministrasi','adminController@homeadministrasi');

//home admin
Route::post('prosesloginadmin','adminController@login');

//update database
Route::post('update_database','adminController@updateDatabase');

//acc / not data request mahasiswa
Route::post('accRequest','adminController@accRequest');

//all mahasiswa
Route::get('allmahasiswa','adminController@mahasiswa');

//all admin
Route::get('alladmin','adminController@admin');

//all trainer
Route::get('alltrainer','adminController@trainer');

//set jadwal dan lihat jadwal admin
Route::get('setjadwal','adminController@jadwal');

//data nilai dan input nilai admin
Route::get('setnilai','adminController@nilai');

//show dosen jadwal baru admin
Route::get('show','adminController@show');

//sertifikat
Route::get('sertifikat',function(){
    return view('search/search');
});

//proses search sertifikat ajax (hapus jika tidak perlu)
Route::get('search','ajaxPHPController@proses');

//save jadwal admin
Route::post('savejadwal','adminController@savejadwal');

//save nilai
Route::post('savenilai','adminController@savenilai');

//view kelas di admin
Route::get('datakelas','adminController@showDataKelas');

//addkelas baru
Route::post('addkelas','adminController@addKelas');

//save edit nama
Route::post('savenamabaru','adminController@saveEditKelas');

//show form change password admin
Route::get('change_password_admin',function(){
    if (Session::has('admin') || Session::has('admin2')){
        return view('admin/changepassword');
    }else{
        return redirect('loginadmin');
    }
    
});

//add admin
Route::post('addadmin','adminController@addAdmin');



//AJAX

//show data lulus periode
Route::get('updateinfoadmin','ajaxController@updateGraph');

//download pdf list peserta di data lulus periode
Route::get('getlistpesertagraph','ajaxPHPController@downloadGraphData');

//data chart mta home admin
Route::get('echartmta','ajaxController@mtashow');

//data chart mos home admin
Route::get('echartmos','ajaxController@mosshow');

//data chart scm home admin
Route::get('echartscm','ajaxController@scmshow');

//data chart mtcna home admin
Route::get('echartmtcna','ajaxController@mtcnashow');

//ajax to show trainer
Route::get('trainer','ajaxPHPController@showtrainer');

//ajax to show tanggal dari halaman nilai
Route::get('tanggalnilai','ajaxPHPController@showtanggal');

//ajax to show list peserta halaman input nilai
Route::get('showlistpeserta','ajaxPHPController@showlistpeserta');

//save name user untuk admin
Route::get('savename','ajaxPHPController@savename');

//save name user untuk admin
Route::get('resetpassworduser','ajaxPHPController@setpassword');

//show rincian jadwal
Route::get('getrincian','ajaxPHPController@getRincianJadwal');

//edit jadwal
Route::get('editjadwal','ajaxPHPController@editJadwal');

//updatejadwal
Route::get('updatejadwal','ajaxPHPController@updateJadwal');

//show rincian peserta
Route::get('getpeserta','ajaxPHPController@getRincianPeserta');

//add peserta
Route::get('addpesertajadwal','ajaxPHPController@addPesertaJadwal');

//delete peserta
Route::get('deletepesertajadwal','ajaxPHPController@deletePesertaJadwal');

//change status kelas
Route::get('changestatuskelas','ajaxPHPController@changeStatusKelas');

//show modal edit nama kelas
Route::get('showmodaleditkelas','ajaxPHPController@showModalNamaKelas');

//reset password admin
Route::get('resetpasswordadmin','ajaxPHPController@setPasswordAdmin');

//set status admin
Route::get('setstatusadmin','ajaxPHPController@setStatusAdmin');

//edit admin
Route::get('editadmin','ajaxPHPController@editAdmin');

//set status pengajar
Route::get('setstatuspengajar','ajaxPHPController@setStatusTrainer');

//add pengajar
Route::get('addPengajar','ajaxPHPController@addPengajar');

//change status trainer
Route::get('changestatustrainer','ajaxPHPController@setStatusTrainerGlobal');

//get peserta untuk download PDF
Route::get('getpesertajadwal','ajaxPHPController@getPesertaJadwal');

//get peserta yang ada pada pie chart untuk semua jenis sertifikasi
Route::get('getlistpesertapiechart','ajaxPHPController@getListPesertaPieChart');