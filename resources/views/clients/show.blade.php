@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
@endpush

@section('title','Client')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="content-header-title float-left mb-0">Profile</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="{{route('clients.index')}}">Client</a>
								</li>
								<li class="breadcrumb-item active">{{$client->name}}
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
				<div class="form-group breadcrumb-right">
					<div class="dropdown">
						<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
						<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div id="user-profile">
				<!-- profile header -->
				<div class="row">
					<div class="col-12">
						<div class="card profile-header mb-2">
							<!-- profile cover photo -->
							<img class="card-img-top" src="https://image.freepik.com/free-photo/cyborg-hand-holding-bulb-lamp-idea-concept-with-start-up-icon-connected-3d-rendering_110893-1792.jpg" alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="{{asset('assets/images/avatars/cataliz.jpg') }}" class="rounded img-fluid" alt="Card image" />
									</div>
									<!-- profile title -->
									<div class="profile-title ml-3">
										<h2 class="text-white">{{$client->name}}</h2>
										<p class="text-white">{{$client->occupation}} {{$client->company}}</p>
									</div>
								</div>
							</div>

							<!-- tabs pill -->
							<div class="profile-header-nav">
								<!-- navbar -->
								<nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
									<button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Home</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#session" aria-controls="profile" role="tab" aria-selected="false">Sessions</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingPlan" aria-controls="profile" role="tab" aria-selected="false">Coaching Plans</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachingNotes" aria-controls="profile" role="tab" aria-selected="false">Coaching Notes</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile" role="tab" aria-selected="false">Feedbacks</a>
												</li>

											</ul>

											<!-- edit button -->
											<a href="javascript:;"class="btn btn-primary editClient" data-id={{$client->id}}>
												<span class="font-weight-bold d-none d-md-block">Edit</span>
											</a>
										</div>
									</div>
									<!--/ collapse  -->
								</nav>
								<!--/ navbar -->
							</div>
						</div>
					</div>
				</div>
				<!--/ profile header -->

				<div class="tab-content">
					<div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
						<!-- profile info section -->
						<section id="profile-info">
							<div class="row">
								<!-- left profile info section -->
								<div class="col-lg-4 col-12 order-2 order-lg-1">
									<!-- about -->
									<div class="card">
										<div class="card-body">
											<h5 class="mb-75">Joined:</h5>
											<p class="card-text">{{\Carbon\Carbon::parse($client->created_at)->format('F d, Y')}}</p>

											<div class="mt-2">
												<h5 class="mb-75">Phone:</h5>
												<p class="card-text">+62{{$client->phone}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Email:</h5>
												<p class="card-text">{{$client->email}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-75">Company:</h5>
												<p class="card-text">{{$client->company}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-50">Occupation:</h5>
												<p class="card-text mb-0">{{$client->occupation}}</p>
											</div>
											<div class="mt-2">
												<h5 class="mb-50">Website:</h5>
												<p class="card-text mb-0">www.pixinvent.com</p>
											</div>
										</div>
									</div>
									<!--/ about -->
								</div>
								<!--/ left profile info section -->

								<!-- center profile info section -->

								<div class="col-lg-8 col-12 order-1 order-lg-2">

									<div class="row match-height">

										<!-- Subscribers Chart Card starts -->
										<div class="col-lg-6 col-sm-6 col-12">
											<div class="card">
												<div class="card-header flex-column align-items-start pb-0">
													<div class="avatar bg-light-primary p-50 m-0">
														<div class="avatar-content">

															<img width="14" height="14" src="assets\images\icons\Group 74.jpg" alt="Card image cap" />
														</div>
													</div>
													<h2 class="font-weight-bolder mt-1">92.6k</h2>
													<p class="card-text">Subscribers Gained</p>
												</div>
												<div id="gained-chart" style="min-height: 100px;"><div id="apexcharts5fabf9yah" class="apexcharts-canvas apexcharts5fabf9yah apexcharts-theme-light" style="width: 350px; height: 100px;"><svg id="SvgjsSvg1367" width="225" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1369" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1368"><clipPath id="gridRectMask5fabf9yah"><rect id="SvgjsRect1374" width="231.5" height="102.5" x="-3.25" y="-1.25" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask5fabf9yah"><rect id="SvgjsRect1375" width="229" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1380" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1381" stop-opacity="0.7" stop-color="rgba(115,103,240,0.7)" offset="0"></stop><stop id="SvgjsStop1382" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="0.8"></stop><stop id="SvgjsStop1383" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1373" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1386" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1387" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1389" class="apexcharts-grid"><g id="SvgjsG1390" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1392" x1="0" y1="0" x2="225" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1393" x1="0" y1="20" x2="225" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1394" x1="0" y1="40" x2="225" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1395" x1="0" y1="60" x2="225" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1396" x1="0" y1="80" x2="225" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1397" x1="0" y1="100" x2="225" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1391" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1399" x1="0" y1="100" x2="225" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1398" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1376" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1377" class="apexcharts-series" seriesName="Subscribers" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1384" d="M 0 100L 0 77.77777777777777C 13.125 77.77777777777777 24.375 51.111111111111114 37.5 51.111111111111114C 50.625 51.111111111111114 61.875 60 75 60C 88.125 60 99.37499999999999 24.444444444444443 112.49999999999999 24.444444444444443C 125.62499999999999 24.444444444444443 136.875 55.55555555555556 150 55.55555555555556C 163.125 55.55555555555556 174.375 6.666666666666657 187.5 6.666666666666657C 200.625 6.666666666666657 211.87499999999997 17.777777777777786 224.99999999999997 17.777777777777786C 224.99999999999997 17.777777777777786 224.99999999999997 17.777777777777786 224.99999999999997 100M 224.99999999999997 17.777777777777786z" fill="url(#SvgjsLinearGradient1380)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask5fabf9yah)" pathTo="M 0 100L 0 77.77777777777777C 13.125 77.77777777777777 24.375 51.111111111111114 37.5 51.111111111111114C 50.625 51.111111111111114 61.875 60 75 60C 88.125 60 99.37499999999999 24.444444444444443 112.49999999999999 24.444444444444443C 125.62499999999999 24.444444444444443 136.875 55.55555555555556 150 55.55555555555556C 163.125 55.55555555555556 174.375 6.666666666666657 187.5 6.666666666666657C 200.625 6.666666666666657 211.87499999999997 17.777777777777786 224.99999999999997 17.777777777777786C 224.99999999999997 17.777777777777786 224.99999999999997 17.777777777777786 224.99999999999997 100M 224.99999999999997 17.777777777777786z" pathFrom="M -1 140L -1 140L 37.5 140L 75 140L 112.49999999999999 140L 150 140L 187.5 140L 224.99999999999997 140"></path><path id="SvgjsPath1385" d="M 0 77.77777777777777C 13.125 77.77777777777777 24.375 51.111111111111114 37.5 51.111111111111114C 50.625 51.111111111111114 61.875 60 75 60C 88.125 60 99.37499999999999 24.444444444444443 112.49999999999999 24.444444444444443C 125.62499999999999 24.444444444444443 136.875 55.55555555555556 150 55.55555555555556C 163.125 55.55555555555556 174.375 6.666666666666657 187.5 6.666666666666657C 200.625 6.666666666666657 211.87499999999997 17.777777777777786 224.99999999999997 17.777777777777786" fill="none" fill-opacity="1" stroke="#7367f0" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask5fabf9yah)" pathTo="M 0 77.77777777777777C 13.125 77.77777777777777 24.375 51.111111111111114 37.5 51.111111111111114C 50.625 51.111111111111114 61.875 60 75 60C 88.125 60 99.37499999999999 24.444444444444443 112.49999999999999 24.444444444444443C 125.62499999999999 24.444444444444443 136.875 55.55555555555556 150 55.55555555555556C 163.125 55.55555555555556 174.375 6.666666666666657 187.5 6.666666666666657C 200.625 6.666666666666657 211.87499999999997 17.777777777777786 224.99999999999997 17.777777777777786" pathFrom="M -1 140L -1 140L 37.5 140L 75 140L 112.49999999999999 140L 150 140L 187.5 140L 224.99999999999997 140"></path><g id="SvgjsG1378" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1405" r="0" cx="0" cy="0" class="apexcharts-marker wpn16ib2 no-pointer-events" stroke="#ffffff" fill="#7367f0" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1379" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1400" x1="0" y1="0" x2="225" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1401" x1="0" y1="0" x2="225" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1402" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1403" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1404" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1372" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1388" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1370" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 50px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(115, 103, 240);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
												<div class="resize-triggers"><div class="expand-trigger"><div style="width: 226px; height: 238px;"></div></div><div class="contract-trigger"></div></div></div>
											</div>
											<!-- Subscribers Chart Card ends -->

											<!-- Orders Chart Card starts -->
											<div class="col-lg-6 col-sm-6 col-12">
												<div class="card">
													<div class="card-header flex-column align-items-start pb-0">
														<div class="avatar bg-light-warning p-50 m-0">
															<div class="avatar-content">
																<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package font-medium-5"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
															</div>
														</div>
														<h2 class="font-weight-bolder mt-1">38.4K</h2>
														<p class="card-text">Orders Received</p>
													</div>
													<div id="order-chart" style="min-height: 100px;"><div id="apexchartsxbnk5acc" class="apexcharts-canvas apexchartsxbnk5acc apexcharts-theme-light" style="width: 225px; height: 100px;"><svg id="SvgjsSvg1407" width="225" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1409" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1408"><clipPath id="gridRectMaskxbnk5acc"><rect id="SvgjsRect1414" width="231.5" height="102.5" x="-3.25" y="-1.25" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskxbnk5acc"><rect id="SvgjsRect1415" width="229" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1420" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1421" stop-opacity="0.7" stop-color="rgba(255,159,67,0.7)" offset="0"></stop><stop id="SvgjsStop1422" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="0.8"></stop><stop id="SvgjsStop1423" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1413" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1426" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1427" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1429" class="apexcharts-grid"><g id="SvgjsG1430" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1432" x1="0" y1="0" x2="225" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1433" x1="0" y1="20" x2="225" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1434" x1="0" y1="40" x2="225" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1435" x1="0" y1="60" x2="225" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1436" x1="0" y1="80" x2="225" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1437" x1="0" y1="100" x2="225" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1431" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1439" x1="0" y1="100" x2="225" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1438" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1416" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1417" class="apexcharts-series" seriesName="Orders" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1424" d="M 0 100L 0 60C 13.125 60 24.375 10 37.5 10C 50.625 10 61.875 80 75 80C 88.125 80 99.37499999999999 10 112.49999999999999 10C 125.62499999999999 10 136.875 90 150 90C 163.125 90 174.375 40 187.5 40C 200.625 40 211.87499999999997 80 224.99999999999997 80C 224.99999999999997 80 224.99999999999997 80 224.99999999999997 100M 224.99999999999997 80z" fill="url(#SvgjsLinearGradient1420)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskxbnk5acc)" pathTo="M 0 100L 0 60C 13.125 60 24.375 10 37.5 10C 50.625 10 61.875 80 75 80C 88.125 80 99.37499999999999 10 112.49999999999999 10C 125.62499999999999 10 136.875 90 150 90C 163.125 90 174.375 40 187.5 40C 200.625 40 211.87499999999997 80 224.99999999999997 80C 224.99999999999997 80 224.99999999999997 80 224.99999999999997 100M 224.99999999999997 80z" pathFrom="M -1 160L -1 160L 37.5 160L 75 160L 112.49999999999999 160L 150 160L 187.5 160L 224.99999999999997 160"></path><path id="SvgjsPath1425" d="M 0 60C 13.125 60 24.375 10 37.5 10C 50.625 10 61.875 80 75 80C 88.125 80 99.37499999999999 10 112.49999999999999 10C 125.62499999999999 10 136.875 90 150 90C 163.125 90 174.375 40 187.5 40C 200.625 40 211.87499999999997 80 224.99999999999997 80" fill="none" fill-opacity="1" stroke="#ff9f43" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskxbnk5acc)" pathTo="M 0 60C 13.125 60 24.375 10 37.5 10C 50.625 10 61.875 80 75 80C 88.125 80 99.37499999999999 10 112.49999999999999 10C 125.62499999999999 10 136.875 90 150 90C 163.125 90 174.375 40 187.5 40C 200.625 40 211.87499999999997 80 224.99999999999997 80" pathFrom="M -1 160L -1 160L 37.5 160L 75 160L 112.49999999999999 160L 150 160L 187.5 160L 224.99999999999997 160"></path><g id="SvgjsG1418" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1445" r="0" cx="0" cy="0" class="apexcharts-marker wgiv25d8q no-pointer-events" stroke="#ffffff" fill="#ff9f43" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1419" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1440" x1="0" y1="0" x2="225" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1441" x1="0" y1="0" x2="225" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1442" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1443" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1444" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1412" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1428" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1410" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 50px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 159, 67);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
													<div class="resize-triggers"><div class="expand-trigger"><div style="width: 226px; height: 238px;"></div></div><div class="contract-trigger"></div></div></div>
												</div>
												<!-- Orders Chart Card ends -->
											</div>


											<div class="row">
												<div class="col-lg-6 col-12 order-1 order-lg-2">
													<!-- post 1 -->
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-start align-items-center mb-1">
																<div class="profile-user-info">
																	<h6 class="mb-0">Sessions</h6>
																</div>
															</div>
															<p class="card-text">
																Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
																can make the difference when presenting to clients who are looking for the perfect fit.
															</p>
														</div>
													</div>
													<!--/ post 1 -->

													<!-- post 2 -->
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-start align-items-center mb-1">
																<div class="profile-user-info">
																	<h6 class="mb-0">Coaching Plans</h6>
																</div>
															</div>
															<p class="card-text">
																Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
																can make the difference when presenting to clients who are looking for the perfect fit.
															</p>
														</div>
													</div>
													<!--/ post 2 -->
												</div>

												<div class="col-lg-6 col-12 order-1 order-lg-2">
													<!-- post 1 -->
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-start align-items-center mb-1">
																<div class="profile-user-info">
																	<h6 class="mb-0">Sessions</h6>
																</div>
															</div>
															<p class="card-text">
																Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
																can make the difference when presenting to clients who are looking for the perfect fit.
															</p>
														</div>
													</div>
													<!--/ post 1 -->

													<!-- post 2 -->
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-start align-items-center mb-1">
																<div class="profile-user-info">
																	<h6 class="mb-0">Coaching Plans</h6>
																</div>
															</div>
															<p class="card-text">
																Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
																can make the difference when presenting to clients who are looking for the perfect fit.
															</p>
														</div>
													</div>
													<!--/ post 2 -->
												</div>
											</div>
										</div>
										<!--/ center profile info section -->
									</div>

								</section>
								<!--/ profile info section -->
							</div>
							<div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
								<p>
									Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
									Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
									brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
								</p>
								<p>
									Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
									danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
								</p>
							</div>
							<div class="tab-pane" id="disabled" aria-labelledby="disabled-tab" role="tabpanel">
								<p>
									Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar biscuit
									tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet bear claw.
								</p>
							</div>
							<div class="tab-pane" id="about" aria-labelledby="about-tab" role="tabpanel">
								<p>
									Gingerbread cake cheesecake lollipop topping bonbon chocolate sesame snaps. Dessert macaroon bonbon
									carrot cake biscuit. Lollipop lemon drops cake gingerbread liquorice. Sweet gummies dragée. Donut bear
									claw pie halvah oat cake cotton candy sweet roll. Cotton candy sweet roll donut ice cream.
								</p>
								<p>
									Halvah bonbon topping halvah ice cream cake candy. Wafer gummi bears chocolate cake topping powder.
									Sweet marzipan cheesecake jelly-o powder wafer lemon drops lollipop cotton candy.
								</p>
							</div>

							<!-- tab Session -->

							<div class="tab-pane" id="session" aria-labelledby="about-tab" role="tabpanel">
								<div class="content-header row">
									<div class="content-header-left col-md-9 col-12 mb-2">
										<div class="row breadcrumbs-top">
											<div class="col-12">
												<h4 class="breadcrumb-item active">Sessions</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card">

									<section id="basic-datatable">
										<div class="row">
											<div class="col-12">
												<div class="card">
													<table class="datatables-basic table yajra-datatable-1">
														<thead>
															<tr>
																<th>NO</th>
																<th>TOPIC</th>
																<th>SESSION</th>
																<th>Date</th>
																<th>TIME</th>
																<th>DURATION</th>
																<th>ACTION</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
							<!-- /tab Session -->
							<!-- Tab coaching plans -->

							<div class="tab-pane" id="coachingPlan" aria-labelledby="about-tab" role="tabpanel">
								<div class="content-header row">
									<div class="content-header-left col-md-9 col-12 mb-2">
										<div class="row breadcrumbs-top">
											<div class="col-12">
												<h4 class="breadcrumb-item active">Coaching Plans</h4>
											</div>
										</div>
									</div>
								</div>
								<div class="card">

									<section id="basic-datatable">
										<div class="row">
											<div class="col-12">
												<div class="card">
													<table class="datatables-basic table yajra-datatable-2">
														<thead>
															<tr>
																<th>NO</th>
																<th>OBJEKTIF</th>
																<th>Tanggal Pelaksanaan</th>
																<th>ACTION</th>
															</tr>
														</thead>
														<tbody>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- /tab coaching plans -->
									</div>
								</div>

								<!-- Tab coaching Notes -->
								<div class="tab-pane" id="coachingNotes" aria-labelledby="about-tab" role="tabpanel">
									<div class="content-header row">
										<div class="content-header-left col-md-9 col-12 mb-2">
											<div class="row breadcrumbs-top">
												<div class="col-12">
													<h4 class="breadcrumb-item active">Coaching Notes</h4>
												</div>
											</div>
										</div>
									</div>
									@foreach($coaching_note as $data)
										<!-- coaching note card -->
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<div class="card">
													<div class="card-body">
														<div class="row align-items-center">
															<div class="col-md-6">
																<h5 class="card-title mb-0" id="detailNotes"
																data-target="detailNotes" >{{$data->subject}}</h5>
																<small class="text-muted">created at {{$data->created_at}}</small>
															</div>
															<div class="col-md-6 text-right">
																<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#show_note_{{$data->id}}">
																	Detail
																</button>
															</div>
														</div>
														<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
													</div>
												</div>
											</div>
										</div>
										<!-- /tab coaching note -->


										<!-- coaching note detail modal -->
										<div class="modal fade" id="show_note_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle">Detail Note</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="container">
															<div class="row">
																<div class="card-body">
																		<dl class="row">
																			<dt class="col-sm-3">Subject</dt>
																			<dd class="col-sm-9">{{$data->subject}}</dd>
																		</dl>
																		<dl class="row">
																			<dt class="col-sm-3">Created at</dt>
																			<dd class="col-sm-9">{{$data->created_at}}</dd>
																		</dl>
																		<dl class="row">
																			<dt class="col-sm-3">Session</dt>
																			<dd class="col-sm-9">#</dd>
																		</dl>
																		<dl class="row">
																			<dt class="col-sm-3">Note</dt>
																			<span class="d-block my-1"></span>
																			<dd class="col-sm-9 text-justify">	{!! $data->summary !!}</dd>
																		</dl>
																		<div class="col-md-12">
																			<small class="d-block text-muted">Note Attachment</small>
																			@if($data->attachment != null)
																				<span class="d-block my-1">{{$data->attachment}}</span>
																				<a href="#" class="btn btn-primary">Download</a>
																			@else
																				<span class="d-block font-italic">Tidak ada file</span>
																			@endif
																		</div>
																	</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
								<!-- /tab coaching Notes-->

								<!-- Tab Feedback -->
								<div class="tab-pane" id="feedback" aria-labelledby="about-tab" role="tabpanel">
									<div class="content-header row">
										<div class="content-header-left col-md-9 col-12 mb-2">
											<div class="row breadcrumbs-top">
												<div class="col-12">
													<h4 class="breadcrumb-item active">Detail Feedback</h4>
												</div>
											</div>
										</div>
									</div>
										<!-- Feedback card -->
										<div class="row">
											<div class="col-sm-12 col-md-12">
												<div class="card">
													<div class="card-body">
														<div class="row align-items-center">
															<div class="col-md-12">
																<h5 class="card-title mb-0" id="detailNotes"
																data-target="detailNotes" >Topic Session: </h5>
																<small class="text-muted">created at </small>
																<p class="text-justify" >Feedback session Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. </p>
															</div>
															<div class="col-md-6 text-right ">
																<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#show_feedback">
																	Detail
																</button>
															</div>
														</div>
														<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
													</div>
												</div>
											</div>
										</div>
										<!-- /Feedback note -->

								<!-- Feedback detail modal -->
								<div class="modal fade" id="show_feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Feedback</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="container">
																<div class="row">
																	<div class="card-body">
																			<dl class="row">
														            <dt class="col-sm-3">Topic</dt>
														            <dd class="col-sm-9">Belajar Laravel</dd>
														          </dl>
																			<dl class="row">
														            <dt class="col-sm-3">Created at</dt>
														            <dd class="col-sm-9">2021-02-09 03:06:45</dd>
														          </dl>
																			<dl class="row">
														            <dt class="col-sm-3">Session</dt>
														            <dd class="col-sm-9">3</dd>
														          </dl>
																			<dl class="row">
														            <dt class="col-sm-3">Feedback</dt>
																				<span class="d-block my-1"></span>
														            <dd class="col-sm-9 text-justify">Feedback Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci.</dd>
														          </dl>
																			<dl class="row">
														            <small class="col-sm-6 d-block text-muted">Note Attachment</small>
														          </dl>
																			<dl class="row">
																				<span class="d-block my-1"></span>
																				<a href="#" class="btn btn-primary">Download</a>
																				<span class="d-block font-italic">Tidak ada file</span>
														          </dl>
																		</div>
																</div>
															</div>
															</div>
													</div>
												</div>
											</div>
									</div>
									<!-- /modal Feedback-->


								<!--End profile-->
							</div>
							<!---End Content Body -->

							<!-- Modal to add new record -->
							<div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
								<div class="modal-dialog sidebar-sm">
									<form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
										<div class="modal-header mb-1">
											<h5 class="modal-title" id="modalHeading"></h5>
										</div>
										<input type="hidden" name="Client_id" id="Client_id">
										<div class="modal-body flex-grow-1">
											<div class="form-group">
												<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
												<input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
											</div>
											<label class="form-label" for="basic-icon-default-post">Phone</label>
											<div class="input-group input-group-merge mb-2">
												<div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon5">+62</span>
												</div>
												<input id="phone" name="phone" type="text" class="form-control" placeholder="81xxxxxxx" aria-label="Phone" >
											</div>
											<div class="form-group">
												<label class="form-label" for="basic-icon-default-email">Email</label>
												<input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
												<small class="form-text text-muted"> You can use letters, numbers & periods </small>
											</div>
											<div class="form-group">
												<label class="form-label" for="basic-icon-default-fullname">Organization</label>
												<input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Inbis Sample" aria-label="John Doe" />
											</div>
											<div class="form-group">
												<label class="form-label" for="basic-icon-default-fullname">Company</label>
												<input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Startup Name" aria-label="John Doe" />
											</div>
											<div class="form-group">
												<label class="form-label" for="basic-icon-default-fullname">Occupation</label>
												<input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="CEO" aria-label="John Doe" />
											</div>

											<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
											<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
										</div>
										<!-- </form>-->
									</div>
								</div>
								<!-- End Modal -->

							</div>
						</div>
						<!-- END: Content-->
						@endsection

						@push('scripts')

						<script type="text/javascript">
						$(function () {

							//ajax declaration with csrf
							$.ajaxSetup({
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								}
							});

							//datatable for sessions table
							var table = $('.yajra-datatable-1').DataTable({
								processing: true,
								serverSide: true,
								ajax: "{{route('clients.show_agendas', $client->id)}}",
								columns: [
									{data: 'DT_RowIndex', name: 'DT_RowIndex'},
									{data: 'topic', name: 'topic', defaultContent: '<i>-</i>'},
									{data: 'session_name', name: 'session_name'},
									{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
									{data: 'time', name: 'time', defaultContent: '<i>-</i>'},
									{
										data: 'duration',
										name: 'duration'
									},
									{
										data: 'action',
										name: 'action',
										orderable: true,
										searchable: true
									},
								],
								dom:
								'<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
								language: {
									paginate: {
										// remove previous & next text from pagination
										previous: '&nbsp;',
										next: '&nbsp;'
									},
									search: "<i data-feather='search'></i>",
									searchPlaceholder: "Search records"
								}
							});

							//datatable for plans table
							var table = $('.yajra-datatable-2').DataTable({
								processing: true,
								serverSide: true,
								ajax: "{{route('clients.show_plans', $client->id)}}",
								columns: [
									{data: 'DT_RowIndex', name: 'DT_RowIndex'},
									{data: 'objective', name: 'objective', defaultContent: '<i>-</i>'},
									{data: 'date', name: 'date'},
									{
										data: 'action',
										name: 'action',
										orderable: true,
										searchable: true
									},
								],
								dom:
								'<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
								language: {
									paginate: {
										// remove previous & next text from pagination
										previous: '&nbsp;',
										next: '&nbsp;'
									},
									search: "<i data-feather='search'></i>",
									searchPlaceholder: "Search records"
								}
							});

							// edit
							$('.editClient').click(function () {
								var Client_id = $(this).data('id');
								$.get("" +'/clients/' + Client_id +'/edit', function (data) {
									$('#modalHeading').html("Edit Client");
									$('#saveBtn').val("edit-user");
									$('#modals-slide-in').modal('show');
									$('#Client_id').val(data.id);
									$('#name').val(data.name);
									$('#phone').val(data.phone);
									$('#email').val(data.email);
									$('#company').val(data.company);
									$('#organization').val(data.organization);
									$('#occupation').val(data.occupation);
								})
							});
						});
						</script>
						@endpush
