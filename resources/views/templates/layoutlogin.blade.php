<!DOCTYPE html>
<html>
<head>
	<title>Login Sertifikasi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="{{asset('style/styleLogin.css')}}">

	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>
<body >
	<div id="wrap">
		<div id="regbar">
			<div id="navthing">
				<h2><a href="#" id="loginform">Login</a> | <a class="reg" href="#">Register</a></h2>
				<div class="login">
					<div class="arrow-up">

					</div>
					<div class="formholder loginup">
						<div class="randompad">
							<form action="{{url('login')}}" method="post">
								{{csrf_field()}}
								<label name="nim">NIM</label>
								<input type="text" name="nim" />
								<label name="password">Password</label>
								<input type="password" name="password" />

								@if(session('status'))
								<b><p style="color: red;text-align: center;font-size: 0.8em;margin-bottom: 5px;">{{ session('status') }}</p></b>
								@endif
							</div>
							<input type="submit" value="Login" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

		@yield('content')
	<div class="footer">
		<div id="footbar">
			<div id="navthing">
				<h5 class="no-margin-all">Copyright &copy; 2017 - All Rights Reserved - <a target="_blank" href="http://machung.ac.id">Universitas Ma Chung</a></h5>
			</div>
		</div>
	</div>


	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script type="text/javascript" src="{{asset('js/loginForm.js')}}"></script>
</body>
</html>