@extends('layouts.layoutVerticalMenu')
@push('styles')
<link href="//cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.css" rel="stylesheet">
<style>
    /* @media only screen and (min-device-width : 769px) and (max-device-width : 1639px) {
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
  } */
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

            <section id="card-demo-example">
                <div class="row match-height">
                    <div class="container-fluid">
                        <div class="row justify-content-left">
                            <div class="col-md-12">
                                <div class="card text-white " style="background-color: #7367F0;">
                                    <div class="card-body">
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status')}}
                                        </div>
                                        @endif
                                        Welcome name, You are logged in! <a style="color: white;"
                                            href="{{route('documentation')}}" target="_blank"><u>See
                                                Documentations</u></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="card-header">
                                        <h6 class="card-title">Recently Accesed Program
                                        </h6>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-sm-row flex-column p-2">

                                            <div class="col-sm-4">
                                                <div class="card text-silver" style="background-color : #E4E4E4;">
                                                    <img class="img-fluid"
                                                        src=" {{asset('assets\images\abstract1.png')}}" alt=" ">
                                                    <div class="card-body">
                                                        <p class="card-text">SCMP</p>
                                                        <p class="card-text">UI/UX Design</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card text-silver" style="background-color : #E4E4E4;">
                                                    <img class="img-fluid"
                                                        src=" {{asset('assets\images\abstract2.png')}}" alt=" ">
                                                    <div class="card-body">
                                                        <p class="card-text">SCMP</p>
                                                        <p class="card-text">Project Manager</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card text-sliver" style="background-color : #E4E4E4;">
                                                    <img class="img-fluid"
                                                        src=" {{asset('assets\images\abstract3.png')}}" alt=" ">
                                                    <div class="card-body">
                                                        <p class="card-text">SCMP</p>
                                                        <p class="card-text">Enterprise Arcitect</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h6 class="card-title">My Program
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-sm-row flex-column p-2">

                                        <div class="col-sm-4">
                                            <div class="card text-silver" style="background-color : #E4E4E4;">
                                                <img class="img-fluid" src=" {{asset('assets\images\abstract4.png')}}"
                                                    alt=" ">
                                                <div class="card-body">
                                                    <p class="card-text">STARCO</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="card text-silver" style="background-color : #E4E4E4;">
                                                <img class="img-fluid" src=" {{asset('assets\images\abstract5.png')}}"
                                                    alt=" ">
                                                <div class="card-body">
                                                    <p class="card-text">SCMP</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</div>

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
          if (data.length <script 1) {
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
  </script>
  @endpush