@extends('templates.layoutuser')

@section('content')
<div class="right_col" role="main">
		  <div class="">
			
			<div class="clearfix"></div>

			<div class="row">

			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2><i class="fa fa-bar-chart"></i> Nilai Ujian</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					  
					  <li><a class="close-link"><i class="fa fa-close"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
				  <h2 class="title_nilai" style="margin-bottom: 30px;">Data Nilai Ujian Sertifikasi</h2>
				  	<div class="data_nilai">
				  		
				  		<table style="font-size: 1.4em;font-weight: bold;margin-bottom: 20px;">
	                        <tr>
	                          <td>Nama </td>
	                          <td>&nbsp</td>
	                          <td> : </td>
	                          <td>&nbsp</td>
	                          <td> {{session('user')}}</td>
	                        </tr>
	                        <tr>
	                          <td>NIM </td>
	                          <td>&nbsp</td>
	                          <td>:</td>
	                          <td>&nbsp</td>
	                          <td> {{session('nim')}} </td>
	                        </tr>
	                    </table>

				  		<table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Jenis Sertifikasi</th>
		                          <th>Pengambilan ke</th>
		                          <th>Nilai</th>
		                          <th>Status</th>
		                          <th>Sertifikat</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      @if(count($data)==0)
		                      	<tr>
		                          <th scope="row">-</th>
		                          <td>-</td>
		                          <td>-</td>
		                          <td>-</td>
		                          <td>-</td>
		                        </tr>
		                      @else

			                    @foreach($data as $data2)
			                    	@foreach($data2 as $data1)
				                        <tr>
				                        @if($data1->jenis_sertifikasi === 'mta')
				                          	<th scope="row">Microsoft Technology Associate (MTA)</th>
				                        @elseif($data1->jenis_sertifikasi === 'mos')
				                        	<th scope="row">Microsoft Office Specialist (MOS)</th>
				                        @elseif($data1->jenis_sertifikasi === 'scm')
				                        	<th scope="row">Security Compliance Manager (SCM)</th>
				                        @else
				                        	<th scope="row">MikroTik Certified Network Associate (MTCNA)</th>
				                        @endif
				                          <td>{{$data1->pengambilan_ke}}</td>

				                        @if($data1->statusakhir == 'belumdinilai')
				                        	<td>-</td>
				                        	<td>Belum Dinilai</td>
				                        	<td>-</td>
				                        @else
				                          	<td>{{$data1->nilai}}</td>
				                          	<td>{{$data1->statusakhir}}</td>
					                        @if($data1->statusakhir=='lulus')
					                        <td><a onclick="createForm('{{$data1->jenis_sertifikasi}}','{{$data1->tanggal_3}}','{{$data1->nama}}','{{$data1->id_sertifikat}}')" href="#" style="color: blue ;border-bottom: 1px solid blue;"><i class="fa fa-download"></i> download</a></td>
					                        @else
					                        	<td>-</td>
					                        @endif
					                   	@endif
				                        </tr>
			                        @endforeach
			                    @endforeach
		                      @endif
		                      </tbody>
		                    </table>
				  	</div>
				  		
					<a href="registrasi_baru"><button class="btn btn-success"><b>Daftar Sertifikasi Lainnya</b></button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
	<script type="text/javascript" src="{{asset('build/js/cert.js')}}"></script>
	<script type="text/javascript">
		function createForm(jenis_sertifikasi,tanggal,nama_dosen,kode) {
			var user = document.getElementById("namauser").textContent;


			var doc = new jsPDF('landscape');

			doc.addImage(imgData, 'JPEG', 0, 0, 297, 210);
			doc.setFontSize(40);
			doc.text(user,148.5, 74, 'center');

			doc.setFontSize(20);
			if (jenis_sertifikasi == 'mta') {
				doc.text(122, 110, 'Microsoft Technology Associate');
			}else if (jenis_sertifikasi == 'scm') {
				doc.text(122, 110, 'Security Compliance Manager');
			}else if (jenis_sertifikasi == 'mtcna') {
				doc.text(122, 110, 'MikroTik Certified Network Associate');
			}else if (jenis_sertifikasi == 'mos') {
				doc.text(122, 110, 'Microsoft Office Specialist');
			}

			var kodefull = 'No Reg : '+kode;
			doc.setFontSize(10);
			doc.text(186,175,nama_dosen);
			doc.text(48,180.5,tanggal);
			doc.text(kodefull,295,208,'right');
			doc.save('certificate.pdf');
		}
	</script>
@endsection