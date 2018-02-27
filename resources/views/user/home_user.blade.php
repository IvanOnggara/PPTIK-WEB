@extends('templates.layoutuser')

@section('content')
<div class="right_col" role="main">
		  <div class="">

            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon2"><i class="fa fa-circle" id="colormta"></i></div>
                  <div class="count">MTA
                </div>
                  <h3 id="statusmta">{{$all['statusall']->status_mta}}</h3>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon2"><i class="fa fa-circle" id="colormos"></i></div>
                  <div class="count">MOS</div>
                  <h3 id="statusmos">{{$all['statusall']->status_mos}}</h3>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon2"><i class="fa fa-circle" id="colorscm"></i></div>
                  <div class="count">SCM</div>
                  <h3 id="statusscm">{{$all['statusall']->status_scm}}</h3>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon2"><i class="fa fa-circle" id="colormtcna"></i></div>
                  <div class="count">MTCNA</div> 
                  <h3 id="statusmtcna">{{$all['statusall']->status_mtcna}}</h3>
                  
                </div>
              </div>
            </div>


			<div class="clearfix"></div>

		<div class="row">

			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2><i class="fa fa-home"></i> Home</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					  
					  <li><a class="close-link"><i class="fa fa-close"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">

				  <h3>Halo,{{session('user')}}</h3>
				  <h4>Untuk Melakukan pendaftaran sertifikasi, silahkan klik tombol dibawah</h4>
				  <a href="registrasi_baru"><button class="btn btn-success">Daftar Sertifikasi</button></a>
					
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jadwal terdekat <small>Batch</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if($all['jadwal'] == null)
                  	<article class="media event">
                      <a class="pull-left date">
                        <p class="month">-</p>
                        <p class="day">-</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">Tidak ada data</a>
                        <p>Belum ada jadwal untuk sertifikasi ke depan</p>
                      </div>
                    </article>
                  @endif
                  @foreach($all['jadwal'] as $ujian)
                  	<article class="media event">
                      <a class="pull-left date">
                        <p class="month">{{$ujian->bulan}}</p>
                        <p class="day">{{$ujian->tanggal}}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$ujian->sertifikasi}}</a>
                        <b><p>{{$ujian->jadwallengkap1}}</p></b>
                        <b><p>{{$ujian->jadwallengkap2}}</p></b>
                        <b><p>{{$ujian->jadwallengkap3}}</p></b>
                      </div>
                    </article>
                  @endforeach
                    
                  </div>
                </div>
              </div>
		</div>

		<div class="row">
			
		</div>


	</div>
</div>
@endsection
@section('footer_script')
<script type="text/javascript">
	var mta = document.getElementById("statusmta").innerHTML;
	var mos = document.getElementById("statusmos").innerHTML;
	var mtcna = document.getElementById("statusmtcna").innerHTML;
	var scm = document.getElementById("statusscm").innerHTML;

	if (mta == 'Terdaftar' || mta == 'Lulus') {
		$('#colormta').addClass('green');
		$('#statusmta').addClass('green');
	}else if (mta == 'Tidak Terdaftar') {
		$('#colormta').addClass('red');
		$('#statusmta').addClass('red');
	}else if (mta == 'Menunggu') {
		$('#colormta').addClass('orange');
		$('#statusmta').addClass('orange');
	}

	if (mos == 'Terdaftar' || mos == 'Lulus') {
		$('#colormos').addClass('green');
		$('#statusmos').addClass('green');
	}else if (mos == 'Tidak Terdaftar') {
		$('#colormos').addClass('red');
		$('#statusmos').addClass('red');
	}else if (mos == 'Menunggu') {
		$('#colormos').addClass('orange');
		$('#statusmos').addClass('orange');
	}

	if (mtcna == 'Terdaftar' || mtcna == 'Lulus') {
		$('#colormtcna').addClass('green');
		$('#statusmtcna').addClass('green');
	}else if (mtcna == 'Tidak Terdaftar') {
		$('#colormtcna').addClass('red');
		$('#statusmtcna').addClass('red');
	}else if (mtcna == 'Menunggu') {
		$('#colormtcna').addClass('orange');
		$('#statusmtcna').addClass('orange');
	}

	if (scm == 'Terdaftar' || scm == 'Lulus') {
		$('#colorscm').addClass('green');
		$('#statusscm').addClass('green');
	}else if (scm == 'Tidak Terdaftar') {
		$('#colorscm').addClass('red');
		$('#statusscm').addClass('red');
	}else if (scm == 'Menunggu') {
		$('#colorscm').addClass('orange');
		$('#statusscm').addClass('orange');
	}
</script>
@endsection