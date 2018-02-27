@extends('templates.layoutuser')

@section('content')
<!-- page content -->
		<div class="right_col" role="main" >
			<div class="">
			
			<div class="clearfix"></div>

			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
					<h2><i class="fa fa-list"></i> Registrasi Sertifikasi</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
					</div>
					<div class="x_content">
										<!-- Smart Wizard -->
										<p>Masukkan data sesuai permintaan dibawah ini.</p>
										<p style="color: #c11717">Syarat: Telah melakukan transfer sebesar <b>Rp 350.000.</b> ke nomor rekening <b>CIMB Niaga 0350 1070 07007 </b>atas nama <b>Harapan Bangsa Sejahtera</b></p>

										<form class="form-horizontal form-label-left" method="post" action="cek_registrasi" id="registrasiform" enctype="multipart/form-data">
										{{csrf_field()}}
										<div id="wizard" class="form_wizard wizard_horizontal">
											<ul class="wizard_steps">
												<li>
													<a href="#step-1">
														<span class="step_no">1</span>
														<span class="step_descr">Step 1<br /><small>Data</small></span>
													</a>
												</li>
												<li>
													<a href="#step-2">
														<span class="step_no">2</span>
														<span class="step_descr">Step 2<br /><small>Upload Bukti</small></span>
													</a>
												</li>
												<li>
													<a href="#step-3">
														<span class="step_no">3</span>
														<span class="step_descr">Step 3<br /><small>Informasi</small></span>
													</a>
												</li>
												
											</ul>
											<div id="step-1">
													<div class="form-group">
														<label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12" type="text" name="nama_lengkap" disabled="" value="{{Session::get('user')}}">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">NIM</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="nim" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" disabled name="nim" value="{{Session::get('nim')}}">
														</div>
													</div>
													
													<div class="form-group">
														<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Sertifikasi <span class="required">*</span></label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<select class="form-control col-md-7 col-xs-12" id="jenis_sertifikasi" name="jenissertifikasi" required="required">
																<option value="" disabled selected>Pilih jenis sertifikasi</option>
																<option value="MOS">Microsoft Office Specialist (MOS)</option>
																<option value="MTA">Microsoft Technology Associate (MTA)</option>
																<option value="SCM">Security Compliance Manager (SCM)</option>
																<option value="MTCNA">MikroTik Certified Network Administrator (MTCNA)</option>
															</select>
														</div>
													</div>
											</div>
											<div id="step-2" style="height: 200px;">
												<div class="col-md-offset-3 col-lg-offset-3  col-md-6 col-lg-6 col-xs-12">
													<h2 class="StepTitle">Upload bukti pembayaran</h2>
													<input id="bukti" type="file" onchange="readUrl(this)" required="required" name="bukti" accept=".jpg,.jpeg,.png"/>

													<img id="editor-one" alt="Ukuran file maksimum adalah 2mb" style="width: 60%;color: red;"></img>
												</div>
											</div>
										
										<div id="step-3">
											<div class="col-md-offset-3 col-lg-offset-3  col-md-6 col-lg-6 col-xs-12">
												<h2 class="StepTitle">Informasi</h2>
												<h4>
													Admin akan melakukan cek pada bukti pembayaran anda. segera setelah dinyatakan aktif, anda akan dapat melihat jadwal ujian anda pada tab jadwal.
												</h4>
												<h4>
													Apabila dalam kurun waktu satu minggu, anda masih belum dinyatakan sudah terdaftar. anda dapat menghubungi admin!
												</h4>
												
												<div class="text-center">
													<button type="submit" class="btn btn-success" onclick="validateForm()" id="buttonsubmitbaru">Submit</button>
												</div>
											</div>
										</div>

										</div>
										</form>
										<!-- End SmartWizard Content -->
										@if(session('error'))
											<b><h4 style="text-align: center; color: red;font-weight: bold;">{{session('error')}}</h4></b>
										@endif
										@if(session('success'))
											<b><h4 style="text-align: center; color: green;font-weight: bold;">{{session('success')}}</h4></b>
										@endif
										<b><h4 id="message" style="text-align: center; color: red;font-weight: bold;"></h4></b>
										
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer_script')
<script type="text/javascript">
	function readUrl(input) {

		if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
						$('#editor-one').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
		}
	}

	function validateForm() {

	  var isValid = true;
    if ( $('#jenis_sertifikasi').val() === '' ){
    	isValid = false;
    }

    if ( $('#bukti').val() === '' ){
    	isValid = false;
    }
       
	  if (!isValid) {
	  	document.getElementById("message").textContent="Pastikan semua data terisi lengkap !!";
	  }
	}

	$('#registrasiform').submit(function(){
		$('#buttonsubmitbaru').prop('disabled',true);
	});
</script>
@endsection