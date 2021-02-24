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
          <div class="container-fluid">
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
                <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coach yang terdaftar" />
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 172.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted my-1">Total Coach</small>
                <h2 class="font-weight-bolder text-center">{{$total_coach}} Coach</h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah client coachee yang terdaftar" />
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 115.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted my-1">Total Coachee</small>
                <h2 class="font-weight-bolder text-center">{{$total_coachee}} Coachee</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah plan yang terdaftar" />
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 191.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted my-1">Total Plan</small>
                <h2 class="font-weight-bolder text-center">{{$total_plans}} Plan</h2>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang terdaftar" />
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\Group 90.png') }}" alt="Card image cap" />
                <small class="card text-center text-muted my-1">Total Session</small>
                <h2 class="font-weight-bolder text-center">{{$total_sessions}} Sessions</h2>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">List Agenda</h5>
                <table class="datatables-basic table admin-datatable-sessions">
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
          <div class="container-fluid">
            <div class="row justify-content-left">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif

                    {{auth()->user()->name . ", You are logged in!"}}
                  </div>
                </div>
              </div>
              <div class="col-md-9 col-lg-9">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">

              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 88.jpg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Coaching Hour
                </small>
                @if ($hours == null)
                <h2 class="font-weight-bolder text-center">0 Hours</h2>
                @else
                <h2 class="font-weight-bolder text-center">{{str_replace(".", ",", number_format($hours->sum, 1))}}
                  Hours</h2>
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
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah rating yang diberikan oleh client" />
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
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
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
                <h5 class="card-title mb-1">Upcoming Event
                  <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bgaian ini menampilkan sesi dengan status scheduled yang dijadwalkan terlaksana dalam waktu dekat" />
                </h5>
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
                <h5 class="card-title mb-1">List Agenda
                  <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
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
          <div class="container-fluid">
            <div class="row justify-content-left position-relative">
              <div class="col-md-12 col-lg-12">
                @if (($data->organization && $data->company && $data->occupation) == null)
                <div class="card text-white bg-warning mb-3">
                  <div class="card-body">
                    <a class="text-white" href="javascript:;" id="editCoachee"> Welcome {{auth()->user()->name}}, Yuk
                      <b>Klik Disini</b> Untuk
                      Melengkapi Akunmu
                      Untuk Lebih
                      Menikmati Layanan Kami !</a>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>

          <!-- Modal to Edit Profile -->
          <div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
            <div class="modal-dialog sidebar-sm">
              <form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST" action="{{route('home.store_data', $data->id)}}">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                  <h5 class="modal-title" id="modalHeading"></h5>
                </div>
                <input type="hidden" name="Client_id" id="Client_id">
                <div class="modal-body flex-grow-1">
                  <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$data->name}}" />
                  </div>
                  <label class="form-label" for="basic-icon-default-post">Phone</label>
                  <div class="input-group input-group-merge mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon5">+62</span>
                    </div>
                    <input id="phone" name="phone" type="text" class="form-control" value="{{$data->phone}}">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$data->email}}" disabled />
                    <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Organization</label>
                    <input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$data->organization}}" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Company</label>
                    <input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$data->company}}" />
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="basic-icon-default-fullname">Occupation</label>
                    <input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$data->occupation}}" />
                  </div>

                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">
                    Submit
                  </button>
                  <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </form>
              <!-- </form>-->

            </div>
          </div>
          <!-- End Modal -->

          <div class="container-fluid">
            <div class="row justify-content-left position-relative">
              <div class="col-md-4 col-lg-3">
                <div class="card  ">
                  <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif

                    {{auth()->user()->name . ", You are logged in!"}}
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
                <h2 class="font-weight-bolder text-center">{{str_replace(".", ",", number_format($hours->sum, 1))}}
                  Hours</h2>
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
                <h2 class="font-weight-bolder text-center">{{$total_coach}} Coachs</h2>
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
                @if ($session->sum == null)
                <h2 class="font-weight-bolder text-center">0 Sessions</h2>
                @else
                <h2 class="font-weight-bolder text-center">{{$session->sum}} Sessions</h2>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-1">Upcoming Event</h5>
                <table class="datatables-basic table yajra-datatable-event">
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
                <table class="datatables-basic table yajra-datatable-agenda">
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

    //admin yajra datatable for list sessions
    var table = $('.admin-datatable-sessions').DataTable({
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
          data: 'session_name',
          name: 'session_name'
        },
        {
          data: 'date',
          name: 'date',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'duration',
          name: 'duration',
          defaultContent: '<i>-</i>'
        },
        {
          data: 'status',
          name: 'status',
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

    // Coachee datatable
    var table = $('.yajra-datatable-event').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{route('home.show_upcoming_list')}}",
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

    var table = $('.yajra-datatable-agenda').DataTable({
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

    // popover
    $(function() {
      $('[data-toggle="popover"]').popover()
    });

    // modal edit
    $('body').on('click', '#editCoachee', function() {
      $('#modalHeading').html("Edit Client");
      $('#saveBtn').val("edit-user");
      $('#modals-slide-in').modal('show');
      // save data
      $('#saveBtn').click(function(e) {
        // e.preventDefault();
        $(this).html('Sending..');
        $('#modals-slide-in').modal('hide');
        Swal.fire({
          icon: 'success',
          title: 'Saved Successfully!',
        })
      })
    })
  });
</script>
@endpush
