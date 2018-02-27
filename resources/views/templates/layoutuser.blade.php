<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Sertifikasi Ma Chung </title>

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

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('images/user.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2 id="namauser">{{Session::get('user')}}</h2>
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
                  <li><a href="home"><i class="fa fa-home"></i> Home </a>
                    
                  </li>
                  <li><a href="jadwal"><i class="fa fa-calendar"></i> Jadwal</a>
                  </li>
                  <li><a href="rekap_nilai"><i class="fa fa-bar-chart"></i> Nilai &amp Sertifikat</a>
                    
                  </li>
                  <li><a href="registrasi_baru"><i class="fa fa-list"></i>Daftar Sertifikasi</a>
                    
                  </li>

                  <li><a href="bantuan"><i class="fa fa-question"></i>Bantuan</a>
                    
                  </li>

                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Change Password" href="change_password">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <form action="logout" method="get" id="logoutform">
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
                    {{Session::get('user')}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="change_password"><i class="fa fa-unlock pull-right"></i>Change Password</a></li>
                    <li ><a href="bantuan" ><i class="fa fa-question pull-right"></i>Help</a></li>
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
            Developed by Ivan Christianto Onggara - Teknik Informatika
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

    <!-- jQuery Smart Wizard -->
    <script src="{{asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>

    <!-- Dropzone.js -->
    <script src="{{asset('vendors/dropzone/dist/min/dropzone.min.js')}}"></script>

    @yield('footer_script')
  </body>
</html>
