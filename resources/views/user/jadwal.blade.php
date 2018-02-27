@extends('templates.layoutuser')

@section('content')
<!-- page content -->
		<div class="right_col" role="main">
		  <div class="">

			<div class="clearfix"></div>

			<div class="">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title" >
					<h2><i class="fa fa-calendar"></i> Jadwal Ujian Sertifikasi </h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					  <li><a class="close-link"><i class="fa fa-close"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">


					<div class="" role="tabpanel" data-example-id="togglable-tabs">
					  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">MTA</a>
						</li>
						<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">SCM</a>
						</li>
						<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">MOS</a>
						</li>
						<li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">MTCNA</a>
						</li>
					  </ul>
					  <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
						@if($data['jadwalmta']=='active')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Anda Belum Mendapat Jadwal</h1>
			                      <p style="font-size: 18px;">mohon menunggu hingga admin memasang jadwal untuk anda.</p>
			                    </div>
			                </div>
						@elseif($data['jadwalmta']=='inactive')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Anda Tidak Terdaftar Pada Sertifikasi ini</h1>
			                      <p style="font-size: 18px;">Untuk mendaftar, bisa dilakukan pada pilihan berikut</p>
			                      <a href="registrasi_baru"><button type="button" class="btn btn-primary btn-lg"><b>Daftar</b></button></a>
			                    </div>
			                </div>
			            @elseif($data['jadwalmta']=='waiting')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Permintaan anda sedang diproses</h1>
			                      <p style="font-size: 18px;">Silahkan coba kembali mengakses dalam beberapa waktu kemudian</p>
			                    </div>
			                </div>
						@else
							<table class="table table-hover">
		                      <thead>
		                        <tr>
		                          <th>Hari,Tanggal</th>
		                          <th>Jam Mulai</th>
		                          <th>Jam Akhir</th>
		                          <th>Kelas</th>
		                          <th>Dosen Pengampu</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                       <tr>
			                          <th scope="row">{{$data['tanggal_mta_1']}}</th>
			                          <td>{{$data['jadwalmta']->jam_awal_1}}</td>
			                          <td>{{$data['jadwalmta']->jam_akhir_1}}</td>
			                          <td>{{$data['jadwalmta']->kelas1}}</td>
			                          <td>{{$data['jadwalmta']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mta_2']}}</th>
			                          <td>{{$data['jadwalmta']->jam_awal_2}}</td>
			                          <td>{{$data['jadwalmta']->jam_akhir_2}}</td>
			                          <td>{{$data['jadwalmta']->kelas2}}</td>
			                          <td>{{$data['jadwalmta']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mta_3']}}</th>
			                          <td>{{$data['jadwalmta']->jam_awal_3}}</td>
			                          <td>{{$data['jadwalmta']->jam_akhir_3}}</td>
			                          <td>{{$data['jadwalmta']->kelas3}}</td>
			                          <td>{{$data['jadwalmta']->nama}}</td>
			                        </tr>
		                      </tbody>
		                    </table>
						@endif
						  
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
						  
						  @if($data['jadwalscm']=='active')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Anda Belum Mendapat Jadwal</h1>
			                      <p style="font-size: 18px;">mohon menunggu hingga admin memasang jadwal untuk anda.</p>
			                    </div>
			                </div>
							@elseif($data['jadwalscm']=='inactive')
								<div class="bs-example" data-example-id="simple-jumbotron">
				                    <div class="jumbotron">
				                      <h1 style="font-size: 36px;">Anda Tidak Terdaftar Pada Sertifikasi ini</h1>
				                      <p style="font-size: 18px;">Untuk mendaftar, bisa dilakukan pada pilihan berikut</p>
										<a href="registrasi_baru"><button type="button" class="btn btn-primary btn-lg"><b>Daftar</b></button></a>
				                    </div>
				                </div>
				            @elseif($data['jadwalscm']=='waiting')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Permintaan anda sedang diproses</h1>
			                      <p style="font-size: 18px;">Silahkan coba kembali mengakses dalam beberapa waktu kemudian</p>
			                    </div>
			                </div>
							@else
								<table class="table table-hover">
			                      <thead>
			                        <tr>
			                          <th>Hari,Tanggal</th>
			                          <th>Jam Mulai</th>
			                          <th>Jam Akhir</th>
			                          <th>Kelas</th>
			                          <th>Dosen Pengampu</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_scm_1']}}</th>
			                          <td>{{$data['jadwalscm']->jam_awal_1}}</td>
			                          <td>{{$data['jadwalscm']->jam_akhir_1}}</td>
			                          <td>{{$data['jadwalscm']->kelas1}}</td>
			                          <td>{{$data['jadwalscm']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_scm_2']}}</th>
			                          <td>{{$data['jadwalscm']->jam_awal_2}}</td>
			                          <td>{{$data['jadwalscm']->jam_akhir_2}}</td>
			                          <td>{{$data['jadwalscm']->kelas2}}</td>
			                          <td>{{$data['jadwalscm']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_scm_3']}}</th>
			                          <td>{{$data['jadwalscm']->jam_awal_3}}</td>
			                          <td>{{$data['jadwalscm']->jam_akhir_3}}</td>
			                          <td>{{$data['jadwalscm']->kelas3}}</td>
			                          <td>{{$data['jadwalscm']->nama}}</td>
			                        </tr>
			                      </tbody>
			                    </table>
							@endif

						</div>
						<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
						  @if($data['jadwalmos']=='active')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Anda Belum Mendapat Jadwal</h1>
			                      <p style="font-size: 18px;">mohon menunggu hingga admin memasang jadwal untuk anda.</p>
			                    </div>
			                </div>
							@elseif($data['jadwalmos']=='inactive')
								<div class="bs-example" data-example-id="simple-jumbotron">
				                    <div class="jumbotron">
				                      <h1 style="font-size: 36px;">Anda Tidak Terdaftar Pada Sertifikasi ini</h1>
				                      <p style="font-size: 18px;">Untuk mendaftar, bisa dilakukan pada pilihan berikut</p>
				                      <a href="registrasi_baru"><button type="button" class="btn btn-primary btn-lg"><b>Daftar</b></button></a>
				                    </div>
				                </div>
				            @elseif($data['jadwalmos']=='waiting')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Permintaan anda sedang diproses</h1>
			                      <p style="font-size: 18px;">Silahkan coba kembali mengakses dalam beberapa waktu kemudian</p>
			                    </div>
			                </div>
							@else
								<table class="table table-hover">
			                      <thead>
			                        <tr>
			                          <th>Hari,Tanggal</th>
			                          <th>Jam Mulai</th>
			                          <th>Jam Akhir</th>
			                          <th>Kelas</th>
			                          <th>Dosen Pengampu</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mos_1']}}</th>
			                          <td>{{$data['jadwalmos']->jam_awal_1}}</td>
			                          <td>{{$data['jadwalmos']->jam_akhir_1}}</td>
			                          <td>{{$data['jadwalmos']->kelas1}}</td>
			                          <td>{{$data['jadwalmos']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mos_2']}}</th>
			                          <td>{{$data['jadwalmos']->jam_awal_2}}</td>
			                          <td>{{$data['jadwalmos']->jam_akhir_2}}</td>
			                          <td>{{$data['jadwalmos']->kelas2}}</td>
			                          <td>{{$data['jadwalmos']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mos_3']}}</th>
			                          <td>{{$data['jadwalmos']->jam_awal_3}}</td>
			                          <td>{{$data['jadwalmos']->jam_akhir_3}}</td>
			                          <td>{{$data['jadwalmos']->kelas3}}</td>
			                          <td>{{$data['jadwalmos']->nama}}</td>
			                        </tr>
			                      </tbody>
			                    </table>
							@endif

						</div>
						<div role="tabpanel" class="tab-pane fade in" id="tab_content4" aria-labelledby="home-tab">
						  @if($data['jadwalmtcna']=='active')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Anda Belum Mendapat Jadwal</h1>
			                      <p style="font-size: 18px;">mohon menunggu hingga admin memasang jadwal untuk anda.</p>
			                    </div>
			                </div>
							@elseif($data['jadwalmtcna']=='inactive')
								<div class="bs-example" data-example-id="simple-jumbotron">
				                    <div class="jumbotron">
				                      <h1 style="font-size: 36px;">Anda Tidak Terdaftar Pada Sertifikasi ini</h1>
				                      <p style="font-size: 18px;">Untuk mendaftar, bisa dilakukan pada pilihan berikut</p>
				                      <a href="registrasi_baru"><button type="button" class="btn btn-primary btn-lg"><b>Daftar</b></button></a>
				                    </div>
				                </div>
			                @elseif($data['jadwalmtcna']=='waiting')
							<div class="bs-example" data-example-id="simple-jumbotron">
			                    <div class="jumbotron">
			                      <h1 style="font-size: 36px;">Permintaan anda sedang diproses</h1>
			                      <p style="font-size: 18px;">Silahkan coba kembali mengakses dalam beberapa waktu kemudian</p>
			                    </div>
			                </div>
							@else
								<table class="table table-hover">
			                      <thead>
			                        <tr>
			                          <th>Hari,Tanggal</th>
			                          <th>Jam Mulai</th>
			                          <th>Jam Akhir</th>
			                          <th>Kelas</th>
			                          <th>Dosen Pengampu</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                        <tr>
			                          <th scope="row" >{{$data['tanggal_mtcna_1']}}</th>
			                          <td>{{$data['jadwalmtcna']->jam_awal_1}}</td>
			                          <td>{{$data['jadwalmtcna']->jam_akhir_1}}</td>
			                          <td>{{$data['jadwalmtcna']->kelas1}}</td>
			                          <td>{{$data['jadwalmtcna']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mtcna_2']}}</th>
			                          <td>{{$data['jadwalmtcna']->jam_awal_2}}</td>
			                          <td>{{$data['jadwalmtcna']->jam_akhir_2}}</td>
			                          <td>{{$data['jadwalmtcna']->kelas2}}</td>
			                          <td>{{$data['jadwalmtcna']->nama}}</td>
			                        </tr>
			                        <tr>
			                          <th scope="row">{{$data['tanggal_mtcna_3']}}</th>
			                          <td>{{$data['jadwalmtcna']->jam_awal_3}}</td>
			                          <td>{{$data['jadwalmtcna']->jam_akhir_3}}</td>
			                          <td>{{$data['jadwalmtcna']->kelas3}}</td>
			                          <td>{{$data['jadwalmtcna']->nama}}</td>
			                        </tr>
			                      </tbody>
			                    </table>
							@endif

						</div>
					  </div>
					</div>

				  </div>
				</div>
			  </div>
			  </div>
			  </div>
			  </div>
@endsection

@section('footer_script')
	
@endsection