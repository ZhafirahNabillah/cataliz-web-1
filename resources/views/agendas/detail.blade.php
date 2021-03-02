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
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
						aria-hidden="true">×</span></button>
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
								<p class="card-text">{{ $agenda_detail->session_name }}</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Topic:</h5>
								<p class="card-text">{{ $agenda_detail->topic }} @if($agenda_detail->topic == null) - @endif</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="card-header">
							<h7 class="card-title"> </h7>
						</div>
						<div class="card-body">
							<h5 class="mb-75">Date:</h5>
							<p class="card-text">{{$agenda_detail->date}} @if($agenda_detail->date == null) - @endif</p>
							<div class="mt-2">
								<h5 class="mb-75">Time:</h5>
								<p class="card-text">{{$agenda_detail->time}} @if($agenda_detail->time == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media:</h5>
								<p class="card-text">{{$agenda_detail->media}} @if($agenda_detail->media == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Media Url:</h5>
								<p class="card-text">{{$agenda_detail->media_url}} @if($agenda_detail->media_url == null) - @endif</p>
							</div>
							<div class="mt-2">
								<h5 class="mb-75">Duration:</h5>
								<p class="card-text">{{$agenda_detail->duration}} @if($agenda_detail->duration == null) - @endif Menit
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ Show Detail Agendas -->
			@role('coachee')
			<div class="row match-height">
				<div class="col-sm-12 col-md-12">
					<form class="" action="{{ route('add_feedback_from_coachee', $agenda_detail->id) }}" method="post"
						enctype="multipart/form-data">
						@csrf
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Feedback</h6>
							</div>
							<div class="card-body">
								@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' ||
								$agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) >
								(\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
								<span>Feedback belum tersedia</span>
								@elseif($agenda_detail->status == 'canceled')
								<span>Feedback tidak tersedia</span>
								@else
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="fp-default">Feedback</label>
										@if($agenda_detail->feedback_from_coachee == null)
										<textarea class="form-control" name="feedback"></textarea>
										@endif
										@if($agenda_detail->feedback_from_coachee != null)
										<div class="overflow-auto p-2" style="max-height: 300px;">
											{!! $agenda_detail->feedback_from_coachee !!}
										</div>
										@endif
									</div>
									<div class="col-md-12 form-group">
										<label for="customFile1">Attachment file</label>
										@if($agenda_detail->attachment_from_coachee == null)
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="feedback_attachment" />
											<label class="custom-file-label" for="customFile1">Choose file</label>
										</div>
										@error('feedback_attachment')
										<strong class="text-danger">{{ $message }}</strong>
										@enderror
										@endif
										@if($agenda_detail->attachment_from_coachee != null)
										<div class="row">
											<div class="col-md-10">
												<input type="text" class="form-control" value="{{ $agenda_detail->attachment_from_coachee }}"
													disabled>
											</div>
											<a href="{{ route('agendas.feedback_download',$agenda_detail->id) }}"
												class="btn btn-primary col-auto">Download</a>
										</div>
										@endif
									</div>
								</div>
								@endif
							</div>
						</div>

						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Rating coach</h6>
							</div>
							<div class="card-body">
								@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' ||
								$agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) >
								(\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
								<span>Rating belum tersedia</span>
								@elseif($agenda_detail->status == 'canceled')
								<span>Rating tidak tersedia</span>
								@else
								<div class="row justify-content-md-center">
									@if ($agenda_detail->rating_from_coachee == null)
									<div id="rateYo"></div>
									@else
									<div id="rateYo" data-rating="{{ $agenda_detail->rating_from_coachee }}"></div>
									@endif
									<input name="coach_rating" id="coach_rating" type="hidden" value="">
								</div>
								@endif
							</div>
						</div>

						@if(($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled' ||
						$agenda_detail->status == 'finished') && ($agenda_detail->feedback_from_coachee == null || $agenda_detail->attachment_from_coachee == null || $agenda_detail->rating_from_coachee == null) && (($agenda_detail->date.' '.$agenda_detail->time) <
							(\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
							<div class="row">
								<div class="col-md-12 text-left">
									<a href="{{route('agendas.index')}}" class="btn btn-secondary">Kembali</a>
									<button type="submit" class="btn btn-primary data-submit" id="saveBtn">Submit</button>
								</div>
							</div>
							@endif
					</form>
				</div>
			</div>
			@endrole



			@role('coach')
			<form action="{{ route('agendas.agenda_detail_update',$agenda_detail->id) }}" method="post"
				enctype="multipart/form-data">
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Feedback</h6>
					</div>
					<div class="card-body">
						@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' ||
						$agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) >
						(\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
						<span>Feedback belum tersedia</span>
						@elseif($agenda_detail->status == 'canceled')
						<span>Feedback tidak tersedia</span>
						@else
						<div class="row">
							<div class="col-md-12 form-group">
								<label for="fp-default">Feedback</label>
								@if($agenda_detail->feedback_from_coach == null)
								<textarea class="form-control" name="feedback"></textarea>
								@endif
								@if($agenda_detail->feedback_from_coach != null)
								<div class="overflow-auto p-2" style="max-height: 300px;">
									{!! $agenda_detail->feedback_from_coach !!}
								</div>
								@endif
							</div>
							<div class="col-md-12 form-group">
								<label for="customFile1">Attachment file</label>
								@if($agenda_detail->attachment_from_coach == null)
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="feedback_attachment" />
									<label class="custom-file-label" for="customFile1">Choose file</label>
								</div>
								@error('feedback_attachment')
								<strong class="text-danger">{{ $message }}</strong>
								@enderror
								@endif
								@if($agenda_detail->attachment_from_coach != null)
								<div class="row">
									<div class="col-md-10">
										<input type="text" class="form-control" value="{{ $agenda_detail->attachment_from_coach }}"
											disabled>
									</div>
									<a href="{{ route('agendas.feedback_download',$agenda_detail->id) }}"
										class="btn btn-primary col-auto">Download</a>
								</div>
								@endif
							</div>
						</div>
						@endif
					</div>
				</div>
				@if($coaching_note == null)
				<div class=" card">
					<div class="card-header">
						<h6 class="card-title">Notes</h6>
					</div>
					<div class="card-body">
						@if($agenda_detail->status == 'unschedule' || (($agenda_detail->status == 'scheduled' ||
						$agenda_detail->status == 'rescheduled') && ($agenda_detail->date.' '.$agenda_detail->time) >
						(\Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
						<span>Notes belum tersedia</span>
						@elseif($agenda_detail->status == 'canceled')
						<span>Notes tidak tersedia</span>
						@else
						<div class="row">
							@csrf
							<div class="col-md-12 form-group">
								<label for="fp-default">Subject</label>
								<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject">
								@error('subject')
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
									<input type="file" class="custom-file-input" name="note_attachment" />
									<label class="custom-file-label" for="customFile1">Choose file</label>
								</div>
								@error('note_attachment')
								<strong class="text-danger">{{ $message }}</strong>
								@enderror
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
						<div class="row">
							@csrf
							<div class="col-md-12 form-group">
								<label for="fp-default">Subject</label>
								<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
									value="{{$coaching_note->subject}}">
								@error('subject')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<label for="fp-default">Summary</label>
								<textarea class="form-control @error('summary') is-invalid @enderror"
									name="summary">{{$coaching_note->summary}}</textarea>
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
									<input type="file" class="custom-file-input" name="note_attachment" />
									<label class="custom-file-label" for="customFile1">Choose file</label>
								</div>
								@error('note_attachment')
								<strong class="text-danger">{{ $message }}</strong>
								@enderror
								@endif
								@if($coaching_note->attachment != null)
								<div class="row">
									<div class="col-md-10">
										<input type="text" class="form-control" value="{{ $coaching_note->attachment }}" disabled>
									</div>
									<a href="{{ route('agendas.note_download',$coaching_note->id) }}"
										class="btn btn-primary col-auto">Download</a>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				@endif
				@if((($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled' || $agenda_detail->status
				== 'finished') && ($agenda_detail->date.' '.$agenda_detail->time) < (\Carbon\Carbon::now()->
					setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'))))
					<div class="row">
						<div class="col-md-12 text-left">
							<a href="{{route('agendas.index')}}" class="btn btn-secondary">Kembali</a>
							<button type="submit" class="btn btn-primary data-submit" id="saveBtn">Submit</button>
						</div>
					</div>
					@endif
			</form>
			@endrole
		</div>

	</div>
</div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript">
	/* Javascript */

	$(function() {

		@if($agenda_detail->rating_from_coachee != null)
			var rating = $('#rateYo').data("rating");
			$('#rateYo').rateYo({
				starWidth: "50px",
				rating: rating,
				fullStar: true,
				spacing: "30px",
				readOnly: true,
				multiColor: {
					"startColor": "#7367F0", //RED
					"endColor": "#7367F0" //GREEN
				}
			});
		@else
			$('#rateYo').rateYo({
				starWidth: "50px",
				fullStar: true,
				spacing: "30px",
				multiColor: {
					"startColor": "#7367F0", //RED
					"endColor": "#7367F0" //GREEN
				}
			});
			$('#rateYo').click(function() {
				var rating = $('#rateYo').rateYo("rating");
				$('#coach_rating').val(rating);
			});
		@endif

	});
</script>
@endpush
