<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Sertifikasi Ma Chung </title>
    @yield('css')

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.css')}}" rel="stylesheet">

    <!-- Dropzone.js -->
    <link href="{{asset('vendors/dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">

        <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- iCheck -->
   <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">


    <!-- Datatables -->
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

  </head>

  <body class="nav-md">
    <!-- <div id="bodyloading" class="loader centerall">
    </div> -->

    <div class="container body" id="bodyutama" style="visibility:visible;">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('images/user.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span class="bold">Welcome Admin, </span>
                <h2 id="namauser" class="bold">{{Session::get('admin')}}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="homeadmin"><i class="fa fa-home"></i> Home </a>
                    
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>User</h3>
                <ul class="nav side-menu">
                  <li><a href="allmahasiswa"><i class="fa fa-users"></i>Mahasiswa</a>
                    
                  </li>

                  <li><a href="alladmin"><i class="fa fa-user-secret"></i>Admin</a>
                    
                  </li>

                  <li><a href="alltrainer"><i class="fa fa-user"></i>Trainer</a>
                    
                  </li>
                    
                </ul>
              </div>
              <div class="menu_section">
                <h3>Ujian</h3>
                <ul class="nav side-menu">
                  <li><a href="datakelas"><i class="fa fa-list-ol"></i> Kelas Ujian</a>
                    
                  </li>
                  <li><a href="setjadwal"><i class="fa fa-calendar"></i> Jadwal</a>
                  </li>
                  <li><a href="setnilai"><i class="fa fa-bar-chart"></i> Nilai Sertifikasi</a>
                    
                  </li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Change Password" href="change_password_admin">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <form action="logoutadmin" method="get" id="logoutform">
                <a data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logoutform').submit();">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{Session::get('admin')}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="change_password_admin"><i class="fa fa-unlock pull-right"></i>Change Password</a></li>
                    <li><a onclick="document.getElementById('logoutform').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->


        @yield('content')

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Developed by Ivan Christianto Onggara - Teknik Informatika - <a href="http://www.machung.ac.id" target="_blank">Universitas Ma Chung</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    
    <!-- validator -->
    <script src="{{asset('vendors/validator/validator.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/custom.min.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/date.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- ECharts -->
    <script src="{{asset('vendors/echarts/dist/echarts.min.js')}}"></script>
    <script src="{{asset('vendors/echarts/map/js/world.js')}}"></script>

    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>

    

    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/showdatahome.js')}}"></script>
    <!-- <script type="text/javascript">
      jQuery(window).load(function () {
          
          setTimeout(function () {
              document.getElementById("bodyutama").style.visibility = "visible";
              document.getElementById("bodyloading").style.display = "none";  
          }, 1500);

      });
    </script> -->
    @yield('footer_script')
  </body>
</html>
