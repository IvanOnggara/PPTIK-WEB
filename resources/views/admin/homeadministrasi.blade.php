@extends('templates.layoutadmin2')

@section('content')
<div class="right_col" role="main">



      <div class="">
			
			<div class="clearfix"></div>

			<div class="row">

			  <div class="col-md-12 col-sm-12 col-xs-12">
			  	<div class="x_panel">
                  <div class="x_title">
                    <h2>Pengajuan Sertifikasi Mahasiswa</h2>
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
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">
                            List pengajuan mahasiswa yang belum disetujui
                          </p>

                          <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Sertifikasi</th>
                                <th>Pengambilan Ke</th>
                                <th>File Bukti</th>
                                <th>Action</th>
                              </tr>
                            </thead>

							
                            <tbody>
                            	<?php $loop = 1; ?>
                            	
                              @foreach($array['bukti'] as $data1)
                              
                              <tr>
                                <td>{{$data1->nim}}</td>
                                <td>{{$data1->nama}}</td>
                                <td>{{$data1->nama_sertifikasi}}</td>
                                <td>{{$data1->pengambilan_ke}}</td>
                                <td><a href="" data-toggle="modal" data-target={{"#modalbukti".$loop}} style="color: blue; border-bottom: 1px solid blue;">bukti</a></td>
                                <td>
                                <form action="accRequest" method="post" id={{"formRequestAcc".$loop}}>
                                {{csrf_field()}}
                                	<input type="hidden" name="id" value="{{$data1->id_bukti}}">
                                	<input type="hidden" name="decision" value="true">
                              	</form>

								                <form action="accRequest" method="post" id={{"formRequestDec".$loop}}>
                                {{csrf_field()}}
                                	<input type="hidden" name="id" value="{{$data1->id_bukti}}">
                                	<input type="hidden" name="decision" value="false">
                                	
                              	</form> 
                              	<button class="btn btn-success btn-xs" onclick={{"submitFormAcc(".$loop.")"}} >Submit</button>
                              	<button class="btn btn-danger btn-xs" onclick={{"submitFormDec(".$loop.")"}}>Decline</button>                             	
                              	</td>
                              </tr>

                              <!-- Modal -->
							  <div class="modal fade" id={{"modalbukti".$loop}} role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">File Bukti</h4>
							         
							        </div>
							        <div class="modal-body">

							        	<img src="{{asset('data/bukti/'.$data1->bukti.'')}}" alt="gambar" width="100%">
							          	<p>Nama File : {{$data1->bukti}}</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							      
							    </div>
							  </div>
							  <!--modal-->
							  <?php $loop++ ?>

                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
			</div>
		</div>










    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
                  <div class="x_title">
                    <h2>Pengajuan Sertifikasi Mahasiswa</h2>
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
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">
                            List <b>Seluruh</b> pengajuan mahasiswa
                          </p>

                          <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Sertifikasi</th>
                                <th>Pengambilan Ke</th>
                                <th>File Bukti</th>
                                <th>Action</th>
                              </tr>
                            </thead>

              
                            <tbody>
                              <?php $count = 1; ?>
                              @foreach($array['allbukti'] as $data2)
                              
                              <tr>
                                <td>{{$data2->nim}}</td>
                                <td>{{$data2->nama}}</td>
                                <td>{{$data2->nama_sertifikasi}}</td>
                                <td>{{$data2->pengambilan_ke}}</td>
                                <td><a href="" data-toggle="modal" data-target={{"#modalbuktiview".$count}} style="color: blue; border-bottom: 1px solid blue;">bukti</a></td>
                                <td class="{{$data2->style}}">{{$data2->nama_status}}</td>
                              </tr>

                              <!-- Modal -->
                <div class="modal fade" id={{"modalbuktiview".$count}} role="dialog">
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">File Bukti</h4>
                       
                      </div>
                      <div class="modal-body">

                        <img src="{{asset('data/bukti/'.$data2->bukti.'')}}" alt="gambar" width="100%">
                          <p>Nama File : {{$data2->bukti}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <!--modal-->
                <?php $count++ ?>

                              @endforeach

                            </tbody>
                          </table>
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
<script type="text/javascript">
	function submitFormAcc(number) {
		var id = "formRequestAcc" + number;
		var form = document.getElementById(id);
    	form.submit();
	}

	function submitFormDec(number) {
		var id ="formRequestDec" + number;
		var form = document.getElementById(id);
    	form.submit();
	}


</script>
@endsection