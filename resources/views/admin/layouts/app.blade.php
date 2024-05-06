@php
	$id = request()->segment(4);
@endphp


<!DOCTYPE html>
<html lang="en" dir="ltr">
	
	
<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="HRMS" name="description">
		<meta content="HRMS" name="author">
		<meta name="keywords" content="HRMS"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- TITLE -->
		<title>HRMS - PFTP</title>

		<!-- FAVICON -->
		<link rel="icon" href="{{ asset('storage/'.getCompanyFavicon()) }}" type="image/x-icon"/>

		<!-- BOOTSTRAP CSS -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" />
		
		<!-- ANIMATE CSS -->
		<link href="{{ asset('assets/css/animated.css') }}" rel="stylesheet" />

		<!---ICONS CSS -->
		<link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" />
		
        
        <!-- INTERNAL SWITCHER CSS -->
		<link href="{{ asset('assets/switcher/css/switcher.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/switcher/demo.css') }}" rel="stylesheet"/>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdn.tiny.cloud/1/kh6bj7s54q6kccp16t2eo3irc8bonpk3titmieuvdvgkg3w8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

        @yield('styles')

	</head>


	<body class="app sidebar-mini ltr light-menu">

		@if(session('errors') && count(session('errors')) > 0)
		<script>
			var errorMessages = @json(session('errors')->all()); 
			var errorMessageString = '<ul>';
			errorMessages.forEach(function(errorMessage) {
				errorMessageString += '<li>' + errorMessage + '</li>';
			});
			errorMessageString += '</ul>';
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Error!',
				html: errorMessageString,
				showConfirmButton: false,
				timer: 12000,
				customClass: {
					title: 'my-custom-font-size'
				}
			});
		</script>
		<style>
			.my-custom-font-size {
				font-size: 18px;
			}
		</style>
	@endif
	

		@if(session('success'))
		<script>
			Swal.fire({
			position: 'center',
			icon: 'success',
			title: '{{ session('success') }}',
			showConfirmButton: false,
			timer: 12000,
			customClass: {
			title: 'my-custom-font-size'
		}
		})
		</script>
		<style>
			.my-custom-font-size {
				font-size: 18px; 
			}
		</style>
		@endif



		<!-- SWITCHER -->
        <div class="switcher-wrapper">
			<div class="demo_changer">
				<div class="form_holder sidebar-right1">
					<div class="row">
						<div class="predefined_styles">
							<div class="swichermainleft text-center">
							</div>
							<div class="swichermainleft mb-0">
								<h4>Navigation Style</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-4">
											<span class="me-auto">Vertical Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch15" id="myonoffswitch34" class="onoffswitch2-checkbox" checked>
												<label for="myonoffswitch34" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Horizontal Click Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch15" id="myonoffswitch35" class="onoffswitch2-checkbox">
												<label for="myonoffswitch35" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Horizontal Hover Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch15" id="myonoffswitch111" class="onoffswitch2-checkbox">
												<label for="myonoffswitch111" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
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
												<input class="input-color-picker color-primary-light" value="#6c5ffc" id="colorID"  type="color" data-id="bg-color" data-id1="bg-hover" data-id2="bg-border" data-id7="transparentcolor" name="lightPrimary">
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
												<input class=" input-dark-color-picker color-primary-dark" value="#6c5ffc" id="darkPrimaryColorID"  type="color" data-id="bg-color" data-id1="bg-hover" data-id2="bg-border"	data-id3="primary" data-id8="transparentcolor" name="darkPrimary">
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
										<a class="bg-img1" href="javascript:void(0);" ><img
												src="{{ asset('assets/images/photos/bg-img1.jpg') }}" alt="Bg-Image" id="bgimage1"></a>
										<a class="bg-img2" href="javascript:void(0);" ><img
												src="{{ asset('assets/images/photos/bg-img2.jpg') }}" alt="Bg-Image" id="bgimage2"></a>
										<a class="bg-img3" href="javascript:void(0);" ><img
												src="{{ asset('assets/images/photos/bg-img3.jpg') }}" alt="Bg-Image" id="bgimage3"></a>
										<a class="bg-img4" href="javascript:void(0);" ><img
												src="{{ asset('assets/images/photos/bg-img4.jpg') }}" alt="Bg-Image" id="bgimage4"></a>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
								<h4>Leftmenu Layout width styles</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-4">
											<span class="me-auto">Default</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch18" class="onoffswitch2-checkbox" checked>
												<label for="myonoffswitch18" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Boxed</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch2" id="myonoffswitch19" class="onoffswitch2-checkbox">
												<label for="myonoffswitch19" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft leftmenu-styles">
								<h4>Sidemenu Layout Versions</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Default Sidemenu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch22" class="onoffswitch2-checkbox" checked>
												<label for="myonoffswitch22" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Closed Sidemenu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch23" class="onoffswitch2-checkbox">
												<label for="myonoffswitch23" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Hover Submenu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch24" class="onoffswitch2-checkbox">
												<label for="myonoffswitch24" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Hover Submenu Style1</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch30" class="onoffswitch2-checkbox">
												<label for="myonoffswitch30" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Icon Overlay</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch25" class="onoffswitch2-checkbox">
												<label for="myonoffswitch25" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Icon Text</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch8" id="myonoffswitch29" class="onoffswitch2-checkbox">
												<label for="myonoffswitch29" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft  header-styles">
								<h4>Header Styles Mode</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Light Header</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch7" id="background1" class="onoffswitch2-checkbox" checked>
												<label for="background1" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Color Header</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch7" id="background2" class="onoffswitch2-checkbox">
												<label for="background2" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Dark Header</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch7" id="background3" class="onoffswitch2-checkbox">
												<label for="background3" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Gradient Header</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch7" id="background11" class="onoffswitch2-checkbox">
												<label for="background11" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft  menu-styles">
								<h4>Leftmenu Styles Mode</h4>
								<div class="skin-body">
									<div class="switch_section">
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Light Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch4" id="background4" class="onoffswitch2-checkbox">
												<label for="background4" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Color Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch4" id="background5" class="onoffswitch2-checkbox">
												<label for="background5" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Dark Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch4" id="background6" class="onoffswitch2-checkbox" checked>
												<label for="background6" class="onoffswitch2-label"></label>
											</div>
										</div>
										<div class="switch-toggle d-flex mt-2">
											<span class="me-auto">Gradient Menu</span>
											<div class="onoffswitch2"><input type="radio" name="onoffswitch4" id="background10" class="onoffswitch2-checkbox">
												<label for="background10" class="onoffswitch2-label"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="swichermainleft">
                                <h4>Reset All Styles</h4>
                                <div class="skin-body">
                                    <div class="switch_section my-4">
                                        <button class="btn btn-danger btn-block" id="resetAll" type="button">Reset All
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
		<!--- GLOBAL-LOADER -->
		<div id="global-loader" >
			<img src="{{ asset('assets/images/svgs/loader.svg') }}" alt="loader">
		</div>


		<!--- END GLOBAL-LOADER -->

		<div class="page">
			<div class="page-main">

				<!-- APP-HEADER -->
                <div class="app-header header sticky">
					<div class="container-fluid main-container">
						<div class="d-flex">
							<a class="header-brand" href="{{ route('admin.dashboard') }}">
								{{-- <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-lgo" alt="logo">
								<img src="{{ asset('assets/images/brand/logo-white.png') }}" class="header-brand-img dark-logo" alt="logo">
								<img src="{{ asset('assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo" alt="logo">
								<img src="{{ asset('assets/images/brand/favicon1.png') }}" class="header-brand-img darkmobile-logo" alt="logo"> --}}
							</a>
							<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
								<a class="open-toggle"  href="javascript:void(0);">
									<i class="feather feather-menu"></i>
								</a>
								<a class="close-toggle"  href="javascript:void(0);">
									<i class="feather feather-x"></i>
								</a>
							</div>
							<div class="mt-0">
								<form class="form-inline">
									<div class="search-element">
										<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
										<button class="btn btn-primary-color" >
											<i class="feather feather-search"></i>
										</button>
									</div>
								</form>
							</div><!-- SEARCH -->
							<div class="d-flex order-lg-2 my-auto ms-auto">
								<button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
									<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
								</button>
								<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
									<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
										<div class="d-flex ms-auto">
											<a class="nav-link  icon p-0 nav-link-lg d-lg-none navsearch"  href="javascript:void(0);" data-bs-toggle="search">
												<i class="feather feather-search search-icon header-icon"></i>
											</a>
											<div class="dropdown  d-flex">
												<a class="nav-link icon theme-layout nav-link-bg layout-setting">
													 <span class="dark-layout"><i class="fe fe-moon"></i></span>
													<span class="light-layout"><i class="fe fe-sun"></i></span>
												</a>
											</div>
											{{-- <div class="dropdown header-flags">
												<a class="nav-link icon" data-bs-toggle="dropdown">
													<img src="{{ asset('assets/images/flags/flag-png/united-kingdom.png') }}" class="h-24" alt="img">
												</a>
												<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
													<a  href="javascript:void(0);" class="dropdown-item d-flex "> <span class="avatar  me-3 align-self-center bg-transparent"><img src="{{ asset('assets/images/flags/flag-png/india.png') }}" alt="img" class="h-24"></span>
														<div class="d-flex"> <span class="my-auto">India</span> </div>
													</a>
													<a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar  me-3 align-self-center bg-transparent"><img src="{{ asset('assets/images/flags/flag-png/united-kingdom.png') }}" alt="img" class="h-24"></span>
														<div class="d-flex"> <span class="my-auto">UK</span> </div>
													</a>
													<a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar me-3 align-self-center bg-transparent"><img src="{{ asset('assets/images/flags/flag-png/italy.png') }}" alt="img" class="h-24"></span>
														<div class="d-flex"> <span class="my-auto">Italy</span> </div>
													</a>
													<a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar me-3 align-self-center bg-transparent"><img src="{{ asset('assets/images/flags/flag-png/united-states-of-america.png') }}" class="h-24" alt="img"></span>
														<div class="d-flex"> <span class="my-auto">US</span> </div>
													</a>
													<a  href="javascript:void(0);" class="dropdown-item d-flex"> <span class="avatar  me-3 align-self-center bg-transparent"><img src="{{ asset('assets/images/flags/flag-png/spain.png') }}" alt="img" class="h-24"></span>
														<div class="d-flex"> <span class="my-auto">Spain</span> </div>
													</a>
												</div>
											</div> --}}
											<div class="dropdown header-fullscreen">
												<a class="nav-link icon full-screen-link">
													<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
													<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
												</a>
											</div>
											{{-- <div class="dropdown header-message">
												<a class="nav-link icon" data-bs-toggle="dropdown">
													<i class="feather feather-mail header-icon"></i>
													<span class="badge badge-success side-badge">5</span>
												</a>
												<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated">
													<div class="header-dropdown-list message-menu" id="message-menu">
														<a class="dropdown-item border-bottom" href="chat.html">
															<div class="d-flex align-items-center">
																<div class="">
																	<span class="avatar avatar-md brround align-self-center cover-image" data-bs-image-src="{{ asset('assets/images/users/1.jpg') }}"></span>
																</div>
																<div class="d-flex">
																	<div class="ps-3 text-wrap text-break">
																		<h6 class="mb-1">Jack Wright</h6>
																		<p class="fs-13 mb-1">All the best your template awesome</p>
																		<div class="small text-muted">
																			3 hours ago
																		</div>
																	</div>
																</div>
															</div>
														</a>
														<a class="dropdown-item border-bottom" href="chat.html">
														<div class="d-flex align-items-center">
																<div class="">
																	<span class="avatar avatar-md brround align-self-center cover-image" data-bs-image-src="{{ asset('assets/images/users/2.jpg') }}"></span>
																</div>
																<div class="d-flex">
																	<div class="ps-3 text-wrap text-break">
																		<h6 class="mb-1">Lisa Rutherford</h6>
																		<p class="fs-13 mb-1">Hey! there I'm available</p>
																		<div class="small text-muted">
																			5 hour ago
																		</div>
																	</div>
																</div>
															</div>
														</a>
														<a class="dropdown-item border-bottom" href="chat.html">
															<div class="d-flex align-items-center">
																<div class="">
																	<span class="avatar avatar-md brround align-self-center cover-image" data-bs-image-src="{{ asset('assets/images/users/3.jpg') }}"></span>
																</div>
																<div class="d-flex">
																	<div class="ps-3 text-wrap text-break">
																		<h6 class="mb-1">Blake Walker</h6>
																		<p class="fs-13 mb-1">Just created a new blog post</p>
																		<div class="small text-muted">
																			45 mintues ago
																		</div>
																	</div>
																</div>
															</div>
														</a>
														<a class="dropdown-item border-bottom" href="chat.html">
															<div class="d-flex align-items-center">
																<div class="">
																	<span class="avatar avatar-md brround align-self-center cover-image" data-bs-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
																</div>
																<div class="d-flex">
																	<div class="ps-3 text-wrap text-break">
																		<h6 class="mb-1">Fiona Morrison</h6>
																		<p class="fs-13 mb-1">Added new comment on your photo</p>
																		<div class="small text-muted">
																			2 days ago
																		</div>
																	</div>
																</div>
															</div>
														</a>
														<a class="dropdown-item border-bottom" href="chat.html">
															<div class="d-flex align-items-center">
																<div class="">
																	<span class="avatar avatar-md brround align-self-center cover-image" data-bs-image-src="{{ asset('assets/images/users/6.jpg') }}"></span>
																</div>
																<div class="d-flex">
																	<div class="ps-3 text-wrap text-break">
																		<h6 class="mb-1">Stewart Bond</h6>
																		<p class="fs-13 mb-1">Your payment invoice is generated</p>
																		<div class="small text-muted">
																			3 days ago
																		</div>
																	</div>
																</div>
															</div>
														</a>
													</div>
													<div class=" text-center p-2">
														<a href="chat.html" class="">See All Messages</a>
													</div>
												</div>
											</div> --}}
											<div class="dropdown header-notify">
												{{-- <a class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
													<i class="feather feather-bell header-icon"></i>
													<span class="bg-dot"></span>
												</a> --}}
											</div>
											<div class="dropdown profile-dropdown">
												<a  href="javascript:void(0);" class="nav-link pe-1 ps-0 leading-none" data-bs-toggle="dropdown">
													<span>
														@if(isset(Auth::user()->avatar))
														<img src="{{ asset('storage/'. auth()->user()->avatar) }}" alt="img" class="avatar avatar-md bradius">
														@else
														<img src="{{ asset('assets/images/users/user.jpg') }}" alt="img" class="avatar avatar-md bradius">
														@endif
													</span>
												</a>
												<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
													<div class="p-3 text-center border-bottom">
														<a href="#" class="text-center user pb-0 font-weight-bold">{{ Auth::user()->name }} </a>

														@if(Auth::user()->type == 'employee')
														<p class="text-center user-semi-title">{{ Auth::user()->employe->companyDetail->designation->name }}</p>
														@endif

													</div>
													<a class="dropdown-item d-flex" href="{{ route('admin.index.profile') }}">
														<i class="feather feather-user me-3 fs-16 my-auto"></i>
														<div class="mt-1">Profile</div>
													</a>
													<a class="dropdown-item d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
														<i class="feather feather-power me-3 fs-16 my-auto"></i>
														<div class="mt-1">Sign Out</div>
													</a>
													<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
														@csrf
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="d-flex header-setting-icon">
									<a class="nav-link icon demo-icon"    href="javascript:void(0);">
										<i class="feather feather-settings  fe-spin"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- APP-HEADER CLOSED -->

                <!-- APP-SIDEBAR -->
				<div class="sticky">
					<aside class="app-sidebar " >
						<div class="app-sidebar__logo">
							<a class="header-brand" href="{{ route('admin.dashboard') }}">
								<img src="{{ asset('storage/'.getCompanyLogoDark()) }}" class="header-brand-img desktop-lgo" alt="logo">
								<img src="{{ asset('storage/'.getCompanyLogoLight()) }}" class="header-brand-img dark-logo" alt="logo">
								<img src="{{ asset('storage/'.getCompanyFavicon()) }}" class="header-brand-img mobile-logo" alt="logo">
								<img src="{{ asset('storage/'.getCompanyFavicon()) }}" class="header-brand-img darkmobile-logo" alt="logo">
							</a>
						</div>
						<div class="app-sidebar3">
							<div class="main-menu">
								<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
								<ul class="side-menu">
									<li class="side-item side-item-category mt-4">Dashboard</li>

									@if(getCompanyPlan()->hrm)
										<li class="slide">
											<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.dashboard') }}">
											<i class="feather feather-home  sidemenu_icon"></i>
											<span class="side-menu__label">Dashboard</span></a>
										</li>
									@endif

									@if(getCompanyPlan()->hrm)
									<li class="side-item side-item-category mt-4">HRM</li>
									@endif

									<li class="slide">

										@if(Auth::user()->type == 'employee')
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.employee.show',  \Auth::user()->employe ) }}">
											<i class="feather feather-user  sidemenu_icon"></i>
											<span class="side-menu__label">Employee</span>
										</a>
										@endif

										@if(Auth::user()->type == 'company')
										@can('manage employee ')
										<a class="side-menu__item {{ request()->routeIs('admin.employee.create') || request()->routeIs('admin.employee.edit') || request()->routeIs('admin.employee.index') || request()->routeIs('admin.employee.show', $id) ? 'active' : '' }} " data-bs-toggle="slide"  href="{{ route('admin.employe-list') }}">
											<i class="feather feather-user  sidemenu_icon"></i>
											<span class="side-menu__label">Employees</span>
										</a>
										@endcan
										@endif

									</li>
									
									@if(getCompanyPlan()->hrm)
									<li class="slide {{ request()->routeIs('admin.attendance-by-user', $id ) ? 'is-expanded' : '' }} ">
										<a class="side-menu__item  {{ request()->routeIs('admin.attendance-by-user', $id ) ? 'active is-expanded' : '' }}" data-bs-toggle="slide"  href="javascript:void(0);">
											<i class="fa fa-check-square sidemenu_icon"></i>
											<span class="side-menu__label  ">Attendance</span><i class="angle fa fa-angle-right"></i>
										</a>
										<ul class="slide-menu">
										

										<li class="side-menu-label1 {{ request()->routeIs('admin.attendance-by-user', $id ) ? 'active ' : '' }}"><a  href="javascript:void(0);">Attendance {{ $id }} </a></li>
										
										@if(Auth::user()->type == 'employee')
											<li><a href="{{ route('admin.employe-attendance.index') }}" class="slide-item {{ request()->routeIs('admin.attendance.index') ? 'active' : '' }}"> Mark Attendance</a></li>
										@endif
										@can('manage attendance-overview')
											<li class="{{  request()->routeIs('admin.attendance-by-user', $id ) ? 'is-expanded' : '' }}"><a href="{{ route('admin.attendance-overview') }}" class="slide-item {{ request()->routeIs('admin.attendance-overview') || request()->routeIs('admin.attendance-by-user', $id ) ? 'active' : '' }}"> Attendance Overview</a></li>
										@endcan
										</ul>
									</li>
									@endif

									@if(Gate::check('manage salary') || Gate::check('manage payslips'))
									<li class="slide {{ request()->routeIs('admin.edit.setsalary', $id) ? 'is-expanded' : '' }} ">
										<a class="side-menu__item {{ request()->routeIs('admin.edit.setsalary', $id) ? 'active is-expanded' : '' }}" data-bs-toggle="slide"  href="javascript:void(0);">
											<i class="fa fa-credit-card sidemenu_icon"></i>
											<span class="side-menu__label">Payroll</span><i class="angle fa fa-angle-right"></i>
										</a>
										<ul class="slide-menu">
										<li class="side-menu-label1"><a  href="javascript:void(0);">Payroll</a></li>
										@can('manage salary')
											<li {{ request()->routeIs('admin.edit.setsalary', $id) ? 'is-expanded' : '' }} ><a href="{{ route('admin.index.setsalary') }}" class="slide-item {{ request()->routeIs('admin.edit.setsalary', $id) ? 'active' : '' }}" >Set Salary</a></li>
										@endcan
										{{-- @can('manage salary') --}}
											<li><a href="{{ route('admin.index.payslips') }}" class="slide-item" >Payslips</a></li>
										{{-- @endcan --}}
										</ul>
									</li>
									@endif

									@can('manage leaves')
									<li class="slide {{ request()->routeIs('admin.leaves.editwithId', $id) ? 'is-expanded' : '' }}">
										<a class="side-menu__item {{ request()->routeIs('admin.leaves.editwithId', $id) ? 'active is-expanded' : '' }}" data-bs-toggle="slide"  href="javascript:void(0);">
											<i class="feather feather-pocket sidemenu_icon"></i>
											<span class="side-menu__label">Leaves</span><i class="angle fa fa-angle-right"></i>
										</a>
										<ul class="slide-menu">
											<li class="side-menu-label1"><a  href="javascript:void(0);">Leaves</a></li>
											{{-- <li><a href="{{ route('admin.leavestatus.index') }}" class="slide-item">Leaves Applications</a></li> --}}
											<li class="{{ request()->routeIs('admin.leaves.editwithId', $id) ? 'is-expanded' : '' }}" ><a href="{{ route('admin.leaves.index') }}" class="slide-item  {{ request()->routeIs('admin.leaves.editwithId', $id) ? 'active' : '' }}">Leaves Summary</a></li>
										</ul>
									</li>
									@endcan

									@if(Gate::check('manage trainer') || Gate::check('manage traininglist'))
									<li class="slide {{ request()->routeIs('admin.traininglists.edit',$id) || request()->routeIs('admin.trainers.edit', $id) ? 'is-expanded' : '' }}">
										<a class="side-menu__item {{ request()->routeIs('admin.traininglists.edit',$id) || request()->routeIs('admin.trainers.edit', $id) ? 'active is-expanded' : '' }}" data-bs-toggle="slide"  href="javascript:void(0);">
											<i class="fe fe-monitor sidemenu_icon"></i>
											<span class="side-menu__label">Training</span><i class="angle fa fa-angle-right"></i>
										</a>
										<ul class="slide-menu">
										<li class="side-menu-label1"><a  href="javascript:void(0);">Training</a></li>
										@can('manage traininglist')
											<li {{ request()->routeIs('admin.traininglists.edit',$id) ? 'is-expanded' : '' }}><a href="{{ route('admin.traininglists.index') }}" class="slide-item {{ request()->routeIs('admin.traininglists.edit',$id) ? 'active' : '' }} ">Training List</a></li>
										@endcan
										@can('manage trainer')
											<li class="{{ request()->routeIs('admin.trainers.edit', $id) ? 'is-expanded' : '' }}"><a href="{{ route('admin.trainers.index') }}" class="slide-item {{ request()->routeIs('admin.trainers.edit', $id) ? 'active' : '' }}">Trainer</a></li>
										@endcan
										</ul>
									</li>
									@endif

									@can('manage recruitments')
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.recruitments.index') }}">
										<i class="feather feather-sliders  sidemenu_icon"></i>
										<span class="side-menu__label">Recruitments</span></a>
									</li>
									@endcan

									@can('manage employee-assets')
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.employee-assets.index') }}">
										<i class="fe fe-pocket  sidemenu_icon"></i>
										<span class="side-menu__label">Employee Assets</span></a>
									</li>
									@endcan

									@if(getCompanyPlan()->accounts)
										@if(Gate::check('manage categories') || Gate::check('create categories') || Gate::check('edit categories') || Gate::check('delete categories') ||
											Gate::check('manage banks') || Gate::check('create banks') || Gate::check('edit banks') || Gate::check('delete banks') ||
											Gate::check('manage balance-transfers') || Gate::check('create balance-transfers') ||
											Gate::check('manage bank-accounts') || Gate::check('create bank-accounts') || Gate::check('edit bank-accounts') || Gate::check('delete bank-accounts') ||
											Gate::check('manage debts/loans') || Gate::check('create debts/loans') || Gate::check('edit debts/loans') || Gate::check('delete debts/loans') ||
											Gate::check('manage incomes') || Gate::check('create incomes') || Gate::check('edit incomes') || Gate::check('delete incomes') ||
											Gate::check('manage expenses') || Gate::check('create expenses') || Gate::check('edit expenses') || Gate::check('delete expenses'))
										<li class="slide">
											<a class="side-menu__item" data-bs-toggle="slide"  href="javascript:void(0);">
												<i class="fa fa-money sidemenu_icon"></i>
												<span class="side-menu__label">Accounts</span><i class="angle fa fa-angle-right"></i>
											</a>
											<ul class="slide-menu">
											<li class="side-menu-label1"><a  href="javascript:void(0);">Accounts</a></li>
												<li><a href="{{ route('admin.account.dashboard') }}" class="slide-item">Reports</a></li>
												@if(Gate::check('manage categories') || Gate::check('create categories') || Gate::check('edit categories') || Gate::check('delete categories'))
													<li><a href="{{ route('admin.account.category.index') }}" class="slide-item">Categories</a></li>
												@endif
												@if(Gate::check('manage banks') || Gate::check('create banks') || Gate::check('edit banks') || Gate::check('delete banks'))
													<li><a href="{{ route('admin.banks.index') }}" class="slide-item">Banks</a></li>
												@endif
												@if(Gate::check('manage bank-accounts') || Gate::check('create bank-accounts') || Gate::check('edit bank-accounts') || Gate::check('delete bank-accounts'))
													<li><a href="{{ route('admin.bank-acc.index') }}" class="slide-item">Bank Accounts</a></li>
												@endif
												@if(Gate::check('manage balance-transfers') || Gate::check('create balance-transfers') || Gate::check('edit balance-transfers') || Gate::check('delete balance-transfers'))
													<li><a href="{{ route('admin.balance-transfers.index') }}" class="slide-item">Balance Transfers</a></li>
												@endif
												@if(Gate::check('manage debts-loans') || Gate::check('create debts-loans') || Gate::check('edit debts-loans') || Gate::check('delete debts-loans'))
													<li><a href="{{ route('admin.debts.index') }}" class="slide-item">Debts/Loans</a></li>
												@endif
												@if(Gate::check('manage incomes') || Gate::check('create incomes') || Gate::check('edit incomes') || Gate::check('delete incomes'))
													<li><a href="{{ route('admin.index.income') }}" class="slide-item">Incomes</a></li>
												@endif
												@if(Gate::check('manage expenses') || Gate::check('create expenses') || Gate::check('edit expenses') || Gate::check('delete expenses'))
													<li><a href="{{ route('admin.index.expense') }}" class="slide-item">Expenses</a></li>
												@endif
											</ul>
										</li>
										@endif
									@endif

									@if(Gate::check('manage hradminsetup'))
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="javascript:void(0);">
											<i class="fa fa-hashtag sidemenu_icon"></i>
											<span class="side-menu__label">HR Admin Setup</span><i class="angle fa fa-angle-right"></i>
										</a>
										<ul class="slide-menu">
										<li class="side-menu-label1"><a  href="javascript:void(0);">HR Admin Setup</a></li>
										@can('manage transfer')
											<li><a href="{{ route('admin.transfers.index') }}" class="slide-item">Transfer</a></li>
										@endcan
										@can('manage promotions')
											<li><a href="{{ route('admin.promotions.index') }}" class="slide-item">Promotions</a></li>
										@endcan
										@can('manage awards')
											<li><a href="{{ route('admin.awards.index') }}" class="slide-item">Awards</a></li>
										@endcan
										@can('manage resignation')
											<li><a href="{{ route('admin.resignations.index') }}" class="slide-item">Resignation</a></li>
										@endcan
										@can('manage termination')
											<li><a href="{{ route('admin.terminations.index') }}" class="slide-item">Terminations</a></li>
										@endcan
										@can('manage complaints')
											<li><a href="{{ route('admin.complaints.index') }}" class="slide-item">Complaints</a></li>
										@endcan
										@can('manage holidays')
											<li><a href="{{ route('admin.holidays.index') }}" class="slide-item">Holidays</a></li>
										@endcan
										</ul>
									</li>
									@endif


								
									@if(auth()->user()->type == 'company')
										<li class="slide">
											<a class="side-menu__item" data-bs-toggle="slide"  href="javascript:void(0);">
												<i class="feather feather-user sidemenu_icon"></i>
												<span class="side-menu__label">Users Management</span><i class="angle fa fa-angle-right"></i>
											</a>
											<ul class="slide-menu">
											<li class="side-menu-label1"><a  href="javascript:void(0);">Users Management</a></li>
												<li><a href="{{ route('admin.user.list') }}" class="slide-item">Users</a></li>
												<li><a href="{{ route('admin.index.roles') }}" class="slide-item">Role</a></li>
											</ul>
										</li>
									@endif
									
									@if(getCompanyPlan()->hrm)
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.index.ip') }}">
										<i class="feather feather-home  sidemenu_icon"></i>
										<span class="side-menu__label">HRM Settings</span></a>
									</li>
									@endif

									<li class="side-item side-item-category mt-4">General</li>

									@if(getCompanyPlan()->hrm)
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.calendar') }}">
										<i class="feather feather-home  sidemenu_icon"></i>
										<span class="side-menu__label">Calendar</span></a>
									</li>
									@endif

									@can('manage notice-board')
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.noticeboard.index') }}">
										<i class="fa fa-warning  sidemenu_icon"></i>
										<span class="side-menu__label">Notice Board</span></a>
									</li>
									@endcan

									@can('manage events')
									<li class="slide">
										<a class="side-menu__item" data-bs-toggle="slide"  href="{{ route('admin.events.index') }}">
										<i class="fa fa-bullhorn  sidemenu_icon"></i>
										<span class="side-menu__label">Events</span></a>
									</li>
									@endcan

									@if(Auth::user()->type == 'company')
										<li class="slide">
											<a class="side-menu__item" data-bs-toggle="slide"  href="javascript:void(0);">
												<i class="fa fa-gears sidemenu_icon"></i>
												<span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i>
											</a>
											<ul class="slide-menu">
											<li class="side-menu-label1"><a  href="javascript:void(0);">Settings</a></li>
												<li><a href="{{ route('admin.company-setting.index') }}" class="slide-item">Settings</a></li>
											</ul>
										</li>
									@endif

								</ul>
								<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
							</div>
						</div>
					</aside>
				</div>
				<!-- APP-SIDEBAR CLOSED -->



            @yield('content')





				
        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © {{ now()->year }} <a  href="https://thynktechs.com/" target="_blank">Thynk Techs</a>All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->
        
        <!-- SIDEBAR-RIGHT -->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="card-header border-bottom pb-5">
                <h4 class="card-title">Notifications </h4>
                <div class="card-options">
                    <a  href="javascript:void(0);" class="btn btn-sm btn-icon btn-light  text-primary"  data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right"><i class="feather feather-x"></i> </a>
                </div>
            </div>
            <div class="">
                <div class="list-group-item  align-items-center border-0">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/4.jpg)"></span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Liam <span class="text-muted font-weight-normal">Sent Message</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>30 mins ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/10.jpg)"></span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Paul<span class="text-muted font-weight-normal"> commented on you post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 hour ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-pink-transparent"><span class="feather feather-shopping-cart"></span></span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">James<span class="text-muted font-weight-normal"> Order Placed</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 day ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/9.jpg)">
                            <span class="avatar-status bg-green"></span>
                        </span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Diane<span class="text-muted font-weight-normal"> New Message Received</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 day ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/5.jpg)">
                            <span class="avatar-status bg-muted"></span>
                        </span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Vinny<span class="text-muted font-weight-normal"> shared your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>2 days ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-primary-transparent">M</span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Mack<span class="text-muted font-weight-normal"> your admin lanuched</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 week ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/12.jpg)">
                            <span class="avatar-status bg-green"></span>
                        </span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Vinny<span class="text-muted font-weight-normal"> shared your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>04 Jan 2021 1:56 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/8.jpg)">	</span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Anna<span class="text-muted font-weight-normal"> likes your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>25 Dec 2020 11:25 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/14.jpg)">	</span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Kimberly<span class="text-muted font-weight-normal"> Completed one task</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>24 Dec 2020 9:30 Pm</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3" style="background-image: url(assets/images/users/3.jpg)">	</span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Rina<span class="text-muted font-weight-normal"> your account has Updated</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>28 Nov 2020 7:16 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-success-transparent">J</span>
                        <div class="mt-1">
                            <a  href="javascript:void(0);" class="font-weight-semibold fs-16">Julia<span class="text-muted font-weight-normal"> Prepare for Presentation</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>18 Nov 2020 11:55 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a  href="javascript:void(0);"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a  href="javascript:void(0);"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SIDEBAR-RIGHT -->    
        
        <!-- CLOCK-IN MODAL -->
        <div class="modal fade"  id="clockinmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="feather feather-clock  me-1"></span>Clock In</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="countdowntimer"><span id="clocktimer" class="border-0"></span></div>
                        <div class="form-group">
                            <label class="form-label">Note:</label>
                            <textarea class="form-control" rows="3">Some text here...</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button  class="btn btn-primary">Clock In</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CLOCK-IN MODAL -->



	            <!-- ADD LEAVE MODAL -->
				<div class="modal fade"  id="addleavemodal">
					<div class="modal-dialog" role="document">
						<form action="{{ route('admin.leavestatus.store') }}" method="POST">
						@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add New Leaves</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Type Of Leaves</label>
										<input class="form-control" name="name" placeholder="Enter leave type">
									</div>
								</div>
								<div class="modal-footer">
									<button  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button  class="btn btn-primary">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- END ADD LEAVE MODAL -->

				            

	  





    </div>

    <!-- BACK TO TOP -->
    <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- MOMENT JS -->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!-- CIRCLE-PROGRESS JS -->
    <script src="{{ asset('assets/plugins/circle-progress/circle-progress.min.js') }}"></script>

    <!--SIDEMENU JS -->
    <script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- P-SCROLL JS -->
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>

    <!--SIDEBAR JS -->
    <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    
    <!-- INTERNAL PEITYCHART JS -->
    <script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.js') }}"></script>

    <!-- INTERNAL VERTICAL-SCROLL JS -->
    <script src="{{ asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js') }}"></script>
    <script src="{{ asset('assets/plugins/vertical-scroll/vertical-scroll.js') }}"></script>

    <!-- INTERNAL  DATEPICKER JS -->
    <script src="{{ asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>

    <!-- INTERNAL CHART JS -->
    <script src="{{ asset('assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL TIMEPICKER JS -->
    <script src="{{ asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/time-picker/toggles.min.js') }}"></script>

    <!-- INTERNAL CHARTJS ROUNDED-BARCHART -->
    <script src="{{ asset('assets/plugins/chart.min/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.min/rounded-barchart.js') }}"></script>

	 <!-- INTERNAL C3 CHARTS JS -->
	 <script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
	 <script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>
	 <script src="{{ asset('assets/plugins/chart/chart.bundle.js') }}"></script>
	 <script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>
	 <script src="{{ asset('assets/js/charts.js') }}"></script>

    <!-- INTERNAL jQUERY-COUNTDOWNTIMER JS  -->
    <script src="{{ asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js') }}"></script>

    <!-- INTERNAL INDEX-1 JS -->
    <script src="{{ asset('assets/js/index1.js') }}"></script>

    <!-- STICKY JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- COLOR THEME JS  -->
    <script src="{{ asset('assets/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

	<!-- INTERNAL INDEX JS -->
	<script src="{{ asset('assets/js/employee/emp-attendance.js') }}"></script>

    <!-- SWITCHER JS -->
    <script src="{{ asset('assets/switcher/js/switcher.js') }}"></script>

	        <!-- INTERNAL DATA TABLES -->
			<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
			<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
			<script src="{{ asset('assets/js/datatables.js') }}"></script>
			<script src="{{ asset('assets/js/select2.js') }}"></script>
			<script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>
			<script src="{{ asset('assets/js/form-elements.js') }}"></script>
			<script src="{{ asset('assets/js/select2.js') }}"></script>
			<!-- INTERNAL FILE-UPLOADS JS -->
			<script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
			<script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
			<script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
			<script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
			<script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

			<!-- INTERNAL FILE-UPLOADS JS -->
			<script src="{{ asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
			<script src="{{ asset('assets/js/filupload.js') }}"></script>

        <!-- INTERNAL  DATEPICKER JS -->
        <script src="{{ asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>

        <!-- INTERNAL INDEX JS -->
        <script src="{{ asset('assets/js/hr/hr-attview.js') }}"></script>

		    <!-- INTERNAL FULL-CALENDAR JS -->
			<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
			<script src="{{ asset('assets/js/app-calendar.js') }}"></script>
				<!-- INTERNAL SUMMERNOTE JS -->
		<script src="{{ asset('assets/plugins/summer-note/summernote1.js') }}"></script>
		<script src="{{ asset('assets/js/summernote.js') }}"></script>

		<!-- INTERNAL QUILL JS -->
		<script src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script>
		<script src="{{ asset('assets/js/form-editor2.js') }}"></script>
		<script src="{{ asset('assets/js/index6.js') }}"></script>

		<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
		<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>
		<script src="{{ asset('assets/plugins/apexchart/apexcharts.js') }}"></script>
		<script src="{{ asset('assets/js/apexchart-custom.js') }}"></script>




	<script>
		tinymce.init({
			selector: '#textarea',
			plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
			toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Author name',
			mergetags_list: [
				{ value: 'First.Name', title: 'First Name' },
				{ value: 'Email', title: 'Email' },
			]
		});
	  </script>



<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); 

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            var isValid = true;
            var currentForm = $(this);

            // Loop through each element with the class 'required-field' within the current form
            currentForm.find('.required-field').each(function() {
                // For input fields and textarea
                if ($(this).is('input') || $(this).is('textarea')) {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                }

                // For select elements
                if ($(this).is('select')) {
                    if ($(this).val() === '' || $(this).val() === null) {
                        // Add red border color for empty select elements
                        $(this).css('border-color', 'red');
                        isValid = false;
                    } else {
                        // Remove red border color for non-empty select elements
                        $(this).css('border-color', '');
                    }
                }
            });

            // If any required field is empty, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>



	@yield('scripts')

</body>

</html>


