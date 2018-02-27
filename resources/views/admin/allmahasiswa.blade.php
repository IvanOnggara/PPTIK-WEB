@extends('templates.layoutadmin')

@section('content')
<div class="right_col" role="main">
		  

		  <div class="">		
			<div class="clearfix">
				
			</div>
			<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Semua Mahasiswa <small>(yang pernah mendaftar)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    Action :
                    </p>
                    <a href="allmahasiswa"><button class="btn btn-success">Reload Halaman</button></a>
                    <table id="datatableme" class="table table-striped table-bordered bold">
                      <thead>
                        <tr>
	                        <th>Nama</th>
                        	<th>NIM</th>
	                        <th>Status MTA</th>
	                        <th>Status MOS</th>
	                        <th>Status SCM</th>
	                        <th>Status MTCNA</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php $loop=1 ?>
                      @foreach($mahasiswa as $mhs)
                        <tr>
                          <td>{{$mhs->nama}}</td>
                          <td>{{$mhs->nim}}</td>
                          
                          @if($mhs->status_mta == 'active' || $mhs->status_mta == 'lulus' || $mhs->status_mta == 'active-jadwal')
                          <td class="green">{{$mhs->status_mta}}</td>
                          @elseif($mhs->status_mta == 'inactive')
                          <td class="red">{{$mhs->status_mta}}</td>
                          @elseif($mhs->status_mta == 'waiting')
                          <td class="orange">{{$mhs->status_mta}}</td>
                          @endif
                          
                          @if($mhs->status_mos == 'active' || $mhs->status_mos == 'lulus' || $mhs->status_mos == 'active-jadwal')
                          <td class="green">{{$mhs->status_mos}}</td>
                          @elseif($mhs->status_mos == 'inactive')
                          <td class="red">{{$mhs->status_mos}}</td>
                          @elseif($mhs->status_mos == 'waiting')
                          <td class="orange">{{$mhs->status_mos}}</td>
                          @endif

                          @if($mhs->status_scm == 'active' || $mhs->status_scm == 'lulus' || $mhs->status_scm == 'active-jadwal')
                          <td class="green">{{$mhs->status_scm}}</td>
                          @elseif($mhs->status_scm == 'inactive')
                          <td class="red">{{$mhs->status_scm}}</td>
                          @elseif($mhs->status_scm == 'waiting')
                          <td class="orange">{{$mhs->status_scm}}</td>
                          @endif

                          @if($mhs->status_mtcna == 'active' || $mhs->status_mtcna == 'lulus' || $mhs->status_mtcna == 'active-jadwal')
                          <td class="green">{{$mhs->status_mtcna}}</td>
                          @elseif($mhs->status_mtcna == 'inactive')
                          <td class="red">{{$mhs->status_mtcna}}</td>
                          @elseif($mhs->status_mtcna == 'waiting')
                          <td class="orange">{{$mhs->status_mtcna}}</td>
                          @endif

                          <td>
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target={{"#modaledit".$loop}} >Edit Nama</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target={{"#modalreset".$loop}} >Reset Password</button>
                          </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id={{"modaledit".$loop}} role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Data Edit</h4>
                               
                              </div>
                              <div class="modal-body">
                                <h4>Nama lama : {{$mhs->nama}}</h4>
                                <label >Nama Baru : </label>
                                <input type="text" id={{"namabaru".$loop}} class="form-control" placeholder="" name="namabaru" required="" value="{{$mhs->nama}}">
                                <p id={{"message".$loop}}></p>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success" onclick={{"saveNama(".$loop.",".$mhs->nim.")"}}>Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        <!--modal-->

                        <!-- Modal -->
                        <div class="modal fade" id={{"modalreset".$loop}} role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfirmasi Reset Password</h4>
                               
                              </div>
                                <div class="modal-body">
                                <h4>Apakah anda yakin akan melakukan reset password pada</h4>
                                <p>Nama : {{$mhs->nama}}</p>
                                <p>NIM : {{$mhs->nim}}</p>
                                <input type="hidden" name="nama" value="{{$mhs->nama}}">
                                <input type="hidden" name="nim" value="{{$mhs->nim}}">

                                <p id={{"newpass".$loop}}></p>
                                <div id={{"password".$loop}}>
                                  
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning" onclick={{"resetPass(".$loop.",".$mhs->nim.")"}}>Submit</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              
                            </div>
                            
                          </div>
                        </div>
                        <!--modal-->
                        <?php $loop++; ?>
                      @endforeach
                      </tbody>
                      <p style="font-size: ;font-weight: bold;"></p>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">    
      <div class="clearfix">
        
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Mahasiswa yang masih aktif </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-keytable" class="table table-striped table-bordered bold">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>NIM</th>
                          <th>Status MTA</th>
                          <th>Status MOS</th>
                          <th>Status SCM</th>
                          <th>Status MTCNA</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($mahasiswa as $mhs)
                      @if($mhs->status_mta == 'inactive' && $mhs->status_mos == 'inactive' && $mhs->status_scm == 'inactive' && $mhs->status_mtcna == 'inactive')

                      @else
                        <tr>
                          <td>{{$mhs->nama}}</td>
                          <td>{{$mhs->nim}}</td>

                          @if($mhs->status_mta == 'active' || $mhs->status_mta == 'lulus')
                          <td class="green">{{$mhs->status_mta}}</td>
                          @elseif($mhs->status_mta == 'inactive')
                          <td class="red">{{$mhs->status_mta}}</td>
                          @elseif($mhs->status_mta == 'waiting')
                          <td class="orange">{{$mhs->status_mta}}</td>
                          @endif
                          
                          @if($mhs->status_mos == 'active' || $mhs->status_mos == 'lulus')
                          <td class="green">{{$mhs->status_mos}}</td>
                          @elseif($mhs->status_mos == 'inactive')
                          <td class="red">{{$mhs->status_mos}}</td>
                          @elseif($mhs->status_mos == 'waiting')
                          <td class="orange">{{$mhs->status_mos}}</td>
                          @endif

                          @if($mhs->status_scm == 'active' || $mhs->status_scm == 'lulus')
                          <td class="green">{{$mhs->status_scm}}</td>
                          @elseif($mhs->status_scm == 'inactive')
                          <td class="red">{{$mhs->status_scm}}</td>
                          @elseif($mhs->status_scm == 'waiting')
                          <td class="orange">{{$mhs->status_scm}}</td>
                          @endif

                          @if($mhs->status_mtcna == 'active' || $mhs->status_mtcna == 'lulus')
                          <td class="green">{{$mhs->status_mtcna}}</td>
                          @elseif($mhs->status_mtcna == 'inactive')
                          <td class="red">{{$mhs->status_mtcna}}</td>
                          @elseif($mhs->status_mtcna == 'waiting')
                          <td class="orange">{{$mhs->status_mtcna}}</td>
                          @endif
                        </tr>
                        @endif
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script type="text/javascript">
var c = $('#datatableme').dataTable();

	function saveNama(loop,nim) {
    var namabaru = document.getElementById("namabaru"+loop).value;
    var xhttp;
      if (namabaru == '') { 
        
        document.getElementById("message"+loop).innerHTML = 'error';
        return;
      }

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("message"+loop).innerHTML = this.responseText;
          location.reload();
          alert('nama berhasil dirubah!');

        }
      };

      xhttp.open("GET", "savename?nama="+namabaru+"&nim="+nim, true);
      xhttp.send();
  }

  function resetPass(loop,nim) {
    var xhttp;

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("newpass"+loop).innerHTML = 'password baru user : ';
          document.getElementById("password"+loop).innerHTML = "<h3 class='text-center' style='color: orange;font-weight: bold;'>"+this.responseText+"</h3>";
        }
      };

      xhttp.open("GET", "resetpassworduser?nim="+nim, true);
      xhttp.send();
  }
</script>
@endsection