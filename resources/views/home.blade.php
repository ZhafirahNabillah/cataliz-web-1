@extends('layouts.layoutVerticalMenu')
@push('styles')
<link href="//cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.css" rel="stylesheet">
<style>
  @media only screen and (min-device-width : 769px) and (max-device-width : 1639px) {
    .imgDashboardWrapper {
      height: 5%;
      width: 5%;
      float: left;
    }

    .textCard {
      text-align: left !important;
      padding-top: 4%;
      font-size: 3%;
      

    }
  }

  .imgDashboardWrapper {
    height: 30%;
    width: 30%;
    float: left;
  }

  .textCard {
    text-align: left !important;
    padding-top: 4%;
    padding-left: 5%;
  }
</style>
@endpush
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
                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a style="color: white;"
                      href="{{route('documentation')}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- new -->
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="Jumlah coach yang terdaftar" />
                  <img style="padding-left: 12px;" class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\clock.svg') }}"
                  alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Coach</small>
                  <h2 class="font-weight-bolder text-center">{{$total_coach}} Coaches</h2>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="Jumlah coach yang terdaftar" />
                  <img style="padding-left: 12px;" class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\users.svg') }}"
                  alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Coachee</small>
                  <h2 class="font-weight-bolder text-center">{{$total_coachee}} Coachee</h2>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-lg-3">
            <a href="{{ route('plans.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="Jumlah coach yang terdaftar" />
                  <img style="padding-left: 12px;" class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\trending-up.svg') }}"
                  alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Plan</small>
                  <h2 class="font-weight-bolder text-center">{{$total_plans}} Plan</h2>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="Jumlah coach yang terdaftar" />
                  <img style="padding-left: 12px;" class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\airplay.svg') }}"
                  alt="Card image cap" />
                  <small class="card text-center text-muted my-1">Total Session</small>
                  <h2 class="font-weight-bolder text-center">{{ $total_sessions }} Sessions</h2>
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">List Agenda
                  <img class="align-text width=" 15px" height="15px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top"
                    data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#agenda-individual"
                      aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#agenda-group" aria-controls="profile"
                      role="tab" aria-selected="false">Group</a>
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

          <div class="col-sm-8">
            <div class="card">
              <div class="card-body">
                <div id='calendar'></div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="card-header px-0">
                  <h4 class="card-title">Upcoming Events
                    <img class="align-text width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top"
                      data-content="Bagian ini menampilkan jadwal kegiatan yang dilakukan hari ini dan beberapa hari kedepan" />
                  </h4>
                </div>
                <hr>
                <!-- waktu hari ini -->
                <div id="list_event_wrapper">
                  <h3 class="badge badge-primary font-weight-bold">Today</h3>
                  <br>
                  @forelse ($today_events as $event)
                  <div class="row">
                    <div class="col-sm-12">
                      <img src="{{ url('assets/images/icons/trello.svg') }}" alt="">
                      @role('coach')
                      <span>{{ $event['title'].' - '.$event['coachee'] }}</span><br>
                      @endrole
                      @role('coachee')
                      <span>{{ $event['title'].' - '.$event['coach'] }}</span><br>
                      @endrole
                      <a class="text-primary" style="font-size: 20px"
                        href="{{ $event['url'] }}">{{ $event['topic'] }}</a>
                      <br><span>{{ $event['start'] }}</span>
                    </div>
                  </div>
                  <hr>
                  @empty
                  <span><i>No Event Available</i></span>
                  @endforelse
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

                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a style="color: white;"
                      href="{{route('documentation')}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>

              @role('coach')
                @if ($empty_profile == true)
                <div class="col-md-12">
                  <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                      <a class="text-white" href="{{route('profil.detail', Auth::user()->id)}}"> Yuk, segera lengkapi data
                        diri kamu!
                        <b> Klik Disini</b> </a>
                    </div>
                  </div>
                </div>
                @endif
              @endrole

              @role('coachee')
              @if (($client->organization && $client->company && $client->occupation) == null)
              <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                  <div class="card-body">
                    <a class="text-white" href="javascript:;" id="editCoachee"> Yuk, segera lengkapi data diri kamu!
                      <b> Klik Disini</b> </a>
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
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto " src="{{ url('assets\images\icons\clock.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class="text-muted mb-1">Total Coaching Hour
                      </small>
                      @if ($total_hours == null)
                      <h2 class=" font-weight-bolder ">0 Hours</h2>
                      @else
                      <h2 class=" font-weight-bolder ">{{str_replace(".", ",", number_format($total_hours, 1))}}
                        Hours</h2>
                      @endif
                    </div>
                  </div>

                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Jumlah coachee" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto" src="{{ url('assets\images\icons\users.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Coachee
                      </small>
                      <h2 class="font-weight-bolder">{{$total_clients}} Clients</h2>
                    </div>
                  </div>

                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 15px" height="15px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top" data-content="Jumlah rating yang diberikan oleh client" />
                </div>
                <div class="row pl-2">
                  <div class="float-md-start">
                    <img class="rounded mx-auto " src="{{ url('assets\images\icons\trending-up.svg') }}"
                      alt="Card image cap" />
                  </div>
                  <div class="textCard">
                    <small class=" text-muted mb-1">Total Rating</small>
                    <h2 class="font-weight-bolder">{{ $total_ratings }} Rating</h2>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto " src="{{ url('assets\images\icons\airplay.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Session
                      </small>
                      <h2 class="font-weight-bolder ">{{ $total_sessions }} Sessions</h2>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endrole

          @role('coachee')
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 18px" height="18px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Jumlah waktu mengajar yang telah dilaksanakan" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto" src="{{ url('assets\images\icons\clock.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Coaching Hour
                      </small>

                      @if ($total_hours == null)
                      <h2 class="font-weight-bolder ">0 Hours</h2>
                      @else
                      <h2 class="font-weight-bolder ">{{str_replace(".", ",", number_format($total_hours, 1))}}
                        Hours</h2>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('clients.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Jumlah coachee" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto " src="{{ url('assets\images\icons\user-check.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Coach
                      </small>
                      <h2 class="font-weight-bolder">{{$total_coach}} Coaches</h2>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <img class="rounded float-right width=" 18px" height="18px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top" data-content="" />
                </div>
                <div class="row pl-2">
                  <div class="float-md-start">
                    <img class="rounded mx-auto " src="{{ url('assets\images\icons\trending-up.svg') }}"
                      alt="Card image cap" />
                  </div>
                  <div class="textCard">
                    <small class=" text-muted mb-1">Total Rating
                    </small>
                    <h2 class="font-weight-bolder">{{ $total_ratings }} Rating</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <a href="{{ route('agendas.index') }}">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <img class="rounded float-right width=" 18px" height="18px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top" data-content="Total sesi yang telah dilaksanakan" />
                  </div>
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto d-block center" src="{{ url('assets\images\icons\airplay.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Session
                      </small>
                      @if ($total_sessions == null)
                      <h2 class="font-weight-bolder ">0 Sessions</h2>
                      @else
                      <h2 class="font-weight-bolder ">{{$total_sessions}} Sessions</h2>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endrole

          <div class="col-sm-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Upcoming Events
                  <img class="align-text width=" 15px" height="15px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top"
                    data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#upcoming-individual"
                      aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#upcoming-group"
                      aria-controls="profile" role="tab" aria-selected="false">Group</a>
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
                  <img class="align-text width=" 15px" height="15px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top"
                    data-content="Bagian ini menampilkan daftar seluruh sesi yang dimiliki oleh client yang dipilih." />
                </h5>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-center mb-0" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#agenda-individual"
                      aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#agenda-group" aria-controls="profile"
                      role="tab" aria-selected="false">Group</a>
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

          @role('coach|coachee')
          {{-- calendar --}}
          <div class="col-sm-8">
            <div class="card">
              <div class="card-body">
                <div id='calendar'></div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="card-header px-0">
                  <h4 class="card-title">Upcoming Events
                    <img class="align-text width=" 15px" height="15px"" src="
                      {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                      data-placement="top"
                      data-content="Bagian ini menampilkan jadwal kegiatan yang dilakukan hari ini dan beberapa hari kedepan" />
                  </h4>
                </div>
                <hr>
                <!-- waktu hari ini -->
                <div id="list_event_wrapper">
                  <h3 class="badge badge-primary font-weight-bold">Today</h3>
                  <br>
                  @forelse ($today_events as $event)
                  <div class="row">
                    <div class="col-sm-12">
                      <img src="{{ url('assets/images/icons/trello.svg') }}" alt="">
                      @role('coach')
                      <span>{{ $event['title'].' - '.$event['coachee'] }}</span>
                      @endrole
                      @role('coachee')
                      <span>{{ $event['title'].' - '.$event['coach'] }}</span>
                      @endrole
                      @if ($event['status'] == 'scheduled')
                      <span class="badge badge-pill badge-warning float-right"
                        style="background-color: #CADB05;">scheduled</span>
                      @elseif ($event['status'] == 'rescheduled')
                      <span class="badge badge-pill badge-primary float-right">rescheduled</span>
                      @elseif ($event['status'] == 'finished')
                      <span class="badge badge-pill badge-success float-right">finished</span>
                      @endif
                      <br>
                      <a class="text-primary" style="font-size: 20px"
                        href="{{ $event['url'] }}">{{ $event['topic'] }}</a>
                      <br><span>{{ $event['start'] }}</span>
                    </div>
                  </div>
                  <hr>
                  @empty
                  <span><i>No Event Available</i></span>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
          @endrole
        </div>
      </section>
      <!-- /card -->
      @endrole

      @role('coachee')
      <!-- Modal to Complete Profile -->
      <div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
        <div class="modal-dialog sidebar-sm">
          <form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm" method="POST"
            action="{{route('home.store_data', $client->id)}}">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="modalHeading"></h5>
            </div>
            <input type="hidden" name="Client_id" id="Client_id">
            <div class="modal-body flex-grow-1">
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <input id="name" name="name" type="text" class="form-control dt-full-name"
                  id="basic-icon-default-fullname" value="{{$client->name}}" />
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
                <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email"
                  value="{{$client->email}}" disabled />
                <small class="form-text text-muted"> You can use letters, numbers & periods </small>
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Organization</label>
                <input id="organization" name="organization" type="text" class="form-control dt-full-name"
                  id="basic-icon-default-fullname" value="{{$client->organization}}" />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Company</label>
                <input id="company" name="company" type="text" class="form-control dt-full-name"
                  id="basic-icon-default-fullname" value="{{$client->company}}" />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Occupation</label>
                <input id="occupation" name="occupation" type="text" class="form-control dt-full-name"
                  id="basic-icon-default-fullname" value="{{$client->occupation}}" />
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
                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a style="color: white;"
                      href="{{'/documentation'}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>
              @if ($empty_profile == true)
              <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                  <div class="card-body">
                    <a class="text-white" href="{{route('profil.detail', Auth::user()->id)}}"> Yuk, segera lengkapi data
                      diri kamu!
                      <b> Klik Disini</b> </a>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <a href="{{route('topic.index')}}">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                    src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top" data-content="jumlah topik yang tersedia untuk Anda" />
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto " src="{{ url('assets\images\icons\file-text.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Topic
                      </small>
                      <h2 class="font-weight-bolder ">{{$total_topic}} Topic</h2>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-6">
            <a href="#">
              <div class="card">
                <div class="card-body">
                  <img class="rounded float-right" width="15px" height="15px"
                    src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top" data-content="Jumlah mentee yang dipasangkan dengan Anda" />
                  <div class="row pl-2">
                    <div class="float-md-start">
                      <img class="rounded mx-auto " src="{{ url('assets\images\icons\users.svg') }}"
                        alt="Card image cap" />
                    </div>
                    <div class="textCard">
                      <small class=" text-muted mb-1">Total Trainee
                      </small>
                      <h2 class="font-weight-bolder ">{{$total_participant}} Trainee</h2>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">List Topic
                  <img class="align-text width=" 15px" height="15px"" src="
                    {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                    data-placement="top" data-content="Bagian ini menampilkan daftar topik yang tersedia untuk Anda" />
                </h5>
              </div>
              <div class="card-body">
                <section id="basic-datatable">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <table class="datatables-basic table-striped table topic-datatable">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Topic</th>
                              <th>Category</th>
                              <th>Sub Topic</th>
                              <th>Participant</th>
                              <th>Action</th>
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
          </div>
        </div>
      </section>
      <!-- /card -->
      @endrole

      @role('mentor')
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
                    Welcome, {{auth()->user()->name . ", You are logged in!"}} <a style="color: white;"
                      href="{{'/documentation'}}" target="_blank"><u>See
                        Documentations</u></a>
                  </div>
                </div>
              </div>
              @if ($empty_profile == true)
              <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                  <div class="card-body">
                    <a class="text-white" href="{{route('profil.detail', Auth::user()->id)}}"> Yuk, segera lengkapi data
                      diri kamu!
                      <b> Klik Disini</b> </a>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>
          {{-- <div class="col-md-4 col-lg-4">
            <a href="{{route('exercise.index')}}">
          <div class="card">
            <div class="card-body">
              <img class="rounded float-right" width="15px" height="15px"
                src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                data-placement="top" data-content="Jumlah pertanyaan yang ada" />
              <img class="rounded mx-auto d-block center"
                src="{{ url('assets\images\icons\admin\adminDashboardCoachee.svg') }}" alt="Card image cap" />
              <small class="card text-center text-muted my-1">Total Exercise</small>
              <h2 class="font-weight-bolder text-center"># Exercise</h2>
            </div>
          </div>
          </a>
        </div> --}}
        <div class="col-md-4 col-lg-4">
          <a href="">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="jumlah topik yang tersedia untuk Anda" />
                <div class="row pl-2">
                  <div class="float-md-start">
                    <img class="rounded mx-auto " src="{{ url('assets\images\icons\edit.svg') }}"
                      alt="Card image cap" />
                  </div>
                  <div class="textCard">
                    <small class=" text-muted mb-1">Total Exam
                    </small>
                    <h2 class="font-weight-bolder ">... Exam</h2>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-lg-4">
          <a href="{{route('topic.index')}}">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="jumlah topik yang tersedia untuk Anda" />
                <div class="row pl-2">
                  <div class="float-md-start">
                    <img class="rounded mx-auto " src="{{ url('assets\images\icons\file-text.svg') }}"
                      alt="Card image cap" />
                  </div>
                  <div class="textCard">
                    <small class=" text-muted mb-1">Total Topic
                    </small>
                    <h2 class="font-weight-bolder ">{{$total_topic}} Topic</h2>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-lg-4">
          <a href="#">
            <div class="card">
              <div class="card-body">
                <img class="rounded float-right" width="15px" height="15px"
                  src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover"
                  data-placement="top" data-content="Jumlah mentee yang dipasangkan dengan Anda" />
                <div class="row pl-2">
                  <div class="float-md-start">
                    <img class="rounded mx-auto " src="{{ url('assets\images\icons\user-check.svg') }}"
                      alt="Card image cap" />
                  </div>
                  <div class="textCard">
                    <small class=" text-muted mb-1">Total Mentee
                    </small>
                    <h2 class="font-weight-bolder">{{$total_participant}} Mentee</h2>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- list topic -->
        {{-- <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">List Topic
                <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
        alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Bagian ini menampilkan daftar
        topik yang tersedia untuk Anda" />
        </h5>
    </div>
    <div class="card-body">
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <table class="datatables-basic table-striped table topic-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Topic</th>
                    <th>Category</th>
                    <th>Sub Topic</th>
                    <th>Participant</th>
                    <th>Action</th>
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
</div> --}}
<!-- /list topic -->

{{-- calendar --}}
<div class="col-sm-12">
  <div class="card">
    <div class="card-body">
      <div id='calendar'></div>
    </div>
  </div>
</div>
</section>
<!-- /card -->
@endrole
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.js"></script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var today = new Date();
    var day = today.getDay();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();

    var formatted_today_date = year + '-' + month + '-' + day;
    console.log(formatted_today_date);

    var dayElement = null;

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      eventDidMount: function(info) {
        console.log(info.el);
        $(info.el).attr('title', "Event Detail");
        $(info.el).attr('data-toggle', "popover");
        $(info.el).attr('data-placement', "top");
        $(info.el).attr(
          'data-content',
          `<div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>Event Type</b>
                  </div>
                  <div class="col-sm-12" id="coaching-type">
                    Coaching
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>Session name</b>
                  </div>
                  <div class="col-sm-12" id="coaching-session">
                    ` + info.event.title + `
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>Title</b>
                  </div>
                  <div class="col-sm-12" id="coaching-topic">
                    ` + info.event.extendedProps.topic + `
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>Coachee</b>
                  </div>
                  <div class="col-sm-12" id="coaching-coachee">
                    ` + info.event.extendedProps.target + `
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>Start Time</b>
                  </div>
                  <div class="col-sm-12" id="coaching-start-time">
                    ` + info.event.start + `
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <b>End Time</b>
                  </div>
                  <div class="col-sm-12" id="coaching-end-time">
                    ` + info.event.end + `
                  </div>
                </div>
              </div>`
        );
        $(info.el).attr('data-html', "true");

        $('[data-toggle="popover"]').popover({
          trigger: 'hover'
        });
      },
      dateClick: function(info) {
        if (dayElement != null) {
          dayElement.css('background-color', '');
        }

        $(info.dayEl).css('background-color', '#F5F5F5');

        dayElement = $(info.dayEl);

        $.get("" + '/home/get_date_event?date=' + info.dateStr, function(data) {
          console.log(data);
          $('#list_event_wrapper').html(`<h3 class="badge badge-primary font-weight-bold">` + info.dateStr + `</h3><br>`);
          for (var i = 0; i < data.length; i++) {
            var status = null;

            if (data[i].status == 'scheduled') {
              status = `<span class="badge badge-pill badge-warning float-right" style="background-color: #CADB05;">scheduled</span>`;
            } else if (data[i].status == 'rescheduled') {
              status = `<span class="badge badge-pill badge-primary float-right">rescheduled</span>`;
            } else if (data[i].status == 'finished') {
              status = `<span class="badge badge-pill badge-success float-right">finished</span>`;
            }

            $('#list_event_wrapper').append(
              `<div class="row">
                    <div class="col-sm-12">
                      <img src="{{ url('assets/images/icons/trello.svg') }}" alt="">
                      <span>` + data[i].title + ` - ` + data[i].target + `</span>` + status + `<br>
                      <a class="text-primary" style="font-size: 20px" href="` + data[i].url + `" >` + data[i].topic + `</a>
                      <br><span>` + data[i].start + `</span>
                    </div>
                  </div>
                  <hr>`
            );
          }
          if (data.length < 1) {
            $('#list_event_wrapper').append('<span><i>No Event Available</i></span>');
          }
          // $('.trello_icons').load();
        });
      },
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: '{{ route('home.get_calendar_data') }}'
    });

    calendar.render();
  });

  $(function() {
    // var calendar = $('#calendar').fullCalendar({
    //   initialView: 'dayGridMonth',
    //   initialDate: '2021-05-07',
    //   headerToolbar: {
    //     left: 'prev,next today',
    //     center: 'title',
    //     right: 'dayGridMonth,timeGridWeek,timeGridDay'
    //   },
    // });
    //
    // calendar.render();

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
          render: function(data) {
            if (data == null) {
              return '-';
            } else {
              return data + ' Minutes';
            }
          }
        },
        {
          data: 'status',
          name: 'status',
          render: function(data, type, row) {
            var status = null;
            if (data == 'unschedule') {
              status = `<span class="badge badge-pill badge-secondary" style="
                  background-color: #F1AF33;">unschedule</span>`;
            } else if (data == 'scheduled') {
              status = `<span class="badge badge-pill badge-warning" style="
                  background-color: #CADB05;">scheduled</span>`;
            } else if (data == 'rescheduled') {
              status = `<span class="badge badge-pill badge-primary">rescheduled</span>`;
            } else if (data == 'finished') {
              status = `<span class="badge badge-pill badge-success">finished</span>`;
            } else if (data == 'canceled') {
              status = `<span class="badge badge-pill badge-danger">canceled</span>`;
            }

            return status;
          }
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
          defaultContent: '<i>-</i>',
          render: function(data) {
            if (data == null) {
              return '-';
            } else {
              return data + ' Minutes';
            }
          }
        },
        {
          data: 'status',
          name: 'status',
          render: function(data, type, row) {
            var status = null;
            if (data == 'unschedule') {
              status = `<span class="badge badge-pill badge-secondary" style="
                  background-color: #F1AF33;">unschedule</span>`;
            } else if (data == 'scheduled') {
              status = `<span class="badge badge-pill badge-warning" style="
                  background-color: #CADB05;">scheduled</span>`;
            } else if (data == 'rescheduled') {
              status = `<span class="badge badge-pill badge-primary">rescheduled</span>`;
            } else if (data == 'finished') {
              status = `<span class="badge badge-pill badge-success">finished</span>`;
            } else if (data == 'canceled') {
              status = `<span class="badge badge-pill badge-danger">canceled</span>`;
            }

            return status;
          }
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

    @role('trainer|mentor')
    var table_topic = $('.topic-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('home.show_topics') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'topic',
          name: 'topic'
        },
        {
          data: 'category.category',
          name: 'category.category'
        },
        {
          data: 'sub_topic',
          name: 'sub_topic',
          defaultContent: '0'
        },
        {
          data: 'participant',
          name: 'participant',
          defaultContent: '0'
        },
        {
          data: 'action',
          name: 'action',
          orderable: true,
          searchable: true
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
