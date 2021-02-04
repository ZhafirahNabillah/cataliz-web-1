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
								<li class="breadcrumb-item active">Detail Agendas
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
                      <p class="card-text">#</p>

                      <div class="mt-2">
                        <h5 class="mb-75">Organization:</h5>
                        <p class="card-text">#</p>
                      </div>
                      <div class="mt-2">
                        <h5 class="mb-75">Company:</h5>
                        <p class="card-text">#</p>
                      </div>
                      <div class="mt-2">
                        <h5 class="mb-75">Session:</h5>
                        <p class="card-text">#</p>
                      </div>
                      <div class="mt-2">
                        <h5 class="mb-75">Topic:</h5>
                        <p class="card-text">#</p>
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
                      <p class="card-text">#</p>

                    <div class="mt-2">
                    <h5 class="mb-75">Time:</h5>
                    <p class="card-text">#</p>
                    </div>
                    <div class="mt-2">
                      <h5 class="mb-75">Media:</h5>
                      <p class="card-text">#</p>
                    </div>
                    <div class="mt-2">
                      <h5 class="mb-75">Media Url:</h5>
                      <p class="card-text">#</p>
                    </div>
                    <div class="mt-2">
                      <h5 class="mb-75">Duration:</h5>
                      <p class="card-text">#</p>
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
	</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">
$(function () {

	var table = $('.yajra-datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: "",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'client.name', name: 'client.name'},
			{data: 'session', name: 'session'},
			{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
			{data: 'duration', name: 'duration', defaultContent: '<i>-</i>'},
			{data: 'status', name: 'status'},
			{
				data: 'action',
				name: 'action',
				orderable: true,
				searchable: true
			},
		]
	});

	$('body').on('click', '.deleteAgenda', function (e) {

		var agenda_id = $(this).data("id");
		console.log(agenda_id);
		if(confirm("Are You sure want to delete !")){

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "DELETE",
				url: ""+'/agendas/'+agenda_id,
				success: function (data) {
					table.draw();
					$(".alert-danger").css("display", "block");
					$(".alert-danger").append("<P>Data berhasil dihapus!");
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		} else {
			e.preventDefault();
		}
	});
});
</script>
@endpush
