@extends('templates.layoutadmin')

@section('content')
	<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Change Password</h3>
							</div>

						</div>
						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_title">
										<h2>Form Change Password</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
											</li>
											<li><a class="close-link"><i class="fa fa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">

										<form class="form-horizontal form-label-left" novalidate method="post" action="proses_ubah_password_admin">
										{{csrf_field()}}

											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password Lama<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input id="old_pass" data-validate-range="6,20" class="form-control col-md-7 col-xs-12" name="old_password" placeholder="Your Old Password is here" required="required" type="password">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pass">Password Baru<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="password" data-validate-range="6,20" id="pass" name="new_password" required="required" class="form-control col-md-7 col-xs-12" placeholder="Your New Password is here">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pass">Konfirmasi Password Baru<span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="password" data-validate-range="6,20" id="pass2" name="confirm_password" data-validate-linked="new_password" required="required" class="form-control col-md-7 col-xs-12" placeholder="Write Again Your New Password">
												</div>
											</div>
											
											<div class="ln_solid"></div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-6 col-md-offset-3">
													@if(session('alert_fail'))
			
														<b><p style="color: red;text-align: center;font-size: 1.2em;margin-bottom: 5px; stroke: 2px black">{{ session('alert_fail') }}</p></b>
													
													@endif

													@if(session('alert_success'))
													
														<b><p style="color: green;text-align: center;font-size: 1.2em;margin-bottom: 5px; stroke: 2px black">{{ session('alert_success') }}</p></b>
													
													@endif
													</div>
												</div>
											</div>
											<div class="form-group">
													<div class="row">
														<div class="col-md-6 col-md-offset-3">
															<div class="text-center">
																<button type="reset" class="btn btn-danger">Reset</button>
																<button id="send" type="submit" class="btn btn-success">Submit</button>
															</div>
														</div>
													</div>
												</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->

@endsection

@section('footer_script')

@endsection