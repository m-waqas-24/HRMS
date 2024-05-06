<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="HRMS-THYNK TECHS .It is one of the Major Dashboard Project which includes - HR, Employee, Job Dashboard, and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="THYNK TECHS Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, dashboard ui, backend, admin panel, admin website"/>

		<!-- TITLE -->
		<title> HRMS-THYNK TECHS -LOGIN</title>

        <!--FAVICON -->
		<link rel="icon" href="{{ asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

		<!-- BOOTSTRAP CSS -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" />
		
		<!-- ANIMATE CSS -->
		<link href="{{ asset('assets/css/animated.css') }}" rel="stylesheet" />

		<!---ICONS CSS -->
		<link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" />
        

        <!-- INTERNAL SWITCHER CSS -->
		<link href="{{ asset('assets/switcher/css/switcher.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/switcher/demo.css') }}" rel="stylesheet"/>

	</head>

	<body class="login-img">

		<!-- SWITCHER -->
        <div class="switcher-wrapper">
			<div class="demo_changer">
				<div class="form_holder sidebar-right1">
					<div class="row">
						<div class="predefined_styles">

							<div class="swichermainleft mb-0">
								<h4>LTR AND RTL VERSIONS</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-4">
											<span class="me-auto">LTR</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch5" id="myonoffswitch54" class="onoffswitch2-checkbox" checked>
												<label for="myonoffswitch54" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">RTL</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch5" id="myonoffswitch55" class="onoffswitch2-checkbox">
												<label for="myonoffswitch55" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Light Theme Style</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex">
											<span class="me-auto mt-2">Light Theme</span>
											<p class="onoffswitch2"><input type="radio" name="onoffswitch1" id="myonoffswitch1" class="onoffswitch2-checkbox" checked>
												<label for="myonoffswitch1" class="onoffswitch2-label"></label>
											</p>
										</div>
										<div class="switch-toggle d-flex">
											<span class="me-auto mt-2">Light Primary</span>
											<div class="">
												<input class="input-color-picker color-primary-light" value="#6c5ffc" id="colorID" type="color" data-id="bg-color" data-id1="bg-hover" data-id2="bg-border" data-id7="transparentcolor" name="lightPrimary">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Dark Theme Style</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex">
											<span class="me-auto mt-2">Dark Theme</span>
											<p class="onoffswitch2"><input type="radio" name="onoffswitch1"	id="myonoffswitch2" class="onoffswitch2-checkbox">
												<label for="myonoffswitch2" class="onoffswitch2-label"></label>
											</p>
										</div>
										<div class="switch-toggle d-flex">
											<span class="me-auto  mt-2">Dark Primary</span>
											<div class="">
												<input class=" input-dark-color-picker color-primary-dark" value="#6c5ffc" id="darkPrimaryColorID" type="color" data-id="bg-color" data-id1="bg-hover" data-id2="bg-border"	data-id3="primary" data-id8="transparentcolor" name="darkPrimary">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Transparent Theme Style</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex">
											<span class="me-auto  mt-2">Transparent Theme</span>
											<p class="onoffswitch2"><input type="radio" name="onoffswitch1"	id="myonoffswitchTransparent" class="onoffswitch2-checkbox">
												<label for="myonoffswitchTransparent" class="onoffswitch2-label"></label>
											</p>
										</div>
										<div class="switch-toggle d-flex">
											<span class="me-auto  mt-2">Transparent Primary</span>
											<div class="">
												<input
													class="w-30p h-30 input-transparent-color-picker color-primary-transparent"	value="#6c5ffc" id="transparentPrimaryColorID" type="color" data-id="bg-color"	data-id1="bg-hover" data-id2="bg-border" data-id3="primary"	data-id4="primary" data-id9="transparentcolor" name="tranparentPrimary">
											</div>
										</div>
										<div class="switch-toggle d-flex">
											<span class="me-auto  mt-2">Transparent Background</span>
											<div class="">
												<input
													class="w-30p h-30 input-transparent-color-picker color-bg-transparent"	value="#6c5ffc" id="transparentBgColorID" type="color" data-id5="body" data-id6="theme"	data-id9="transparentcolor" name="transparentBackground">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Transparent Bg-Image Style</h4>
								<div class="skin-body switch_section">
									<div class="switch-toggle d-flex">
										<span class="me-auto ">Bg-Image Primary</span>
										<div class="">
											<input
												class="input-transparent-color-picker color-primary-transparent"	value="#6c5ffc" id="transparentBgImgPrimaryColorID" type="color" data-id="bg-color"	data-id1="bg-hover" data-id2="bg-border" data-id3="primary"	data-id4="primary" data-id9="transparentcolor" name="tranparentPrimary">
										</div>
									</div>
									<div class="switch-toggle d-flex mt-2">
										<a class="bg-img1" href="javascript:void(0);"><img
												src="{{ asset('assets/images/photos/bg-img1.jpg') }}" alt="Bg-Image" id="bgimage1"></a>
										<a class="bg-img2" href="javascript:void(0);"><img
												src="{{ asset('assets/images/photos/bg-img2.jpg') }}" alt="Bg-Image" id="bgimage2"></a>
										<a class="bg-img3" href="javascript:void(0);"><img
												src="{{ asset('assets/images/photos/bg-img3.jpg') }}" alt="Bg-Image" id="bgimage3"></a>
										<a class="bg-img4" href="javascript:void(0);"><img
												src="{{ asset('assets/images/photos/bg-img4.jpg') }}" alt="Bg-Image" id="bgimage4"></a>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
                                <h4>Reset All Styles</h4>
                                <div class="skin-body">
                                    <div class="switch_section my-4">
                                        <button class="btn btn-danger btn-block" id="customresetAll" type="button">Reset All
                                        </button>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SWITCHER -->
        
				<div class="page responsive-log relative error-page3">
				
					<div class="dropdown custom-layout">
						<div class="demo-icon nav-link  icon  float-end mt-5 me-5">
							<i class="fe fe-settings fa-spin text_primary"></i>
						</div>
					</div>
        
					<!-- PAGE -->
								
					<div class="row no-gutters">
						<div class="col-xl-6  d-xl-block d-none log-image1">
							<div class="cover-image h-100vh" data-bs-image-src="{{ asset('assets/images/photos/login3.jpg') }}">
								<div class="container">
									<div class="customlogin-imgcontent">
										<h2 class="mb-3 fs-35 text-white">Welcome To HRMS</h2>
										<p class="text-white-50">HR Operations automation is no more a nightmare! ThynkTechs HRMS has all the tools you require to build a good to great organization, from automating people procedures to developing an engaged and motivated culture.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 bg-white log-image1">
							<div class="container">
								<div class="customlogin-content pt-5 pt-xl-9">
									<div class="pt-4 pb-2 ps-2">
										<a class="header-brand" href="# ">
											<img src="{{ asset('assets/images/myimages/logo.png') }}" class="header-brand-img custom-logo" alt="logo">
											<img src="{{ asset('assets/images/myimages/logo.png') }}" class="header-brand-img custom-logo-dark" alt="logo">
										</a>
									</div>
									<div class="p-4 pt-6">
										<h1 class="mb-2">Login</h1>
										<p class="text-muted">Sign In to your account</p>
									</div>
									<form  method="POST" action="{{ route('login') }}" class="card-body pt-3" id="login" name="login">
                                        @csrf
										<div class="form-group">
											<label class="form-label">Email</label>
												<div class="input-group mb-4">
													<div class="input-group">
														<a class="input-group-text">
															<i class="fe fe-mail" aria-hidden="true"></i>
														</a>
														<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
													</div>
												</div>
										</div>
										<div class="form-group">
											<label class="form-label">Password</label>
												<div class="input-group mb-4">
													<div class="input-group" id="Password-toggle">
														<a href="#" class="input-group-text">
															<i class="fe fe-eye-off" aria-hidden="true"></i>
														</a>
														<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
													</div>
												</div>
										</div>
										<div class="form-group">
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
												<span class="custom-control-label">Remeber me</span>
											</label>
										</div>
										<div class="submit">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE -->


        <!-- JQUERY JS -->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

		<!-- BOOTSTRAP JS-->
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- SELECT2 JS -->
		<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

		<!-- P-SCROLL JS -->
		<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
		

		<!--STICKY JS -->
		<script src="{{ asset('assets/js/sticky.js') }}"></script>

		<!-- COLOR THEME JS-->
		<script src="{{ asset('assets/js/themeColors.js') }}"></script>

		<!-- CUSTOM JS -->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- SWITCHER -->
		<script src="{{ asset('assets/switcher/js/switcher.js') }}"></script>

	</body>
</html>
