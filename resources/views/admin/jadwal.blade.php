@extends('templates.layoutadmin')

@section('content')
<div class="right_col" role="main">
	<div class="">
			
		<div class="clearfix">
			
		</div>
		<div class="row">
			
		</div>
		<div class="row">
			<div class="col-md-2 col-sm-12">
				<button class="btn btn-success" data-toggle="modal" data-target="#modaladd"><i class="fa fa-plus"></i> Buat Jadwal Baru</button>

			</div>
			
				
            <!-- Modal -->
			<div class="modal fade" id="modaladd" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Buat Jadwal Baru</h4>
			        	</div>
			        	<div class="modal-body">

			                <form action="savejadwal" method="post">
			                {{csrf_field()}}
			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    Jenis Sertifikasi:
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    Trainer:
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <select id="selectsert" class="form-control" onchange="update(this.value)" required="" name="jenissertifikasi">
		                            <option value="" disabled="" selected="">pilih jenis sertifikasi</option>
		                            <option value="mta">(MTA) Microsoft Technology Associate</option>
		                            <option value="mos">(MOS) Microsoft Office Specialist </option>
		                            <option value="scm">(SCM) Security Compliance Manager </option>
		                            <option value="mtcna">(MTCNA) MikroTik Certified Network Associate </option>
		                        </select>
			                  </div>


			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <select class="form-control" id="selLecture" name="trainer">
		                            
		                        </select>
			                  </div>

			                  <div class="col-md-3 col-sm-12 col-xs-12 form-group">
			                    =======
			                  </div>

		 					<div class="col-md-6 col-sm-12 col-xs-12 form-group text-center">
			                    <b>Hari ke 1</b>
			                  </div>
			                  <div class="col-md-3 col-sm-12 col-xs-12 form-group text-right">
			                    =======
			                  </div>


			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Kelas :</label>
			                    <select class="form-control" required="" name="kelas1">
			                    	<option disabled selected value="">Pilih Kelas</option>
			                    @foreach($array['kelas'] as $a)
		                            <option value="{{$a->id_kelas}}">{{$a->nama_kelas}}</option>
		                        @endforeach
			                  	</select>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Tanggal : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker2'>
			                            <input type='text' class="form-control" required="" name="tanggal1" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Mulai : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker3'>
			                            <input type='text' class="form-control" required="" name="jammulai1" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Akhir : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker4'>
			                            <input type='text' class="form-control" required="" name="jamakhir1" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

							<div class="col-md-3 col-sm-12 col-xs-12 form-group">
			                    =======
			                  </div>

		 					<div class="col-md-6 col-sm-12 col-xs-12 form-group text-center">
			                    <b>Hari ke 2</b>
			                  </div>
			                  <div class="col-md-3 col-sm-12 col-xs-12 form-group text-right">
			                    =======
			                  </div>


			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Kelas :</label>
			                    <select class="form-control" required="" name="kelas2">
		                            <option disabled selected value="">Pilih Kelas</option>
			                    @foreach($array['kelas'] as $a)
		                            <option value="{{$a->id_kelas}}">{{$a->nama_kelas}}</option>
		                        @endforeach
		                        </select>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Tanggal : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker5'>
			                            <input type='text' class="form-control" required=""  name="tanggal2" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Mulai : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker6'>
			                            <input type='text' class="form-control" required="" name="jammulai2"  />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Akhir : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker7'>
			                            <input type='text' class="form-control" required=""  name="jamakhir2" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-3 col-sm-12 col-xs-12 form-group">
			                    =======
			                  </div>

		 					<div class="col-md-6 col-sm-12 col-xs-12 form-group text-center">
			                    <b>Hari ke 3</b>
			                  </div>
			                  <div class="col-md-3 col-sm-12 col-xs-12 form-group text-right">
			                    =======
			                  </div>


			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Kelas :</label>
			                    <select class="form-control" required="" name="kelas3">
		                            <option disabled selected value="">Pilih Kelas</option>
			                    @foreach($array['kelas'] as $a)
		                            <option value="{{$a->id_kelas}}">{{$a->nama_kelas}}</option>
		                        @endforeach
		                        </select>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Tanggal : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker8'>
			                            <input type='text' class="form-control" required="" name="tanggal3" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Mulai : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker9'>
			                            <input type='text' class="form-control" required="" name="jammulai3" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>

			                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
			                    <label>Jam Akhir : </label>
			                    <div class="form-group">
			                        <div class='input-group date' id='myDatepicker10'>
			                            <input type='text' class="form-control" required="" name="jamakhir3" />
			                            <span class="input-group-addon">
			                               <span class="glyphicon glyphicon-calendar"></span>
			                            </span>
			                        </div>
			                    </div>
			                  </div>
			                  <div class="text-center">
			                  		<button type="submit" class="btn btn-success ">Submit</button>
			                  		<button type="reset" class="btn btn-danger ">Reset</button>
			                  </div>
			                  </form>
			                </div>
			                

			        <div class="modal-footer">
			          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			  <!-- divnya modal -->
			  <!--modal-->
	</div>

		
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Jadwal Sertifikasi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped jambo_table bulk_action" id="tabledata">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">ID Jadwal</th>
                            <th class="column-title">Jenis Sertifikasi</th>
                            <th class="column-title">Trainer</th>
                            <th class="column-title">Semester</th>
                            <th class="column-title">Tahun Ajaran</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($array['alljadwal'] as $jadwal)
                          <tr class="">
                            <td class=" ">{{$jadwal->id_jadwal}}</td>
                            <td class=" ">{{$jadwal->jenis_sertifikasi}}</td>
                            <td class=" ">{{$jadwal->nama}}</td>
                            <td class=" ">{{$jadwal->semester}}</td>
                            <td class=" ">{{$jadwal->periode}}</td>
                            @if($jadwal->status == 'active')
                            <td class=" last"><button class="btn btn-success btn-xs" onclick={{"showModalEdit('".$jadwal->id_jadwal."')"}}>Edit Jadwal</button><button class="btn btn-warning btn-xs" onclick={{"showModalPeserta('".$jadwal->id_jadwal."')"}}>Edit Peserta</button><button class="btn btn-success btn-xs" onclick="{{"downloadPDF('".$jadwal->id_jadwal."')"}}"><span class="fa fa-download"></span> PDF Peserta</button>
                            @else
                            <td class=" last"><button class="btn btn-primary btn-xs" onclick="{{"showModalRincian('".$jadwal->id_jadwal."')"}}">Rincian</button><button class="btn btn-success btn-xs" onclick="{{"downloadPDF('".$jadwal->id_jadwal."')"}}"><span class="fa fa-download"></span> PDF Peserta</button>
                            </td>
                            @endif
                          </tr>
                        @endforeach
                        </tbody>
                      </table>

                  </div>
                </div>
			</div>
	</div>
			
	</div>
</div>

			<!-- Modal -->
			<div class="modal fade" id="modaledit" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-green">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Edit Jadwal Ujian</h4>
			        	</div>
			        	<div class="modal-body" id="bodyedit">
			        	

			            </div>
			                  		
				        <div class="modal-footer">
				        		<p class="red bold" id="pesanerror"></p>
				        	<button type="submit" class="btn btn-success " onclick="editJadwal()">Save</button>

				          	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

			  <!-- Modal -->
			<div class="modal fade " id="modalpeserta" role="dialog">
			    <div class="modal-dialog modal-lg">
			     
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-orange">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Edit Peserta Ujian</h4>
			        	</div>
			        	<div class="modal-body" id="bodypeserta">
			        		
			        		
			            </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

			  <!-- Modal -->
			<div class="modal fade" id="modalrincian" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-primary">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Rincian Jadwal</h4>
			        	</div>
			        	<div class="modal-body" id="bodyrincian">
				        	

			            </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

			  
@endsection
@section('footer_script')
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>

<script>
    var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = d.getFullYear() + '/' +
	    (month<10 ? '0' : '') + month + '/' +
	    (day<10 ? '0' : '') + day;


	$('#tabledata').dataTable({
        "order": [[ 0, "desc" ]]
    });
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY/MM/DD',
        useCurrent: false
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });
    
    $('#myDatepicker4').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });

    $('#myDatepicker5').datetimepicker({
        format: 'YYYY/MM/DD',
        useCurrent: false
    });
    
    $('#myDatepicker6').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });
    
    $('#myDatepicker7').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });

    $('#myDatepicker8').datetimepicker({
        format: 'YYYY/MM/DD',
        useCurrent: false
    });
    
    $('#myDatepicker9').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });
    
    $('#myDatepicker10').datetimepicker({
        format: 'HH:mm',
        useCurrent: false
    });



    $("#myDatepicker3").on("dp.change", function(e) {
        $('#myDatepicker4').data("DateTimePicker").minDate(e.date);
    });

    $("#myDatepicker4").on("dp.change", function(e) {
        $('#myDatepicker3').data("DateTimePicker").maxDate(e.date);
    });

    $("#myDatepicker6").on("dp.change", function(e) {
        $('#myDatepicker7').data("DateTimePicker").minDate(e.date);
    });

    $("#myDatepicker7").on("dp.change", function(e) {
        $('#myDatepicker6').data("DateTimePicker").maxDate(e.date);
    });

    $("#myDatepicker9").on("dp.change", function(e) {
        $('#myDatepicker10').data("DateTimePicker").minDate(e.date);
    });

    $("#myDatepicker10").on("dp.change", function(e) {
        $('#myDatepicker9').data("DateTimePicker").maxDate(e.date);
    });
      
	$('#myDatepicker2').data("DateTimePicker").minDate(output);
  	$('#myDatepicker5').data("DateTimePicker").minDate(output);
    $('#myDatepicker8').data("DateTimePicker").minDate(output);


    $("#myDatepicker2").on("dp.change", function(e) {
        $('#myDatepicker5').data("DateTimePicker").minDate(moment(e.date).add('days',+1));
        $('#myDatepicker8').data("DateTimePicker").minDate(moment(e.date).add('days',+2));
    });
    
    $("#myDatepicker5").on("dp.change", function(e) {
        $('#myDatepicker2').data("DateTimePicker").maxDate(moment(e.date).add('days',-1));
        $('#myDatepicker8').data("DateTimePicker").minDate(moment(e.date).add('days',+1));
    });

    $("#myDatepicker8").on("dp.change", function(e) {
        $('#myDatepicker5').data("DateTimePicker").maxDate(moment(e.date).add('days',-1));
        $('#myDatepicker2').data("DateTimePicker").maxDate(moment(e.date).add('days',-2));
    });

    function update(str) {
	  var xhttp;
	  if (str == 'pilih jenis sertifikasi') { 
	    document.getElementById("selLecture").innerHTML = "<option></option>";
	    return;
	  }

	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      document.getElementById("selLecture").innerHTML = this.responseText;
	    }
	  };
	  xhttp.open("GET", "trainer?q="+str, true);
	  xhttp.send();
	}

	function showModalEdit(id){
		console.log(id);
		$.ajax({
			url: "editjadwal?id="+id,
			type: "GET",
			success: function(result){

				var d = new Date();

				var month = d.getMonth()+1;
				var day = d.getDate();

				var output = d.getFullYear() + '/' +
				    (month<10 ? '0' : '') + month + '/' +
				    (day<10 ? '0' : '') + day;

            	$("#bodyedit").html(result);
            	$('#modaledit').modal('show');
            	$('#tanggaledit1').datetimepicker({
			        format: 'YYYY/MM/DD',
			        useCurrent: false
			    });

			    $('#tanggaledit2').datetimepicker({
			        format: 'YYYY/MM/DD',
			        useCurrent: false
			    });

			    $('#tanggaledit3').datetimepicker({
			        format: 'YYYY/MM/DD',
			        useCurrent: false
			    });

			    $('#jamawal1').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $('#jamakhir1').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $('#jamawal2').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $('#jamakhir2').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $('#jamawal3').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $('#jamakhir3').datetimepicker({
			        format: 'HH:mm',
			        useCurrent: false
			    });

			    $("#tanggaledit1").on("dp.change", function(e) {
			        $('#tanggaledit2').data("DateTimePicker").minDate(moment(e.date).add(+1,'days'));
			        $('#tanggaledit3').data("DateTimePicker").minDate(moment(e.date).add(+2,'days'));
			    });

			    $("#tanggaledit2").on("dp.change", function(e) {
			        $('#tanggaledit1').data("DateTimePicker").maxDate(moment(e.date).add(-1,'days'));
			        $('#tanggaledit3').data("DateTimePicker").minDate(moment(e.date).add(+1,'days'));
			    });

			    $("#tanggaledit3").on("dp.change", function(e) {
			        $('#tanggaledit1').data("DateTimePicker").maxDate(moment(e.date).add(-2,'days'));
			        $('#tanggaledit2').data("DateTimePicker").maxDate(moment(e.date).add(-1,'days'));
			    });

			    $('#tanggaledit1').data("DateTimePicker").minDate(output);
			    $('#tanggaledit1').data("DateTimePicker").maxDate(moment($('#tanggaledit2').data("date")).add(-1,'days'));

			  	$('#tanggaledit2').data("DateTimePicker").minDate(moment($('#tanggaledit1').data("date")).add(+1,'days'));
			  	$('#tanggaledit2').data("DateTimePicker").maxDate(moment($('#tanggaledit3').data("date")).add(-1,'days'));

			    $('#tanggaledit3').data("DateTimePicker").minDate(moment($('#tanggaledit2').data("date")).add(+1,'days'));



			    $("#jamawal1").on("dp.change", function(e) {
			        $('#jamakhir1').data("DateTimePicker").minDate(e.date);
			    });

			    $("#jamakhir1").on("dp.change", function(e) {
			        $('#jamawal1').data("DateTimePicker").maxDate(e.date);
			    });

			    $("#jamawal2").on("dp.change", function(e) {
			        $('#jamakhir1').data("DateTimePicker").minDate(e.date);
			    });

			    $("#jamakhir2").on("dp.change", function(e) {
			        $('#jamawal1').data("DateTimePicker").maxDate(e.date);
			    });

			    $("#jamawal3").on("dp.change", function(e) {
			        $('#jamakhir1').data("DateTimePicker").minDate(e.date);
			    });

			    $("#jamakhir3").on("dp.change", function(e) {
			        $('#jamawal1').data("DateTimePicker").maxDate(e.date);
			    });

			    $("#jamawal1").data("DateTimePicker").maxDate($("#jamakhir1").data("date"));
			    $("#jamakhir1").data("DateTimePicker").minDate($("#jamawal1").data("date"));

			    $("#jamawal2").data("DateTimePicker").maxDate($("#jamakhir2").data("date"));
			    $("#jamakhir2").data("DateTimePicker").minDate($("#jamawal2").data("date"));

			    $("#jamawal3").data("DateTimePicker").maxDate($("#jamakhir3").data("date"));
			    $("#jamakhir3").data("DateTimePicker").minDate($("#jamawal3").data("date"));
        	}
    	});
		
	}

	function showModalPeserta(id){
		$.ajax({
			url: "getpeserta",
			type: "GET",
			data:{
				id : id
			},
			success: function(result){
            	$("#bodypeserta").html(result);
            	$('#modalpeserta').modal('show');
            	$('#datatablepeserta').dataTable({
            		"paging":   false,
			        "ordering": false,
			        "info":     false,
			        "dom":'t',
            	});
            	$("#searchform").keyup(function() {
				   $('#datatablepeserta').dataTable().fnFilter(this.value);
				});
				// $('[data-toggle="tooltip"]').tooltip({
			 //        container: 'body'
			 //    }); 
        	}
    	});
		
	}

	function showModalRincian(id){
		$.ajax({
			url: "getrincian?id="+id,
			type: "GET",
			success: function(result){
            	$("#bodyrincian").html(result);
            	$('#modalrincian').modal('show');
        	}
    	});

		
	}

	function editJadwal(){
		var tanggal1 = document.getElementById('tanggal1').value;
		var jamawal1 = document.getElementById('jamaw1').value;
		var jamakhir1 = document.getElementById('jamak1').value;

		var tanggal2 = document.getElementById('tanggal2').value;
		var jamawal2 = document.getElementById('jamaw2').value;
		var jamakhir2 = document.getElementById('jamak2').value;

		var tanggal3 = document.getElementById('tanggal3').value;
		var jamawal3 = document.getElementById('jamaw3').value;
		var jamakhir3 = document.getElementById('jamak3').value;

		var kelas1 = document.getElementById('kelas1').value;
		var kelas2 = document.getElementById('kelas2').value;
		var kelas3 = document.getElementById('kelas3').value;

		var trainer = document.getElementById('newtrainer').value;

		var id = document.getElementById('ideditjadwal').value;
		
		if (tanggal1 == '' || jamawal1 == '' || jamakhir1 == '' || tanggal2 == '' || jamawal2 == '' || jamakhir2 == '' || tanggal3 == '' || jamawal3 == '' || jamakhir3 == '') {

			if (tanggal1 == '' || jamawal1 == '' || jamakhir1 == '') {
				$("#pesanhari1").html("Error Pada Inputan hari 1");
			}

			if (tanggal2 == '' || jamawal2 == '' || jamakhir2 == '') {
				$("#pesanhari2").html("Error Pada Inputan hari 2");
				
			}

			if (tanggal3 == '' || jamawal3 == '' || jamakhir3 == '') {
				$("#pesanhari3").html("Error Pada Inputan hari 3");
				
			}
			$("#pesanerror").html("Cek Kembali Semua Input yang diminta");
			return;
		}

		$.ajax({
			url: "updatejadwal",
			type: "GET",
			data: {tanggal1: tanggal1,jamawal1: jamawal1,jamakhir1: jamakhir1,tanggal2: tanggal2,jamawal2: jamawal2,jamakhir2: jamakhir2,tanggal3: tanggal3,jamawal3: jamawal3,jamakhir3: jamakhir3,trainer: trainer,kelas1: kelas1,kelas2: kelas2,kelas3: kelas3,id: id},
			success: function(result){
            	alert('Update Jadwal Telah Tersimpan!');
            	location.reload();
        	}
    	});

	}

	function addpeserta(nim){
		var id = document.getElementById('idjadwal').value;
		

		$.ajax({
			url: "addpesertajadwal",
			type: "GET",
			data: {id: id,nim: nim},
			success: function(result){
            	showModalPeserta(id);
        	}
		});
	}

	function deletepeserta(nim){
		var id = document.getElementById('idjadwal').value;

		$.ajax({
			url: "deletepesertajadwal",
			type: "GET",
			data: {id: id,nim: nim},
			success: function(result){
            	showModalPeserta(id);
        	}
		});
	}

	function downloadPDF(idjadwal){
		$.ajax({
			url: "getpesertajadwal?id="+idjadwal,
			type: "GET",
			success: function(result){
            	var columns = ["NIM", "Nama", "Nilai"];
				var rows = [];
				var peserta = jQuery.parseJSON(result.peserta);
				var jadwal = jQuery.parseJSON(result.jadwal);
				console.log(jadwal);

				$.each(peserta,function(i,item){
					rows.push([item.nim,item.nama,""]);
				});

            	var doc = new jsPDF('portrait');
            	
            	doc.setFontSize(20);
            	doc.text('Daftar Nilai Peserta Ujian',105, 15, 'center');

            	doc.setFontSize(12);
            	doc.text(20,35,'Jenis Sertifikasi : '+jadwal.jenis_sertifikasi);
            	doc.text(20,46,'Tanggal Ujian : '+jadwal.tanggal_3);
            	doc.text(20,57,'Trainer : '+jadwal.nama);

            	doc.autoTable(columns, rows,{
            		theme: 'grid',
            		startY: 70,
            		styles:{
            			fontSize: 12,
            		}

            	});

            	doc.save('Peserta '+jadwal.jenis_sertifikasi+' '+jadwal.tanggal_3+'.pdf');
			}
        })      	
	}
	
</script>
@endsection