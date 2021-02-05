@extends('layouts.layoutVerticalMenu')

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
						<h2 class="content-header-title float-left mb-0">Agendas</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Agendas</a>
								</li>
								<li class="breadcrumb-item active">Detail Agenda
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div class="alert alert-danger alert-dissmisable fade show p-1" style="display:none" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dissmisable">
				<h4 class="alert-heading">Success</h4>
				<div class="alert-body">{{ $message }}</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			@endif
			<div class="row match-height">
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Detail Agenda</h6>
						</div>
						<div class="card-body">
							<h5 class="mb-75">Name:</h5>
							<p class="card-text">{{ $agenda->client->name }}</p>
							<div class="mt-2">
								<h5 class="mb-75">Organization:</h5>
								<p class="card-text">{{ $agenda->client->organization }}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Company:</h5>
								<p class="card-text">{{ $agenda->client->company }}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Session:</h5>
								<p class="card-text"> {{ $agenda_detail->session_name }} </p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Topic:</h5>
								<p class="card-text">{{ $agenda_detail->topic }}</p>
							</div>
						</div>
					</div>
				</div>
				<!--/ Show Detail Agendas -->
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">_______________________________________________________________________________</h6>
						</div>
						<div class="card-body">
							<h5 class="mb-75">Date:</h5>
							<p class="card-text">{{$agenda_detail->date}}</p>
							<div class="mt-2">
								<h5 class="mb-75">Time:</h5>
								<p class="card-text">{{$agenda_detail->time}}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media:</h5>
								<p class="card-text">{{$agenda_detail->media}}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media Url:</h5>
								<p class="card-text">{{$agenda_detail->media_url}}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Duration:</h5>
								<p class="card-text">{{$agenda_detail->duration}} Minutes</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<form action="#" method="#">
						@csrf
						<!-- Input Feedbacks -->
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="fp-default">Feedback</label>
								<textarea class="form-control @error('feedback') is-invalid @enderror" name="feedback"
								id="feedback" value="#" autocomplete="feedback"></textarea>
								@error('feedback')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- /Input Feedback -->
						<button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
						value="create">Submit</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">
$(function () {


});
</script>
@endpush
