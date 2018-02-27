@extends('templates.layoutlogin')

@section('content')
<div class="background">
  <div class="logo">
   <img class="logo1" src="{{asset('aset/login/PPTIK.png')}}" alt="PPTIK" >
  </div>

  <div class="regist notshow">
    <div>
      <div>
        <img class="logo2" src="{{asset('aset/login/PPTIK2.png')}}" alt="PPTIK" >
      </div>
      <h2 class="text-center">Register Sertifikasi</h2>
      <div class="row no-margin">

        <form action="register" method="post">
        {{csrf_field()}}
          <div class="col-md-5 col-md-offset-3 col-lg-5 col-lg-offset-3 col-xs-7 col-xs-offset-2">
            <div class="form-group">
              <div class="row no-margin">
                <div class="col-md-5 col-lg-5 col-xs-3 text-right">
                  <label class="white" for="nim">NIM:</label>
                </div>
                <div class="col-md-7 col-lg-7 col-xs-9">
                  <input type="text" class="form-control" id="nim" placeholder="Masukkan NIM" name="nim" required="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row no-margin">
                <div class="col-md-5 col-lg-5 col-xs-3 text-right">
                  <label class="white" for="nama">Nama Lengkap:</label>
                </div>

                <div class="col-md-7 col-lg-7 col-xs-9">
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required="">
                </div>
              </div>

            </div>

            <div class="form-group">
              <div class="row no-margin">
                <div class="col-md-5 col-lg-5 col-xs-3 text-right">
                  <label class="white" for="pwd">Password:</label>
                </div>

                <div class="col-md-7 col-lg-7 col-xs-9">
                  <input type="password" class="form-control" id="pwd" placeholder="Masukkan Password" name="password" required="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row no-margin">
                <div class="col-md-5 col-lg-5 col-xs-3 text-right">
                  <label class="white" for="pwd">Verifikasi Password:</label>
                </div>

                <div class="col-md-7 col-lg-7 col-xs-9">
                  <input type="password" class="form-control" id="pwd" placeholder="Masukkan Password" name="passwordver" required="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row no-margin">
                <div class="col-md-5 col-lg-5 col-xs-3 text-right">
                  <label class="white " for="sertifikasi">Jenis sertifikasi:</label>
                </div>

                <div class="col-md-7 col-lg-7 col-xs-9">
                  <select class="form-control" id="sel1" name="jenissertifikasi" required="">
                    <option value="" disabled selected>Pilih jenis sertifikasi</option>
                    <option value="MOS">Microsoft Office Specialist (MOS)</option>
                    <option value="MTA">Microsoft Technology Associate (MTA)</option>
                    <option value="SCM">Security Compliance Manager (SCM)</option>
                    <option value="MTCNA">MikroTik Certified Network Administrator (MTCNA)</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
      </div>
    </form>
</div>
</div>
</div>
@endsection

