@extends('templates.layoutadmin')

@section('content')
<div class="right_col" role="main">
  	<div class="">
	
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Input dan Edit Nilai Sertifikasi </h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					  <li><a class="close-link"><i class="fa fa-close"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
				  <form method="post" action="savenilai" id="formsavenilai">
				  {{csrf_field()}}
				  	<div class="row">

				  		<div class="col-md-2 col-sm-3 col-xs-4">
				  			<label>Jenis Sertifikasi : </label>
			                <select class="form-control" id="jenisnilai" name="jenissertifikasi" required="required" onchange="showTanggal()">
			                	<option value="" disabled="" selected="">Choose Option</option>
	                            <option value="mta">(MTA) Microsoft Technology Associate</option>
	                            <option value="mos">(MOS) Microsoft Office Specialist </option>
	                            <option value="scm">(SCM) Security Compliance Manager </option>
	                            <option value="mtcna">(MTCNA) MikroTik Certified Network Associate </option>
			                </select>
				  		</div>
				  		<div class="col-md-2 col-sm-3 col-xs-4">
				  			<label>Periode : </label>
			                <select class="form-control" id="periodenilai" name="periode" required="required" onchange="showTanggal()">
			                	<option value="" selected disabled>Choose Option</option>
			                    @foreach($array['periode'] as $period)
		                          <option value="{{$period->periode}}">{{$period->periode}}</option>
		                        @endforeach
			                </select>
				  		</div>
				  		<div class="col-md-2 col-sm-3 col-xs-4">
				  			<label>Semester : </label>
			                <select class="form-control" id="semesternilai" name="semester" required="required" onchange="showTanggal()">
			                	<option value="" selected disabled>Choose Option</option>
			                    <option value="genap">Genap</option>
			                    <option value="ganjil">Ganjil</option>
			                </select>
				  		</div>
				  		<div class="col-md-2 col-sm-3 col-xs-4">
				  			<label>Tanggal <i style="color: red;">*</i> : </label>
			                <select class="form-control" id="tanggalnilai" name="tanggal" required="required" onchange="showList()">
			                	<option value="" selected disabled>Choose Option</option>
			                </select>
				  		</div>
				  	</div>
				  	<br>
					<div id="tab">
						<table  class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Nama</th>
									<th>NIM</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="savebutton">
						
					</div>
					</form>
					@if(session('statusSave') == 'Data sudah berhasil tersimpan')
	                  <p style="color: green;font-weight: bold;">{{session('statusSave')}}</p>
	                @else
	                	<p style="color: red;font-weight: bold;">{{session('statusSave')}}</p>
	                @endif
				  </div>
				</div>
			  </div>
		  </div>
	  </div>
  	</div>
@endsection
@section('footer_script')
<script type="text/javascript">
$('#mydata').dataTable();
	function showTanggal() {
		var jenis = document.getElementById("jenisnilai").value; 
		var periode = document.getElementById("periodenilai").value; 
		var semester = document.getElementById("semesternilai").value;
		var xhttp;
		  if (jenis == '' || periode =='' || semester =='') { 
		    
		  	document.getElementById("tanggalnilai").innerHTML = '<option value="" selected disabled>Choose Option</option>';
		    return;
		  }

		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("tanggalnilai").innerHTML = this.responseText;
		    }
		  };

		  xhttp.open("GET", "tanggalnilai?j="+jenis+"&p="+periode+"&s="+semester, true);
		  xhttp.send();
	}

	function showList() {
		var jenis = document.getElementById("jenisnilai").value; 
		var periode = document.getElementById("periodenilai").value; 
		var semester = document.getElementById("semesternilai").value;
		var tanggal = document.getElementById("tanggalnilai").value;
		var xhttp;
		  if (jenis == '' || periode =='' || semester =='' || tanggal =='') { 
		    
		  	document.getElementById("tab").innerHTML = '<table class="table table-striped table-bordered"><thead><tr><th>Nama</th><th>NIM</th><th>Nilai</th></tr></thead><tbody><tr><td>-</td><td>-</td><td>-</td></tr><tr></tbody></table>';
		    return;
		  }

		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("tab").innerHTML = this.responseText;
		      if (this.responseText.length != 14) {
		      	document.getElementById("savebutton").innerHTML = '<div class="text-right"><button class="btn btn-success" type="submit"><b>Save All</b></button></div>';
		      }else{
		      	document.getElementById('savebutton').innerHTML = '';
		      }
		      
		    }
		  };

		  xhttp.open("GET", "showlistpeserta?j="+jenis+"&p="+periode+"&s="+semester+"&t="+tanggal, true);
		  xhttp.send();
	}
	
</script>
@endsection