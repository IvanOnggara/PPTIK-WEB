@extends('templates.layoutadmin')

@section('content')
<div class="right_col" role="main">
  	<div class="">
	
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-success" onclick="showModalAddAdmin()"><span class="fa fa-plus"></span> Tambah Admin</button>
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
					<h2>List Admin PPTIK</h2>
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
				  						<th>Privilages</th>
				  						<th>Status</th>
				  						<th>Action</th>
				  					</tr>
				  				</thead>
				  				<tbody>
				  				@foreach($array['admin'] as $peradmin)

				  					<tr>
				  						<td>{{$peradmin->admin_id}}</td>
				  						<td>{{$peradmin->nama}}</td>

				  						@if($peradmin->otoritas == 1)
				  						<td>Admin Utama</td>
				  						@else
				  						<td>Admin Keuangan</td>
				  						@endif

				  						@if($peradmin->status == 'active')
				  						<td class="green">{{ucwords($peradmin->status)}}</td>
				  						@else
				  						<td class="red">{{ucwords($peradmin->status)}}</td>
				  						@endif
				  						<input type="hidden" id="{{'hidden'.$peradmin->admin_id}}" value="{{$peradmin->nama}}">
				  						<td>
				  							@if($peradmin->status == 'active')
				  							<button class="btn btn-xs btn-danger" onclick="{{"setStatus($peradmin->admin_id)"}}">Set to Inactive</button>
				  							@else
				  							<button class="btn btn-xs btn-success" onclick="{{"setStatus($peradmin->admin_id)"}}">Set to Active</button>
				  							@endif

				  							<button class="btn btn-xs btn-primary" onclick={{"showModalEditAdmin($peradmin->admin_id)"}}>Edit</button>

				  							<button class="btn btn-xs btn-warning" onclick={{"showModalResetAdmin($peradmin->admin_id)"}}>Reset Password</button>

				  							
				  						</td>
				  					</tr>
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
			<div class="modal fade" id="modaladdadmin" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-green">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Add Admin</h4>
			        	</div> 
			        	<form action="addadmin" method="post" id="formadd">
			        		{{csrf_field()}}
			        	<div class="modal-body" id="bodyadd">
				        	<div class="row">
				        		<div class="col-md-6 col-md-offset-3">
				        			<label>NIP :</label>
				        			<input class="form-control" type="text" name="nip" required="" id="nip"><br>
				        			<label>Nama :</label>
				        			<input type="text" name="nama" required="" class="form-control" id="nama"><br>
				        			<label>Privilages : </label>
				        			<select class="form-control" required="" name="otoritas">
			                            <option value="1" selected="">Admin Utama</option>
			                            <option value="2">Admin Keuangan</option>
			                        </select><br>
			                        <label>Password : </label>
			                        <input type="password" name="password" required="" class="form-control" id="password"><br>
			                        <label>Konfirmasi Password : </label>
			                        <input type="password" name="password2" required="" class="form-control" id="konfpass"><br>
			                        <label>Status : </label>
				        			<select class="form-control" required="" name="status">
			                            <option value="active" selected="">Active</option>
			                            <option value="inactive">Inactive</option>
			                        </select><br>
				        		</div>
				        		
				        	</div>
				        	<br>
				        	
				        	<p class="text-center red bold" id="erroradd"></p>
			            </div>
			            </form>
				        <div class="modal-footer">
				        	<button class="btn btn-success" onclick="submitAddAdmin()">Submit</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			        	
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

  	<!-- Modal -->
			<div class="modal fade" id="modaleditadmin" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-blue">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Edit Admin</h4>
			        	</div>
			        	<div class="modal-body" id="bodyedit">
				        	

			            </div>
				        <div class="modal-footer" id="footeredit">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="submitEditAdmin()">Submit</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

			  <!-- Modal -->
			<div class="modal fade" id="modalresetadmin" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-orange">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Reset Password Admin</h4>
			        	</div>
			        	<div class="modal-body" id="bodyreset">
				        	

			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="submitResetPassword()">Submit</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal"  data-dismiss="modal">Close</button>
				        </div>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->
@endsection

@section('footer_script')
	<script type="text/javascript">

    	$('#tableData').dataTable();

		function showModalEditAdmin(id){
    		$('#modaleditadmin').modal('show');

		    var alldata = {!!$array['adminjson']!!}

    		for (var i = alldata.length - 1; i >= 0; i--) {
    			if (alldata[i].admin_id == id) {
    				var nama = alldata[i].nama;
    				var nip = alldata[i].admin_id;
    				var otoritas = alldata[i].otoritas;
    			}
    		}

    		if (otoritas == 1) {
    			$('#bodyedit').html('<div class="row"><div class="col-md-6 col-md-offset-3"><label>NIP :</label><input class="form-control" type="text" name="nip" required="" id="nipbaru" value="'+nip+'"><br><label>Nama :</label><input type="text" name="nama" required="" class="form-control" id="namabaru" value="'+nama+'"><br><label>Privilages : </label><select class="form-control" required="" name="otoritas" id="otoritasbaru"><option value="1" selected="">Admin Utama</option><option value="2">Admin Keuangan</option></select><br></div></div><input type="hidden" value="'+nip+'" id="idedit1"><br><p class="text-center red bold" id="erroredit"></p>');
    		}else if (otoritas == 2) {
    			$('#bodyedit').html('<div class="row"><div class="col-md-6 col-md-offset-3"><label>NIP :</label><input class="form-control" type="text" name="nip" required="" id="nipbaru" value="'+nip+'"><br><label>Nama :</label><input type="text" name="nama" required="" class="form-control" id="namabaru" value="'+nama+'"><br><label>Privilages : </label><select class="form-control" required="" name="otoritas" id="otoritasbaru"><option value="1" >Admin Utama</option><option value="2" selected="">Admin Keuangan</option></select><br></div></div><input type="hidden" value="'+nip+'" id="idedit1"><br><p class="text-center red bold" id="erroredit"></p>');
    		}
    	}


    	function submitEditAdmin(){
    		var alldata = {!!$array['adminjson']!!}

    		var nipbaru = $('#nipbaru').val();
    		var namabaru = $('#namabaru').val();
    		var otoritasbaru = $('#otoritasbaru').val();
    		var niplama = $('#idedit1').val();

    		for (var i = alldata.length - 1; i >= 0; i--) {
    			if (alldata[i].admin_id == nipbaru && nipbaru != niplama) {
    				$('#erroredit').html('NIP yang dimasukkan telah ada dalam database!!');
    				return;
    			}
    		}

    		if (nipbaru == '') {
    			$('#erroredit').html('Isikan NIP pada kolom NIP!');
    			return;
    		}

    		if (namabaru == '') {
    			$('#erroredit').html('Isi kolom Nama!');
    			return;
    		}

    		$.ajax({
    			url: "editadmin",
				type: "GET",
				data:{
					nipbaru : nipbaru,
					namabaru : namabaru,
					otoritasbaru : otoritasbaru,
					niplama : niplama
				},
				success: function(result){
	            	location.reload();
	        	}
    		});

    	}

    	function showModalAddAdmin(id){
    		$('#modaladdadmin').modal('show');
    	}

    	function showModalResetAdmin(id){

    		var alldata = {!!$array['adminjson']!!}

    		for (var i = alldata.length - 1; i >= 0; i--) {
    			if (alldata[i].admin_id == id) {
    				var nama = alldata[i].nama;
    				var nip = alldata[i].admin_id;
    			}
    		}

    		$('#modalresetadmin').modal('show');
    		$('#bodyreset').html('<h4>Apakah anda ingin melakukan reset password pada:</h4><p>NIP : '+nip+'</p><p>Nama : '+nama+'</p><input type="hidden" value="'+nip+'" id="idreset"><br><h3 id="passwordbaruadmin" class="orange text-center bold"></h3>');
    	}


    	function submitResetPassword(){
    		var id = $('#idreset').val();
    		$.ajax({
    			url: "resetpasswordadmin",
				type: "GET",
				data:{
					id : id
				},
				success: function(result){
	            	$('#passwordbaruadmin').html(result);
	        	}
    		});
    	}

    	function submitAddAdmin(){
			var alldata = {!! $array['adminjson'] !!};

			
    		var nip = $('#nip').val();
    		var nama = $('#nama').val();
    		var password = $('#password').val();
    		var konfpass = $('#konfpass').val();
    		
    		for (var i = alldata.length - 1; i >= 0; i--) {
    			if (alldata[i].admin_id == nip) {
    				$('#erroradd').html('NIP yang dimasukkan telah ada dalam database!!');
    				return;
    			}
    		}
    		if (nip == '') {
    			$('#erroradd').html('Isikan NIP Admin dengan Benar!');
    			return;
    		}

    		if (nama == '') {
    			$('#erroradd').html('Isikan Nama Admin dengan Benar!');
    			return;
    		}

    		if (password == ''||konfpass == '') {
    			$('#erroradd').html('Isikan Password dan Konfirmasi Password dengan Benar!');
    			return;
    		}else{
    			if (password == konfpass) {
    				$('#formadd').submit();
    				return;
    			}else{
    				$('#erroradd').html('Password dan Konfirmasi Password harus sama!');
    				return;
    			}
    		}
    	}

    	function setStatus(id){
    		$.ajax({
    			url: "setstatusadmin",
				type: "GET",
				data:{
					id : id
				},
				success: function(result){
	            	location.reload();
	        	}
    		});
    	}
	</script>
@endsection