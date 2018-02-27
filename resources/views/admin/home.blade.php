@extends('templates.layoutadmin')

@section('content')
<div class="right_col" role="main">
		  <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Peserta MTA Aktif</span>
              <div class="count green" id="mtauser">{{$array['mtaaktif']}}</div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Peserta MOS Aktif</span>
              <div class="count green" id="mosuser">{{$array['mosaktif']}}</div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Peserta SCM Aktif</span>
              <div class="count green" id="scmuser">{{$array['scmaktif']}}</div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Peserta MTCNA Aktif</span>
              <div class="count green" id="mtcnauser">{{$array['mtcnaaktif']}}</div>
            </div>
          </div>
          <!-- /top tiles -->


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
                              	<!-- <button class="btn btn-success btn-xs" onclick={{"submitFormAcc(".$loop.")"}} >Submit</button>
                              	<button class="btn btn-danger btn-xs" onclick={{"submitFormDec(".$loop.")"}}>Decline</button>      -->                        	
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


            <div class="row">

              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Peserta MTA</h2>
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
                    

                    <div class="col-md-4 col-sm-12">
                    <label>Semester : </label>
                      <select class="form-control" id="semestermta" name="semester" required="required" onchange="datapesertamta()">
                        <option value="genap" selected>Genap</option>
                        <option value="ganjil">Ganjil</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                    <label>Periode : </label>
                      <select class="form-control" id="periodemta" name="periode" required="required" onchange="datapesertamta()">

                        @foreach($array['periode'] as $period)
                          <option value="{{$period->periode}}">{{$period->periode}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                      <label>Download PDF : </label>
                      <button class="btn btn-success btn-sm" onclick="downloadPDFMTA()"><i class="fa fa-download"></i> Data Nama Peserta</button>
                    </div>
                  </div>
                  <p id="total_mta"></p>
                  <div id="echart_mta" style="height:400px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Peserta MOS</h2>
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
                    

                    <div class="col-md-4 col-sm-12">
                    <label>Semester : </label>
                      <select class="form-control" id="semestermos" name="semester" required="required" onchange="datapesertamos()">
                        <option value="genap" selected>Genap</option>
                        <option value="ganjil">Ganjil</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                    <label>Periode : </label>
                      <select class="form-control" id="periodemos" name="periode" required="required" onchange="datapesertamos()">

                        @foreach($array['periode'] as $period)
                          <option value="{{$period->periode}}">{{$period->periode}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                      <label>Download PDF : </label>
                      <button class="btn btn-success btn-sm" onclick="downloadPDFMOS()"><i class="fa fa-download"></i> Data Nama Peserta</button>
                    </div>
                  </div>
                  <p id="total_mos"></p>
                  <div id="echart_mos" style="height:400px;"></div>

                  </div>
                </div>
              </div>
            </div>


            <div class="row">

              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Peserta SCM</h2>
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
                    

                    <div class="col-md-4 col-sm-12">
                    <label>Semester : </label>
                      <select class="form-control" id="semesterscm" name="semester" required="required" onchange="datapesertascm()">
                        <option value="genap" selected>Genap</option>
                        <option value="ganjil">Ganjil</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                    <label>Periode : </label>
                      <select class="form-control" id="periodescm" name="periode" required="required" onchange="datapesertascm()">

                        @foreach($array['periode'] as $period)
                          <option value="{{$period->periode}}">{{$period->periode}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                      <label>Download PDF : </label>
                      <button class="btn btn-success btn-sm" onclick="downloadPDFSCM()"><i class="fa fa-download"></i> Data Nama Peserta</button>
                    </div>
                  </div>
                  <p id="total_scm"></p>
                  <div id="echart_scm" style="height:400px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Peserta MTCNA</h2>
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
                    

                    <div class="col-md-4 col-sm-12">
                    <label>Semester : </label>
                      <select class="form-control" id="semestermtcna" name="semester" required="required" onchange="datapesertamtcna()">
                        <option value="genap" selected>Genap</option>
                        <option value="ganjil">Ganjil</option>
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                    <label>Periode : </label>
                      <select class="form-control" id="periodemtcna" name="periode" required="required" onchange="datapesertamtcna()">

                        @foreach($array['periode'] as $period)
                          <option value="{{$period->periode}}">{{$period->periode}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-4 col-sm-12">
                      <label>Download PDF : </label>
                      <button class="btn btn-success btn-sm" onclick="downloadPDFMTCNA()"><i class="fa fa-download"></i> Data Nama Peserta</button>
                    </div>
                  </div>
                  <p id="total_mtcna"></p>
                  <div id="echart_mtcna" style="height:400px;"></div>

                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Kelulusan periode</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                    <div class="col-md-3 col-sm-12">
                    <label>Semester : </label>
                      <select class="form-control" id="semester_" name="semester" required="required" onchange="updatePeriode()">
                        <option value="genap" selected>Genap</option>
                        <option value="ganjil">Ganjil</option>
                      </select>
                    </div>

                    <div class="col-md-3 col-sm-12">
                    <label>Periode : </label>
                      <select class="form-control" id="periode_" name="periode" required="required" onchange="updatePeriode()">

                        @foreach($array['periode'] as $period)
                          <option value="{{$period->periode}}">{{$period->periode}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3 col-sm-12">
                    <label>Prodi : </label>
                      <select class="form-control" id="prodi_" name="periode" required="required" onchange="updatePeriode()">
                        <option value="ALL" selected>Semua Prodi</option>
                        <option value="TIF">Teknik Informatika</option>
                        <option value="SI">Sistem Informasi</option>
                        <option value="KIM">Kimia</option>
                        <option value="FAR">Farmasi</option>
                        <option value="MAN">Manajemen</option>
                        <option value="AKUN">Akuntansi</option>
                        <option value="TI">Teknik Industri</option>
                        <option value="DKV">Desain Komunikasi Visual</option>
                        <option value="PBM">Pendidikan Bahasa Mandarin</option>
                        <option value="ING">Sastra Inggris</option>
                      </select>
                    </div>

                    <div class="col-md-3 col-sm-12">
                      <label>Download PDF : </label>
                    <button class="btn btn-success" onclick="downloadPDF()"><i class="fa fa-download"></i> Data Kelulusan Peserta</button>
                    </div>
                  </div>
                  <div class="row">
                  <br>
                    <div id="mainmain" style="height:400px;"></div>
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
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
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

  function downloadPDFpiechart(result,periode,semester,jenis){
      var columns = ["No", "NIM", "Nama"];
      var rows = [];
      var rows1 = [];
      var rows2 = [];
      var rows3 = [];
      var rows4 = [];
      var rows5 = [];
      var rows6 = [];
      var rows7 = [];
      var rows8 = [];
      var rows9 = [];
      var angka = 0;
      var prodi = "";

      var namaif = jQuery.parseJSON(result.pendaftarif);
      var namasi = jQuery.parseJSON(result.pendaftarsi);
      var namakim = jQuery.parseJSON(result.pendaftarkim);
      var namafar = jQuery.parseJSON(result.pendaftarfar);
      var namaman = jQuery.parseJSON(result.pendaftarman);
      var namaakun = jQuery.parseJSON(result.pendaftarakun);
      var namadkv = jQuery.parseJSON(result.pendaftardkv);
      var namati = jQuery.parseJSON(result.pendaftarti);
      var namamandarin = jQuery.parseJSON(result.pendaftarmandarin);
      var namasasing = jQuery.parseJSON(result.pendaftarsasing);

      $.each(namaif,function(i,item){
        angka = angka+1;
        rows.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namasi,function(i,item){
        angka = angka+1;
        rows1.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namakim,function(i,item){
        angka = angka+1;
        rows2.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namafar,function(i,item){
        angka = angka+1;
        rows3.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namaman,function(i,item){
        angka = angka+1;
        rows4.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namaakun,function(i,item){
        angka = angka+1;
        rows5.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namadkv,function(i,item){
        angka = angka+1;
        rows6.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namati,function(i,item){
        angka = angka+1;
        rows7.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namamandarin,function(i,item){
        angka = angka+1;
        rows8.push([angka,item.nim,item.nama]);
      });
      angka =0;

      $.each(namasasing,function(i,item){
        angka = angka+1;
        rows9.push([angka,item.nim,item.nama]);
      });
      angka =0;

      var doc = new jsPDF('portrait');
      doc.setFontSize(20);
      doc.text('Daftar Peserta Ujian',105, 15, 'center');

      doc.setFontSize(12);
      doc.text(20,35,'Semester : '+semester);
      doc.text(20,46,'Periode : '+periode);
      doc.text(20,57,'Jenis Sertifikasi : '+jenis.toUpperCase());

      if (rows.length>0) {
        doc.text('Program Studi Teknik Informatika',105, 65, 'center');
        doc.autoTable(columns, rows,{
          theme: 'grid',
          startY: 66,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }else{
        var finalY = 50; // The y position on the page
      }

      if (rows1.length>0) {
        doc.text('Program Studi Sistem Informasi',105, finalY+15, 'center');
        doc.autoTable(columns, rows1,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows2.length>0) {
        doc.text('Program Studi Kimia',105, finalY+15, 'center');
        doc.autoTable(columns, rows2,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows3.length>0) {
        doc.text('Program Studi Farmasi',105, finalY+15, 'center');
        doc.autoTable(columns, rows3,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows4.length>0) {
        doc.text('Program Studi Manajemen',105, finalY+15, 'center');
        doc.autoTable(columns, rows4,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows5.length>0) {
        doc.text('Program Studi Akuntansi',105, finalY+15, 'center');
        doc.autoTable(columns, rows5,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows6.length>0) {
        doc.text('Program Studi Desain Komunikasi Visual',105, finalY+15, 'center');
        doc.autoTable(columns, rows6,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows7.length>0) {
        doc.text('Program Studi Teknik Industri',105, finalY+15, 'center');
        doc.autoTable(columns, rows7,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows8.length>0) {
        doc.text('Program Studi Mandarin',105, finalY+15, 'center');
        doc.autoTable(columns, rows8,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }

      if (rows9.length>0) {
        doc.text('Program Studi Sastra Inggris',105, finalY+15, 'center');
        doc.autoTable(columns, rows9,{
          theme: 'grid',
          startY: finalY+16,
          styles:{
            fontSize: 12,
          }

        });

        var finalY = doc.autoTableEndPosY(); // The y position on the page
      }
      doc.save('List Peserta '+jenis.toUpperCase()+' Semester '+semester.toUpperCase()+' '+periode+'.pdf');
  }

  function downloadPDFMTCNA(){
    var e =document.getElementById("periodemtcna");
    var periodemtcna = e.options[e.selectedIndex].value;

    var e =document.getElementById("semestermtcna");
    var semestermtcna = e.options[e.selectedIndex].value;

    var jenis="mtcna";

    $.ajax({
      url: "getlistpesertapiechart",
      type: "GET",
      data:{
        periode : periodemtcna,
        semester : semestermtcna,
        jenis : jenis
      },
      success: function(result){
          //console.log(result);
          downloadPDFpiechart(result,periodemtcna,semestermtcna,jenis);
      }
    })
  }

  function downloadPDFMTA(){
    var e =document.getElementById("periodemta");
    var periodemta = e.options[e.selectedIndex].value;

    var e =document.getElementById("semestermta");
    var semestermta = e.options[e.selectedIndex].value;

    var jenis="mta";

    $.ajax({
      url: "getlistpesertapiechart",
      type: "GET",
      data:{
        periode : periodemta,
        semester : semestermta,
        jenis : jenis
      },
      success: function(result){
          //console.log(result);
          downloadPDFpiechart(result,periodemta,semestermta,jenis);
      }
    })
  }

  function downloadPDFMOS(){
    var e =document.getElementById("periodemos");
    var periodemos = e.options[e.selectedIndex].value;

    var e =document.getElementById("semestermos");
    var semestermos = e.options[e.selectedIndex].value;

    var jenis="mos";

    $.ajax({
      url: "getlistpesertapiechart",
      type: "GET",
      data:{
        periode : periodemos,
        semester : semestermos,
        jenis : jenis
      },
      success: function(result){
          //console.log(result);
          downloadPDFpiechart(result,periodemos,semestermos,jenis);
      }
    })
  }

  function downloadPDFSCM(){
    var e =document.getElementById("periodescm");
    var periodescm = e.options[e.selectedIndex].value;

    var e =document.getElementById("semesterscm");
    var semesterscm = e.options[e.selectedIndex].value;

    var jenis="scm";

    $.ajax({
      url: "getlistpesertapiechart",
      type: "GET",
      data:{
        periode : periodescm,
        semester : semesterscm,
        jenis : jenis
      },
      success: function(result){
          //console.log(result);
          downloadPDFpiechart(result,periodescm,semesterscm,jenis);
      }
    })
  }

  function downloadPDF(){
    var e =document.getElementById("prodi_");
    var prodi = e.options[e.selectedIndex].value;
    var textprodi = e.options[e.selectedIndex].text;

    var e =document.getElementById("periode_");
    var periode = e.options[e.selectedIndex].value;

    var e =document.getElementById("semester_");
    var semester = e.options[e.selectedIndex].value;

    $.ajax({
      url: "getlistpesertagraph?q="+periode+"&p="+prodi+"&s="+semester,
      type: "GET",
      success: function(result){
        //console.log(result);
        var columns = ["No", "NIM", "Nama", "Pengambilan ke", "Nilai"];
        var rows = [];
        var rows1 = [];
        var rows2 = [];
        var rows3 = [];
        var rows4 = [];
        var rows5 = [];
        var rows6 = [];
        var rows7 = [];
        var angka = 0;

        var namamtalulus = jQuery.parseJSON(result.namamtalulus);
        var namamtatidaklulus = jQuery.parseJSON(result.namamtatidaklulus);

        var namamtcnalulus = jQuery.parseJSON(result.namamtcnalulus);
        var namamtcnatidaklulus = jQuery.parseJSON(result.namamtcnatidaklulus);

        var namamoslulus = jQuery.parseJSON(result.namamoslulus);
        var namamostidaklulus = jQuery.parseJSON(result.namamostidaklulus);

        var namascmlulus = jQuery.parseJSON(result.namascmlulus);
        var namascmtidaklulus = jQuery.parseJSON(result.namascmtidaklulus);

        $.each(namamtalulus,function(i,item){
          angka = angka+1;
          rows.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);
        });
        angka =0;

        $.each(namamtatidaklulus,function(i,item){
          angka = angka+1;
          rows1.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;


        $.each(namamtcnalulus,function(i,item){
          angka = angka+1;
          rows2.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;

        $.each(namamtcnatidaklulus,function(i,item){
          angka = angka+1;
          rows3.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;



        $.each(namamoslulus,function(i,item){
          angka = angka+1;
          rows4.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;

        $.each(namamostidaklulus,function(i,item){
          angka = angka+1;
          rows5.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;



        $.each(namascmlulus,function(i,item){
          angka = angka+1;
          rows6.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;

        $.each(namascmtidaklulus,function(i,item){
          angka = angka+1;
          rows7.push([angka,item.nim,item.nama,item.pengambilan_ke,item.nilai]);

        });
        angka =0;
        

              var doc = new jsPDF('portrait');
              doc.setFontSize(20);
              doc.text('Daftar Nilai Peserta Ujian',105, 15, 'center');

              doc.setFontSize(12);
              doc.text(20,35,'Semester : '+semester);
              doc.text(20,46,'Periode : '+periode);
              doc.text(20,57,'Program Studi : '+textprodi);

              if (rows.length>0) {
                doc.text('Data Lulus MTA',105, 65, 'center');
                doc.autoTable(columns, rows,{
                  theme: 'grid',
                  startY: 66,
                  styles:{
                    fontSize: 12,
                  }

                });

                var finalY = doc.autoTableEndPosY(); // The y position on the page
              }else{
                var finalY = 50; // The y position on the page
              }

              if (rows1.length>0) {
                  doc.text('Data Tidak Lulus MTA',105, finalY+15, 'center');
                  doc.autoTable(columns, rows1,{
                    theme: 'grid',
                    startY: finalY+16,
                    styles:{
                      fontSize: 12,
                    }

                  });

                  var finalY = doc.autoTableEndPosY(); // The y position on the page
              }

              
              if (rows2.length>0) {
                doc.text('Data Lulus MTCNA',105, finalY+15, 'center');
                doc.autoTable(columns, rows2,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              if (rows3.length>0) {
                doc.text('Data Tidak Lulus MTCNA',105, finalY+15, 'center');
                doc.autoTable(columns, rows3,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              if (rows4.length>0) {
                doc.text('Data Lulus MOS',105, finalY+15, 'center');
                doc.autoTable(columns, rows4,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              if (rows5.length>0) {
                doc.text('Data Tidak Lulus MOS',105, finalY+15, 'center');
                doc.autoTable(columns, rows5,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              if (rows6.length>0) {
                doc.text('Data Lulus SCM',105, finalY+15, 'center');
                doc.autoTable(columns, rows6,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              if (rows7.length>0) {
                doc.text('Data Tidak Lulus SCM',105, finalY+15, 'center');
                doc.autoTable(columns, rows7,{
                  theme: 'grid',
                  startY: finalY+16,
                  styles:{
                    fontSize: 12,
                  }

                });

                finalY = doc.autoTableEndPosY();
              }

              doc.save('Data Kelulusan '+textprodi+' Semester '+semester.toUpperCase()+' '+periode+'.pdf');
      }
        })        
  }


</script>
@endsection