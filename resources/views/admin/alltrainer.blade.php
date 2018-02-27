@extends('templates.layoutadmin')
@section('css')
<!-- Switchery -->
    <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="right_col" role="main">
  	<div class="">
	
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-success" onclick="showModalAddTrainer()"><span class="fa fa-plus"></span> Tambah Trainer</button>
				@if(session('status'))
	        		@if(session('status')=='sukses')
	        			<p class="green bold">Admin baru telah ditambahkan</p>
	        		@else
	        			<p class="red bold">Error ! Coba ulangi kembali</p>
	        		@endif
				@endif
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>List Trainer Setifikasi PPTIK</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					  <li><a class="close-link"><i class="fa fa-close"></i></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
				  	<div class="row">
				  		<div class="col-md-12 col-sm-12" id="tableplace">
				  			<table class="table table-striped table-bordered bold" id="tableData">
				  				<thead>
				  					<tr>
				  						<th>NIP</th>
				  						<th>Nama</th>
				  						<th>MTA</th>
				  						<th>MOS</th>
				  						<th>SCM</th>
				  						<th>MTCNA</th>
				  						<th>Status</th>
				  						<th>Action</th>
				  					</tr>
				  				</thead>
				  				<tbody>
				  					<?php $count = 1; ?>
				  				@foreach($array['trainer'] as $pertrainer)

				  					<tr>
				  						<td>{{$pertrainer->nip}}</td>
				  						<td>{{$pertrainer->nama}}</td>
				  						
				  						@if($pertrainer->mta == 1)
				  						<td><input type="checkbox" id="{{'checkboxmta'.$count}}" class="js-switch" checked="true" onchange="approvementModal('mta',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@else
				  						<td><input type="checkbox" id="{{'checkboxmta'.$count}}" class="js-switch" onchange="approvementModal('mta',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@endif

				  						@if($pertrainer->mos == 1)
				  						<td><input type="checkbox" id="{{'checkboxmos'.$count}}"class="js-switch" checked="true" onchange="approvementModal('mos',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@else
				  						<td><input type="checkbox" id="{{'checkboxmos'.$count}}"class="js-switch" onchange="approvementModal('mos',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@endif

				  						@if($pertrainer->scm == 1)
				  						<td><input type="checkbox" id="{{'checkboxscm'.$count}}"class="js-switch" checked="true" onchange="approvementModal('scm',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@else
				  						<td><input type="checkbox" id="{{'checkboxscm'.$count}}"class="js-switch" onchange="approvementModal('scm',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@endif

				  						@if($pertrainer->mtcna == 1)
				  						<td><input type="checkbox" id="{{'checkboxmtcna'.$count}}" class="js-switch" checked="true" onchange="approvementModal('mtcna',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@else
				  						<td><input type="checkbox" id="{{'checkboxmtcna'.$count}}"class="js-switch" onchange="approvementModal('mtcna',{{$count}},'{{$pertrainer->nama}}','{{$pertrainer->nip}}')"></td>
				  						@endif

				  						@if($pertrainer->status == 'active')
				  							<td class="green bold">{{ucwords($pertrainer->status)}}</td>
				  						@else
				  							<td class="red bold">{{ucwords($pertrainer->status)}}</td>
				  						@endif
				  						
				  						@if($pertrainer->status == 'active')
				  						<td>
				  							<button class="btn btn-xs btn-danger" onclick="changeStatusTrainer({{$pertrainer->nip}})">Set to Inactive</button>
				  						</td>
				  						@else
				  						<td>
				  							<button class="btn btn-xs btn-success" onclick="changeStatusTrainer({{$pertrainer->nip}})">Set to Active</button>
				  						</td>
				  						@endif
				  					</tr>
				  					<?php $count++; ?>
				  				@endforeach
				  				</tbody>
				  			</table>
				  			@if(session('statusEditSucc'))
				  				<p class="bold text-center green">{{session('statusEditSucc')}}</p>
				  			@endif

				  			@if(session('statusEditFail'))
				  				<p class="bold text-center red">{{session('statusEditFail')}}</p>
				  			@endif
				  		</div>
				  	</div>
				  	
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
			        	<div class="modal-header bg-primary">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Edit Trainer</h4>
			        	</div>
			        	<div class="modal-body" id="bodyedit">
				        	

			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="submitEdit()">Save</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->


  	<!-- Modal -->
			<div class="modal fade" id="modalapp" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-orange">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Approvement</h4>
			        	</div>
			        	<div class="modal-body" id="bodyapp">
				        	

			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="submitChangeStatus()">Submit</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

			  <!-- Modal -->
			<div class="modal fade" id="modaladd" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-green">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Tambah Trainer</h4>
			        	</div>
			        	<div class="modal-body" id="bodyadd">
				        	<div class="row">
				        		<div class="col-md-offset-3 col-md-6">
				        			<label>NIP : </label>
				        			<input type="text" class="form-control" name="" id="nipbaru"><br>
				        			<label>Nama : </label>
				        			<input type="text" class="form-control" name="" id="namabaru"><br>
				        			<div class="col-md-6">
				        				<label>Status MTA : </label>
				        				<select class="form-control" required="" name="" id="statusmtabaru">
				                            <option value="1" selected="">Yes</option>
				                            <option value="0">No</option>
				                        </select><br>
				        			</div>
				        			<div class="col-md-6">
				        				<label>Status MOS : </label>
				        				<select class="form-control" required="" name="" id="statusmosbaru">
				                            <option value="1" selected="">Yes</option>
				                            <option value="0">No</option>
				                        </select><br>
				        			</div>
				        			<div class="col-md-6">
				        				<label>Status SCM : </label>
				        				<select class="form-control" required="" name="" id="statusscmbaru">
				                            <option value="1" selected="">Yes</option>
				                            <option value="0">No</option>
				                        </select><br>
				        			</div>
				        			<div class="col-md-6">
				        				<label>Status MTCNA : </label>
				        				<select class="form-control" required="" name="" id="statusmtcnabaru">
				                            <option value="1" selected="">Yes</option>
				                            <option value="0">No</option>
				                        </select><br>
				        			</div>
				        			<label>Status Trainer : </label>
			        				<select class="form-control" required="" name="" id="statustrainerbaru">
			                            <option value="active" selected="">Active</option>
			                            <option value="inactive">Inactive</option>
			                        </select><br>
				        		</div>
				        	</div><br>
				        	<p class="text-center red bold" id="erroradd"></p>
			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="saveNewTrainer()">Save</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->
@endsection

@section('footer_script')
<script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
<script type="text/javascript">
	$('#tableData').dataTable();

	function showModalAddTrainer(){
		$('#modaladd').modal('show');
	}

	function approvementModal(jenissert,count,nama,nip){
		var jenissertCap = jenissert.toUpperCase();
		if ($('#checkbox'+jenissert+count).prop("checked") == false) {
			$('#bodyapp').html('<h4>Apakah anda ingin menonaktifan : </h4><p>Jenis Sertifikasi : '+jenissertCap+'</p><p>Nama Trainer : '+nama+'</p><input type="hidden" value="'+nip+'" id="niptrainer"><input type="hidden" value="'+jenissert+'" id="jenissert">');

			$('#checkbox'+jenissert+count).prop("checked",true);

			$('#modalapp').modal('show');
		}else{
			$('#bodyapp').html('<h4>Apakah anda ingin mengaktifkan : </h4><p>Jenis Sertifikasi : '+jenissertCap+'</p><p>Nama Trainer : '+nama+'</p><input type="hidden" value="'+nip+'" id="niptrainer"><input type="hidden" value="'+jenissert+'" id="jenissert">');



			$('#checkbox'+jenissert+count).prop("checked",false);

			$('#modalapp').modal('show');
		}
	}

	function submitChangeStatus(){
		var nip = $('#niptrainer').val();
		var jenissert = $('#jenissert').val();

		$.ajax({
			url: "setstatuspengajar",
			type: "GET",
			data:{
				nip : nip,
				js : jenissert,
			},
			success: function(result){
            	location.reload();
            	window.location.href = window.location.href;
        	}
		});
	}

	function saveNewTrainer(){
		var alltrainer = {!! $array['trainerjson'] !!}
		var nip = $('#nipbaru').val();
		var nama = $('#namabaru').val();
		var statusmta = $('#statusmtabaru').val();
		var statusmos = $('#statusmosbaru').val();
		var statusscm = $('#statusscmbaru').val();
		var statusmtcna = $('#statusmtcnabaru').val();
		var statustrainer = $('#statustrainerbaru').val();

		if (nip == '') {
			$('#erroradd').html('Isikan Kolom NIP dengan benar');
			return;
		}else{
			for (var i = alltrainer.length - 1; i >= 0; i--) {
				if (nip == alltrainer[i].nip) {
					$('#erroradd').html('NIP yang anda masukkan telah terdaftar');
					return;
				}
			}
		}

		if (nama == '') {
			$('#erroradd').html('Isikan Kolom Nama dengan benar');
			return;
		}

		$.ajax({
			url: "addPengajar",
			type: "GET",
			data:{
				nip : nip,
				nama : nama,
				statusmta : statusmta,
				statusmos : statusmos,
				statusscm : statusscm,
				statusmtcna : statusmtcna,
				statustrainer : statustrainer,
			},
			success: function(result){
				location.reload();
        	}
		});
	}

	function changeStatusTrainer(nip){
		$.ajax({
			url: "changestatustrainer",
			type: "GET",
			data:{
				nip : nip,
			},
			success: function(result){
				location.reload();
        	}
		});
	}
</script>
@endsection