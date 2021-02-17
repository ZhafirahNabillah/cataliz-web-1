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

      @role('admin')
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
                <div class="card-title">
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coach yang terdaftar" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 172.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coach
                </small>
                <h2 class="font-weight-bolder text-center">... Coach</h2>

              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah client coachee yang terdaftar" />

                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 115.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coachee
                </small>
                <h2 class="font-weight-bolder text-center">... Coachee</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah plan yang terdaftar" />

                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 191.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Plan
                </small>
                <h2 class="font-weight-bolder text-center">... Plan</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang terdaftar" />

                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 90.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Session
                </small>
                <h2 class="font-weight-bolder text-center">... Sessions</h2>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">List Agenda</h5>
                <table class="datatables-basic table yajra-datatable1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Session</th>
                      <th>Date</th>
                      <th>Duration</th>
                      <th>Status</th>
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
      @endrole

      @role('coach')
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
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 88.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coaching Hour
                </small>
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
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coachee" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 84.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coachee
                </small>
                <h2 class="font-weight-bolder text-center">{{$client}} Clients</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 82.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Rating
                </small>
                <h2 class="font-weight-bolder text-center">21 Rating</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 90.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Session
                </small>
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
      @endrole
      @role('coachee')
      <section id="card-demo-example">
        <div class="row match-height">
          <div class="container ">
            <div class="row justify-content-left position-relative">
              <div class="col-md-4 col-lg-3">
                <div class="card  ">
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
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 88.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coaching Hour
                </small>
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
                <div class="card-title">
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coachee" />
                </div>
                <img class="rounded mx-auto d-block center" style="height: 80px;" src="{{ url('assets\images\icons\Group 172.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coach
                </small>
                <h2 class="font-weight-bolder text-center">{{$client}} Clients</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 82.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Rating
                </small>
                <h2 class="font-weight-bolder text-center">21 Rating</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 90.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Session
                </small>
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
      @endrole
    </div>
  </div>
</div>



<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'date',
          name: 'date',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'time',
          name: 'time',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'session_name',
          name: 'session_name',
          defaultContent: '<i>-</i>'
        },
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'date',
          name: 'date',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'time',
          name: 'time',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'duration',
          name: 'duration',
          defaultContent: '<i>-</i>'
        },
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
  // popover
  $(function() {
    $('[data-toggle="popover"]').popover()
  })
</script>
@endpush