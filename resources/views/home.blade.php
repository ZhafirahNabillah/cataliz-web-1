@extends('layouts.layoutVerticalMenu')

@section('title','Home')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-header row">
    </div>
    <div class="content-body">

      @role('admin')
      <section id="card-demo-example">
        <div class="row match-height">
          <div class="container-fluid">
            <div class="row justify-content-left">
              <div class="col-md-12">
                <div class="card text-white " style="background-color: #7367F0;">
                  <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif
                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a href="{{'/docs'}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coach yang terdaftar" />
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\adminDashboardCoach.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Coach</small>
                  <h2 class="font-weight-bolder text-center">{{$total_coach}} Coach</h2>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah client coachee yang terdaftar" />
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\adminDashboardCoachee.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Coachee</small>
                  <h2 class="font-weight-bolder text-center">{{$total_coachee}} Coachee</h2>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 col-lg-3">
            <a href="{{ route('plans.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah plan yang terdaftar" />
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\admin\adminDashboardPlan.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Plan</small>
                  <h2 class="font-weight-bolder text-center">{{$total_plans}} Plan</h2>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah sesi yang terdaftar" />
                  <img class="rounded text-center mx-auto d-block center" src="{{ url('assets\images\icons\admin\adminDashboardSessions.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Session</small>
                  <h2 class="font-weight-bolder text-center">{{$total_sessions}} Sessions</h2>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">List Agenda
                  <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#agenda-individual" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#agenda-group" aria-controls="profile" role="tab" aria-selected="false">Group</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <!-- start agenda Individu -->
                  <div class="tab-pane active" id="agenda-individual" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table agenda-datatable-individual">
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
                    </section>
                  </div>
                  <!-- /end agenda individu -->

                  <!-- start tab agenda group -->
                  <div class="tab-pane" id="agenda-group" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table agenda-datatable-group">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Group Code</th>
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
                    </section>
                  </div>
                  <!-- /end tab agenda group -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /card -->
      @endrole

      @role('coach|coachee')
      <section id="card-demo-example">
        <div class="row match-height">
          <div class="container-fluid">
            <div class="row justify-content-left">
              <div class="col-md-12">
                <div class="card text-white" style="background-color: #7367F0;">
                  <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                    @endif

                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a style="color: white;" href="{{'/docs'}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>

              @role('coachee')
              @if (($client->organization && $client->company && $client->occupation) == null)
              <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                  <div class="card-body">
                    <a class="text-white" href="javascript:;" id="editCoachee"> Welcome {{auth()->user()->name}}, Yuk
                      <b>Klik Disini</b> Untuk
                      Melengkapi Akunmu
                      Untuk Lebih
                      Menikmati Layanan Kami !</a>
                  </div>
                </div>
              </div>
              @endif
              @endrole

              <div class="col-md-9 col-lg-9">
              </div>
            </div>
          </div>

          @role('coach')
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 88.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Coaching Hour
                  </small>
                  @if ($total_hours == null)
                  <h2 class="font-weight-bolder text-center">0 Hours</h2>
                  @else
                  <h2 class="font-weight-bolder text-center">{{str_replace(".", ",", number_format($total_hours, 1))}}
                    Hours</h2>
                  @endif
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coachee" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\client.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Coachee
                  </small>
                  <h2 class="font-weight-bolder text-center">{{$total_clients}} Clients</h2>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah rating yang diberikan oleh client" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\rating.svg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Rating
                </small>
                <h2 class="font-weight-bolder text-center">{{ $total_ratings }} Rating</h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\session.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Session
                  </small>
                  <h2 class="font-weight-bolder text-center">{{ $total_sessions }} Sessions</h2>
                </div>
              </div>
            </a>
          </div>
          @endrole

          @role('coachee')
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\Group 88.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Coaching Hour
                  </small>
                  @if ($total_hours == null)
                  <h2 class="font-weight-bolder text-center">0 Hours</h2>
                  @else
                  <h2 class="font-weight-bolder text-center">{{str_replace(".", ",", number_format($total_hours, 1))}}
                    Hours</h2>
                  @endif
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Jumlah coachee" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\client.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Coach
                  </small>
                  <h2 class="font-weight-bolder text-center">{{$total_coach}} Coaches</h2>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="" />
                </div>
                <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\rating.svg') }}" alt="Card image cap" />
                <small class="card text-center text-muted mb-1">Total Rating
                </small>
                <h2 class="font-weight-bolder text-center">{{ $total_ratings }} Rating</h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 18px" height="18px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                  </div>
                  <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\session.svg') }}" alt="Card image cap" />
                  <small class="card text-center text-muted mb-1">Total Session
                  </small>
                  @if ($total_sessions == null)
                  <h2 class="font-weight-bolder text-center">0 Sessions</h2>
                  @else
                  <h2 class="font-weight-bolder text-center">{{$total_sessions}} Sessions</h2>
                  @endif
                </div>
              </div>
            </a>
          </div>
          @endrole

          <div class="col-sm-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Upcoming Events
                  <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#upcoming-individual" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#upcoming-group" aria-controls="profile" role="tab" aria-selected="false">Group</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <!-- start upcoming Individu -->
                  <div class="tab-pane active" id="upcoming-individual" aria-labelledby="coach-tab" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table upcoming-datatable-individual">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Session</th>
                                  <th>Date</th>
                                  <th>Duration</th>
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
                  <!-- /end upcoming individu -->

                  <!-- start tab upcoming group -->
                  <div class="tab-pane" id="upcoming-group" aria-labelledby="coachee-tab" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table upcoming-datatable-group">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Group Code</th>
                                  <th>Session</th>
                                  <th>Date</th>
                                  <th>Duration</th>
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
                  <!-- /end tab upcoming group -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">List Agenda
                  <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#agenda-individual" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#agenda-group" aria-controls="profile" role="tab" aria-selected="false">Group</a>
                  </li>
                </ul>

                <div class="tab-content">
                  <!-- start agenda Individu -->
                  <div class="tab-pane active" id="agenda-individual" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table agenda-datatable-individual">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Session</th>
                                  <th>Date</th>
                                  <th>Duration</th>
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
                  <!-- /end agenda individu -->

                  <!-- start tab agenda group -->
                  <div class="tab-pane" id="agenda-group" role="tabpanel">
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <table class="datatables-basic table-striped table agenda-datatable-group">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Group Code</th>
                                  <th>Session</th>
                                  <th>Date</th>
                                  <th>Duration</th>
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
                  <!-- /end tab agenda group -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /card -->
      @endrole

      @role('coachee')
      <!-- Modal to Complete Profile -->
      <div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
        <div class="modal-dialog sidebar-sm">
          <form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST" action="{{route('home.store_data', $client->id)}}">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="modalHeading"></h5>
            </div>
            <input type="hidden" name="Client_id" id="Client_id">
            <div class="modal-body flex-grow-1">
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$client->name}}" />
              </div>
              <label class="form-label" for="basic-icon-default-post">Phone</label>
              <div class="input-group input-group-merge mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon5">+62</span>
                </div>
                <input id="phone" name="phone" type="text" class="form-control" value="{{$client->phone}}">
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-email">Email</label>
                <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" value="{{$client->email}}" disabled />
                <small class="form-text text-muted"> You can use letters, numbers & periods </small>
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Organization</label>
                <input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$client->organization}}" />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Company</label>
                <input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$client->company}}" />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Occupation</label>
                <input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="{{$client->occupation}}" />
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
      @endrole

      @role('trainer')
      @endrole

      @role('mentor')
      @endrole
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection

    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <script type="text/javascript">
      $(function() {

        var simplemde = new SimpleMDE({
          element: document.getElementById('MyID'),
          initialValue: '## Stuff.... '
        });

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });


        @role('admin')
        var table_agenda_individual = $('.agenda-datatable-individual').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_agenda_individual_events') }}",
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
            }
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });

        var table_agenda_group = $('.agenda-datatable-group').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_agenda_group_events') }}",
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
            },
            {
              data: 'group',
              name: 'group'
            },
            {
              data: 'session_name',
              name: 'session_name',
              defaultContent: '<i>-</i>'
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
            }
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });
        @endrole

        @role('coach|coachee')
        var table_upcoming_individual = $('.upcoming-datatable-individual').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_upcoming_individual_events') }}",
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
            }
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });

        var table_upcoming_group = $('.upcoming-datatable-group').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_upcoming_group_events') }}",
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
            },
            {
              data: 'group',
              name: 'group'
            },
            {
              data: 'session_name',
              name: 'session_name',
              defaultContent: '<i>-</i>'
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
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });

        var table_agenda_individual = $('.agenda-datatable-individual').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_agenda_individual_events') }}",
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
            }
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });

        var table_agenda_group = $('.agenda-datatable-group').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.show_agenda_group_events') }}",
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex'
            },
            {
              data: 'group',
              name: 'group'
            },
            {
              data: 'session_name',
              name: 'session_name',
              defaultContent: '<i>-</i>'
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
          ],
          dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
          language: {
            paginate: {
              // remove previous & next text from pagination
              previous: '&nbsp;',
              next: '&nbsp;'
            },
            // search: "<i data-feather='search'></i>",
            searchPlaceholder: "Search records"
          }
        });
        @endrole


        // popover
        $(function() {
          $('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover',
            placement: 'top',
            content: function() {
              return '<img src="' + $(this).data('img') + '" />';
            }
          })
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