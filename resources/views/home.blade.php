@extends('layouts.layoutVerticalMenu')

@section('title','Home')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <!--card -->
      <section id="card-demo-example">
        <div class="row match-height">
          <div class="container">
            <div class="row justify-content-left">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 88.jpg"
                  alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coaching Hour</small>
                @if ($hours == null)
                <h2 class="font-weight-bolder text-center">0 Hours</h2>
                @else
                <h2 class="font-weight-bolder text-center">{{str_replace(".", ",", number_format($hours->sum, 1))}} Hours</h2>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 84.jpg"
                  alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coachee</small>
                <h2 class="font-weight-bolder text-center">{{$client}} Clients</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 82.jpg"
                  alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Rating</small>
                <h2 class="font-weight-bolder text-center">21 Rating</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded mx-auto d-block center" src="assets\images\icons\Group 90.jpg"
                  alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Session</small>
                <h2 class="font-weight-bolder text-center">{{$session->sum}} Sessions</h2>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">Upcoming Event</h5>
                <table class="datatables-basic table yajra-datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Session</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">List Agenda</h5>
                <table class="datatables-basic table yajra-datatable1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Duration</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /card -->

    </div>
  </div>
</div>



<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(function () {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  var table = $('.yajra-datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: "",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'name', name: 'name'},
			{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
      {data: 'time', name: 'time', defaultContent: '<i>-</i>'},
			{data: 'session_name', name: 'session_name', defaultContent: '<i>-</i>'},
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

	var table = $('.yajra-datatable1').DataTable({
		processing: true,
		serverSide: true,
		ajax: "{{route('home.show_agendas_list')}}",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'name', name: 'name'},
			{data: 'date', name: 'date', defaultContent: '<i>-</i>'},
      {data: 'time', name: 'time', defaultContent: '<i>-</i>'},
			{data: 'duration', name: 'duration', defaultContent: '<i>-</i>'},
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
});
</script>
@endpush
