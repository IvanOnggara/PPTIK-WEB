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
				<button class="btn btn-success" onclick="showModalAdd()"><span class="fa fa-plus"></span> Tambah Kelas</button>
				@if(session('status'))
	        		@if(session('status')=='sukses')
	        			<p class="green bold">Data Berhasil Disimpan</p>
	        		@else
	        			<p class="red bold">Data Gagal Disimpan</p>
	        		@endif
				@endif
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Daftar List Kelas (Ruang Ujian) </h2>
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
				  						<th width="65%">Nama Kelas</th>
				  						<th width="20%">Status</th>
				  						<th width="5%">Switch</th>
				  						<th width="10%">Action</th>
				  					</tr>
				  				</thead>
				  				<tbody>
				  				@foreach($array['kelas'] as $perkelas)

				  					<tr>
				  						<td>{{$perkelas->nama_kelas}}</td>

				  						@if($perkelas->status == 'active')
				  						
				  						<td class="green">{{ucwords($perkelas->status)}}</td>
				  						@else
				  						<td class="red">{{ucwords($perkelas->status)}}</td>
				  						@endif

				  						<th><input type="checkbox" class="js-switch" id="{{'checkbox'.$perkelas->id_kelas}}" @if($perkelas->status == 'active')checked="true" @endif onchange={{"showModal($perkelas->id_kelas)"}} /></th>
				  						<input type="hidden" id="{{'hidden'.$perkelas->id_kelas}}" value="{{$perkelas->nama_kelas}}">
				  						<td><button class="btn btn-xs btn-success" onclick={{"showModalEditNama($perkelas->id_kelas)"}}>Edit Nama Kelas</button></td>
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
			<div class="modal fade" id="modaleditnama" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-green">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Edit Nama</h4>
			        	</div>
			        	<form action="savenamabaru" method="post">
			        		{{csrf_field()}}
			        	<div class="modal-body" id="bodyeditnama">
			        		

			            </div>
				        <div class="modal-footer">
				        	<button type="submit" class="btn btn-success" id="buttonSubmitEditNama">Save</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
				        </form>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->


			  <!-- Modal -->
			<div class="modal fade" id="modalkelas" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      	<div class="modal-content">
			        	<div class="modal-header bg-blue-sky">
			          		<button type="button" class="close" data-dismiss="modal">&times;</button>
			          		<h4 class="modal-title">Approvement</h4>
			        	</div>
			        	<div class="modal-body" id="bodykelas">
				        	

			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" id="butonSubmitChange" onclick="submitChangeStatusKelas(this.value)">Submit</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" onclick="closeModalKelas(this.value)">Close</button>
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
			          		<h4 class="modal-title">Tambah Kelas</h4>
			        	</div>
			        	<form action="addkelas" method="post">
			        		{{csrf_field()}}
			        	<div class="modal-body" id="bodykelas">
				        	<div class="row">
				        		<div class="col-md-6 col-md-offset-3">
				        			<label>Nama Kelas :</label>
				        			<input class="form-control" type="text" name="namakelasbaru" required=""><br>
				        			<label>Status Kelas :</label>
				        			<select class="form-control" required="" name="statuskelasbaru">
			                            <option value="active" selected="">Active</option>
			                            <option value="inactive">Inactive</option>

			                        </select>
				        		</div>
				        		
				        	</div>
				        	<br>
				        	
				        	
			            </div>
				        <div class="modal-footer">
				        	<button class="btn btn-success" type="submit">Save</button>
				          	<button type="button" class="btn btn-danger" id="buttonCloseModal" data-dismiss="modal">Close</button>
				        </div>
			        	</form>
			      </div>
			      
			    </div>
			</div>
			  <!-- divnya modal -->
			  <!--modal-->

@endsection
@section('footer_script')
<!-- Switchery -->
    <script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
    <script type="text/javascript">

	    $('#tableData').dataTable({
	    	"paging":   false,
	        "info":     false,
	        "dom":'t',
	    });

    	function showModal(id){
    		var namakelas = $('#hidden'+id).val();
    		if ($('#checkbox'+id).prop("checked") == false) {
    			$('#bodykelas').html('<h4>Apakah anda ingin menonaktifan Kelas '+namakelas+' ?</h4> ');

    			$('#butonSubmitChange').val(id);
    			$('#buttonCloseModal').val(id);

    			$('#checkbox'+id).prop("checked",true);

    			$('#modalkelas').modal('show');
    		}else{
    			$('#bodykelas').html('<h4>Apakah anda ingin mengaktifkan Kelas '+namakelas+' ?</h4> ');

    			$('#butonSubmitChange').val(id);
    			$('#buttonCloseModal').val(id);

    			$('#checkbox'+id).prop("checked",false);

    			$('#modalkelas').modal('show');
    		}
    		
    	}

    	function submitChangeStatusKelas(id){
    		$('#modalkelas').modal('hide');
    		$.ajax({
    			url: "changestatuskelas",
				type: "GET",
				data:{
					id : id
				},
				success: function(result){
	            	$('#tableplace').html(result);
	            	$('#tableData').dataTable({
	            		"paging":   false,
				        "info":     false,
				        "dom":'t',
	            	});
	            	if ($(".js-switch")[0]) {
				        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
				        elems.forEach(function (html) {
				            var switchery = new Switchery(html, {
				                color: '#26B99A'
				            });
				        });
				    }
	        	}
    		});
    	}

    	function closeModalKelas(id){
    		if (!$('#modalkelas').hasClass('in')) {
    			if ($('#checkbox'+id).prop("checked") == false) {
    				$('#checkbox'+id).prop("checked", false);
    			}else{
					$('#checkbox'+id).prop("checked", true);
				}
			};

    		$('#modalkelas').modal('hide');
    		
    	}

    	function showModalAdd(){
    		$('#modaladd').modal('show');
    	}


    	function showModalEditNama(id){
    		$('#modaleditnama').modal('show');

    		$.ajax({
    			url: "showmodaleditkelas",
				type: "GET",
				data:{
					id : id,
				},
				success: function(result){
	            	$('#bodyeditnama').html(result);
	        	}
    		});
    	}
    </script>


@endsection