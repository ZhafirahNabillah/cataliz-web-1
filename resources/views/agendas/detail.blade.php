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
						<h2 class="content-header-title float-left mb-0">Agenda</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Agenda</a>
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
			<div class="row">
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
								<p class="card-text">{{ $agenda_detail->session_name }}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Topic:</h5>
								<p class="card-text">{{ $agenda_detail->topic }}	@if($agenda_detail->topic == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Date:</h5>
								<p class="card-text">{{$agenda_detail->date}}	@if($agenda_detail->date == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Time:</h5>
								<p class="card-text">{{$agenda_detail->time}}	@if($agenda_detail->time == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media:</h5>
								<p class="card-text">{{$agenda_detail->media}}	@if($agenda_detail->media == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media Url:</h5>
								<p class="card-text">{{$agenda_detail->media_url}}	@if($agenda_detail->media_url == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Duration:</h5>
								<p class="card-text">{{$agenda_detail->duration}}	@if($agenda_detail->duration == null) - @endif Menit</p>
							</div>
						</div>
					</div>
				</div>
				<!--/ Show Detail Agendas -->
				<div class="col-sm-12 col-md-6">
					<form action="{{ route('agendas.agenda_detail_update',$agenda_detail->id) }}" method="post" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Feedback</h6>
							</div>
							<div class="card-body">
								@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) > (\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
								<span>Feedback belum tersedia</span>
								@elseif($agenda_detail->status == 'canceled')
								<span>Feedback tidak tersedia</span>
								@else
								<div class="row">
									@csrf
									<div class="col-md-12 form-group">
										<label for="fp-default">Feedback</label>
										@if($agenda_detail->feedback == null)
										<textarea class="form-control @error('feedback') is-invalid @enderror" name="feedback"></textarea>
										@endif
										@error('feedback')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										@if($agenda_detail->feedback != null)
										<div class="overflow-auto p-2" style="max-height: 300px;">
											{!! $agenda_detail->feedback !!}
										</div>
										@endif
									</div>
									<div class="col-md-12 form-group">
										<label for="customFile1">Attachment file</label>
										@if($agenda_detail->attachment == null)
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="feedback_attachment"/>
											<label class="custom-file-label" for="customFile1">Choose file</label>
										</div>
										@endif
										@if($agenda_detail->attachment != null)
										<div class="row">
											<div class="col-md-10">
												<input type="text" class="form-control" value="{{ $agenda_detail->attachment }}" disabled>
											</div>
											<a href="{{ route('agendas.feedback_download',$agenda_detail->id) }}" class="btn btn-primary col-auto">Download</a>
										</div>
										@endif
									</div>

								</div>
								@endif
							</div>
						</div>
						@if($coaching_note == null)
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Notes</h6>
							</div>
							<div class="card-body">
								@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) > (\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
								<span>Notes belum tersedia</span>
								@elseif($agenda_detail->status == 'canceled')
								<span>Notes tidak tersedia</span>
								@else
								<div class="row">
									@csrf
									<div class="col-md-12 form-group">
										<label for="fp-default">Subject</label>
										<input type="text" class="form-control @error('feedback') is-invalid @enderror" name="subject">
										@error('feedback')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<label for="fp-default">Summary</label>
										<textarea class="form-control @error('summary') is-invalid @enderror" name="summary"></textarea>
										@error('summary')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<label for="customFile1">Attachment file</label>
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="note_attachment"/>
											<label class="custom-file-label" for="customFile1">Choose file</label>
										</div>
									</div>
								</div>
								@endif
							</div>
						</div>
						@elseif($coaching_note != null)
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Notes</h6>
							</div>
							<div class="card-body">
								@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) < (\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
								<span>Notes belum tersedia</span>
								@elseif($agenda_detail->status == 'canceled')
								<span>Notes tidak tersedia</span>
								@else
								<div class="row">
									@csrf
									<div class="col-md-12 form-group">
										<label for="fp-default">Subject</label>
										<input type="text" class="form-control @error('feedback') is-invalid @enderror" name="subject" value="{{$coaching_note->subject}}">
										@error('feedback')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<label for="fp-default">Summary</label>
										<textarea class="form-control @error('summary') is-invalid @enderror" name="summary">{{$coaching_note->summary}}</textarea>
										@error('summary')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-md-12 form-group">
										<label for="customFile1">Attachment file</label>
										@if($coaching_note->attachment == null)
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="note_attachment"/>
											<label class="custom-file-label" for="customFile1">Choose file</label>
										</div>
										@endif
										@if($coaching_note->attachment != null)
										<div class="row">
											<div class="col-md-10">
												<input type="text" class="form-control" value="{{ $coaching_note->attachment }}" disabled>
											</div>
											<a href="{{ route('agendas.note_download',$coaching_note->id) }}" class="btn btn-primary col-auto">Download</a>
										</div>
										@endif
									</div>
								</div>
								@endif
							</div>
						</div>
						@endif
						@if((($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled' || $agenda_detail->status == 'finished') && ($agenda_detail->date.' '.$agenda_detail->time) < (\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary data-submit" id="saveBtn" >Submit</button>
						</div>
						@endif
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush
