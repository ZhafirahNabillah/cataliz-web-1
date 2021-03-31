@extends('layouts.layoutVerticalMenu')

@section('title','Agendas')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

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
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('agendas.index')}}">Agenda</a>
                </li>
                <li class="breadcrumb-item active">Edit Agenda
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="content-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dissmisable">
        <h4 class="alert-heading">Success</h4>
        <div class="alert-body">{{ $message }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif
      <div class="row">



      </div>
      <!-- Basic table -->
      <section id="basic-datatable">
        <form action="{{ route('agendas.update', $agenda_detail->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Edit Agenda</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Plan</label>
                      <select class="livesearch-plans form-control" name="plan_id" id="plan_id" disabled>
                        <option selected hidden value="{{ $plan->id }}">{{ $plan->objective }}</option>
                      </select>
                    </div>
                  </div>

                  <!-- Kalo group -->
                  @if ($plan->group_id)
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="fp-default">Group ID</label>
                        <input class="form-control" value="{{$plan->group_id}}" disabled>
                      </div>
                    </div>
                  @endif

                  @if ($plan->client_id)
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <label for="fp-default">Full Name</label>
                        <input class="form-control" value="{{$clients->first()->name}}" disabled>
                        <input type="hidden" name="id" value="{{$agenda->id}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="fp-default">Organization</label>
                        <input class="form-control" value="{{$clients->first()->organization}}" disabled>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="fp-default">Company</label>
                        <input class="form-control" value="{{$clients->first()->company}}" disabled>
                      </div>
                    </div>
                  @endif
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Topic</label>
                      <input type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ $agenda_detail->topic }}" placeholder="Insert a topic..." id="topic" disabled>
                      @error('topic')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label class="form-label" for="basic-icon-default-fullname">Media</label>
                      <select class="form-control @error('media') is-invalid @enderror" id="media" aria-label=".form-select-lg example" name="media" disabled>
                        <option value="Meeting Room" id="Meeting Room" @if($agenda_detail->media == 'Meeting
                          Room') selected @endif>Meeting Room</option>
                        <option value="Whatsapp" id="Whatsapp" @if($agenda_detail->media ==
                          'Whatsapp') selected @endif>Whatsapp</option>
                      </select>
                      @error('media')
                      <small class="text-danger">
                        <strong>{{ $message }}</strong>
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="row media_url" @if ($agenda_detail->media == 'Whatsapp') style="display: none" @endif>
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Media url</label>
                      <input type="text" class="form-control @error('media_url') is-invalid @enderror" name="media_url" value="{{ $agenda_detail->media_url }}" placeholder="Insert a url media..." id="media_url" disabled>
                      @error('media_url')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-8 form-group">
                      <label for="fp-default">Activity Date</label>
                      <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $agenda_detail->date }}" disabled>
                      <input type="hidden" id="time_hidden" value="{{ $agenda_detail->time }}">
                      @error('date')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    {{-- <div class="col-md-4 form-group">
                      <label for="fp-default">Activity Time</label>
                      <input type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $agenda_detail->time }}" id="time" disabled>
                      @error('time')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div> --}}
                    <div class="form-group col-md-4">
                      <label for="time">Activity Time</label>
                      <select name="time" class="form-control @error('time') is-invalid @enderror" id="time" disabled>
                        <option hidden selected value>Pilih Jam Mulai</option>
                      </select>
                      @error('time')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label class="form-label" for="basic-icon-default-fullname">Duration</label>
                      <select class="form-control @error('duration') is-invalid @enderror" aria-label=".form-select-lg example" id="duration" name="duration" disabled>
                        <option hidden selected value>Choose a duration</option>
                        <option value="30" @if($agenda_detail->duration == '30') selected @endif>30 Minutes</option>
                        <option value="60" @if($agenda_detail->duration == '60') selected @endif>60 Minutes</option>
                        <option value="90" @if($agenda_detail->duration == '90') selected @endif>90 Minutes</option>
                        <option value="120" @if($agenda_detail->duration == '120') selected @endif>120 Minutes</option>
                      </select>
                      @error('duration')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <a href="{{route('agendas.index')}}" class="btn btn-secondary">Back</a>
                  @if ($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled' ||
                  $agenda_detail->status == 'unschedule')
                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
      <!--/ Basic table -->
    </div>
  </div>

<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">

  $(document).ready(function() {

    var SelectedTime = $('#time_hidden').val();
    $('#time').append('<option value="'+ SelectedTime +'" selected>'+ SelectedTime +'</option>');
    // console.log(SelectedTime);

    var SelectedDate = new Date($('#date').val());
    var SelectedDay = SelectedDate.getDate();
    var SelectedMonth = SelectedDate.getMonth()+1;
    var SelectedYear = SelectedDate.getFullYear();

    if(SelectedMonth < 10){
      SelectedMonth = '0' + SelectedMonth.toString();
    }

    if(SelectedDay < 10){
      SelectedDay = '0' + SelectedDay.toString();
    }

    var SelectedDateOld = SelectedYear + '-' + SelectedMonth + '-' + SelectedDay;

    if (SelectedDateOld !== null) {

      var dateToday = new Date();

      var month = dateToday.getMonth() + 1;
      var day = dateToday.getDate();
      var year = dateToday.getFullYear();

      if(month < 10)
        month = '0' + month.toString();

      if(day < 10)
        day = '0' + day.toString();

      var maxDate = year + '-' + month + '-' + day;

      if(SelectedDateOld == maxDate){
        var formatted = dateToday.getHours();
        var minutes = dateToday.getMinutes();

        if (formatted < 9) {
          formatted = 8;
        }

        for (i = formatted; i <= 22; i++) {
          // console.log(i);
          for (var y = 0; y < 60; y+=15) {
            if (i < 10 || y < 10) {
              if (i < 10) {
                var xi = '0' + i;
              } else {
                var xi = i;
              }
              if (y < 10) {
                var xy = '0' + y;
              } else {
                var xy = y;
              }
              var time = xi+':'+xy;
            } else {
              var time = i+':'+y;
            }
            if (i == formatted && y < minutes ) {
              console.log('masuk');
            } else {
              $('#time').append('<option value="'+ time +':00">'+ time +'</option>');
            }
          }
        }
      }

      if(SelectedDateOld !== maxDate){
        var formatted = 8;

        for (i = formatted; i <= 22; i++) {
          // console.log(i);
          for (var y = 0; y < 60; y+=15) {
            if (i < 10 || y < 10) {
              if (i < 10) {
                var xi = '0' + i;
              } else {
                var xi = i;
              }
              if (y < 10) {
                var xy = '0' + y;
              } else {
                var xy = y;
              }
              var time = xi+':'+xy;
            } else {
              var time = i+':'+y;
            }
            $('#time').append('<option value="'+ time +':00">'+ time +'</option>');
          }
        }
      }
    }

    $("#media").on('change', function() {
      $(".media_url").toggle(500);
    });

    $('#date').attr('min', maxDate);

    $('#date').on('change',function() {
      SelectedDate = new Date($('#date').val());

      var SelectedDay = SelectedDate.getDate();
      var SelectedMonth = SelectedDate.getMonth()+1;
      var SelectedYear = SelectedDate.getFullYear();

      if(SelectedMonth < 10){
        SelectedMonth = '0' + SelectedMonth.toString();
      }

      if(SelectedDay < 10){
        SelectedDay = '0' + SelectedDay.toString();
      }

      var SelectedDateNew = SelectedYear + '-' + SelectedMonth + '-' + SelectedDay;
      console.log(SelectedDateNew);

      $('#time').find('option').remove();
      $('#time').append('<option hidden selected value>Pilih Jam Mulai</option>');

      if(SelectedDateNew == maxDate){
        var formatted = dateToday.getHours();
        var minutes = dateToday.getMinutes();

        if (formatted < 9) {
          formatted = 8;
        }

        for (i = formatted; i <= 22; i++) {
          // console.log(i);
          for (var y = 0; y < 60; y+=15) {
            if (i < 10 || y < 10) {
              if (i < 10) {
                var xi = '0' + i;
              } else {
                var xi = i;
              }
              if (y < 10) {
                var xy = '0' + y;
              } else {
                var xy = y;
              }
              var time = xi+':'+xy;
            } else {
              var time = i+':'+y;
            }
            if (i == formatted && y < minutes ) {
              console.log('masuk');
            } else {
              $('#time').append('<option value="'+ time +':00">'+ time +'</option>');
            }
          }
        }
      }

      if(SelectedDateNew !== maxDate){
        var formatted = 8;

        for (i = formatted; i <= 22; i++) {
          // console.log(i);
          for (var y = 0; y < 60; y+=15) {
            if (i < 10 || y < 10) {
              if (i < 10) {
                var xi = '0' + i;
              } else {
                var xi = i;
              }
              if (y < 10) {
                var xy = '0' + y;
              } else {
                var xy = y;
              }
              var time = xi+':'+xy;
            } else {
              var time = i+':'+y;
            }
            $('#time').append('<option value="'+ time +':00">'+ time +'</option>');
          }
        }
      }
    });
  });

  @if($agenda_detail->status == 'scheduled' || $agenda_detail-> status == 'rescheduled' || $agenda_detail-> status == 'unschedule')
  $(function() {
    // $('#plan_id').prop('disabled', false);
    // $('#client_id').prop('disabled', false);
    $('#topic').prop('disabled', false);
    $('#media').prop('disabled', false);
    $('#media_url').prop('disabled', false);
    $('#date').prop('disabled', false);
    $('#time').prop('disabled', false);
    $('#duration').prop('disabled', false);
  });
  @endif
</script>

<script type="text/javascript">

  // $('.livesearch-plans').select2({
  //   placeholder: 'Select plans',
  //   ajax: {
  //     url: "{{route('plans.search')}}",
  //     dataType: 'json',
  //     delay: 250,
  //     processResults: function(data) {
  //       return {
  //         results: $.map(data, function(item) {
  //           console.log(item)
  //           return {
  //             text: item.objective,
  //             id: item.id,
  //           }
  //         })
  //       };
  //     },
  //     cache: true
  //   }
  // });
  //
  // $(".livesearch-plans").on('change', function(e) {
  //   // Access to full data
  //   console.log($(this).select2('data'));
  //   console.log($(this).select2('data')[0].id);
  //   var dd = $(this).select2('data')[0];
  // });

</script>
@endpush
