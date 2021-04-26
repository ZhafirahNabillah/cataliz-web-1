@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')
<style media="screen">
  li {
    list-style-type: none;
  }
</style>
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
            <h2 class="content-header-title float-left mb-0">Result
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="This page displays a list of the exam results that the mentee has obtained." />

            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('result.index')}}">Result</a>
                </li>
                <li class="breadcrumb-item active">{{ $client->name }}
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      {{-- content --}}
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="text-center card-title ">
              <h3 class="mt-1"><b>#Topic Name</b></h3>
              <p><span>created by # </span></p>
            </div>

            <div class="card-body">

              <div class="row mb-2">
                <div class="col-sm-2">
                  @role('trainer')
                  <b>Trainee name</b>
                  @endrole
                  @role('mentor')
                  <b>Mentee name</b>
                  @endrole
                  @role('coach')
                  <b>Coachee name</b>
                  @endrole
                </div>
                <div class="col-sm-3">
                  #
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>State</b>
                </div>
                <div class="col-sm-3">
                  15/20
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Submitted at</b>
                </div>
                <div class="col-sm-3">
                  Day, dd mm yyyy
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Score</b>
                </div>
                <div class="col-sm-3">
                  87 out of 100
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Question</b>
                </div>
                <div class="col-sm-3">
                  15 out of 20
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#review" aria-controls="coach" role="tab" aria-selected="true">Review</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile" role="tab" aria-selected="false">Feedback to Mentee</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#report" aria-controls="profile" role="tab" aria-selected="false">Report to Coach</a>
                </li>

              </ul>

              <div class="tab-content">
                <!-- Panel Review -->
                <div class="tab-pane active" id="review" aria-labelledby="review-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">
                      @foreach ($answers as $answer)
                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>{{ 'Question '.$loop->iteration }}</b></span>
                        </div>
                        <div id="collapse{{ $loop->iteration }}" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                          <div class="card-body">
                            <p><b>Score:{{ $answer->question->weight }}</b></p>
                            <div class="question d-inline-flex">
                              <p> {!! $answer->question->question !!}</p>
                            </div>
                            <p>Answer</p>
                            @php ($choice_itr = 'A')
                            @foreach ($answer_choices = explode(',', $answer->question->answers) as $answer_choice)
                            @if ($answer->answer == $loop->index && $answer->is_correct_answer == 1)
                            <li class="text-success">{{$choice_itr++}}. {{ $answer_choice }}</li>
                            @elseif ($answer->answer == $loop->index && $answer->is_correct_answer == 0)
                            <li class="text-danger">{{$choice_itr++}}. {{ $answer_choice }}</li>
                            @else
                            <li>{{$choice_itr++}}. {{ $answer_choice }}</li>
                            @endif
                            @endforeach
                            <br>
                            <p><b> The correct answer is:</b><br>
                              <span style="background-color: #9EEEA1;" class="d-block p-1"> {{ $answer_choices[$answer->question->true_answer] }}</span>
                            </p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!-- /panel Review-->


                <!-- Panel Feedback -->
                <div class="tab-pane" id="feedback" aria-labelledby="feedback-tab" role="tabpanel">

                  <div class="collapse-icon">
                    <div class="collapse-default">

                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Feedback</b> <span data-feather="edit"></span> </span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">

                            Feedback is not yet available

                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                          <span class="lead collapse-title"><b>Meeting</b> <span data-feather="edit"></span> </span>
                        </div>
                        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse show">
                          <div class="card-body">
                            The meeting has not been scheduled
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /feedback-->


                <!-- Panel Report -->
                <div class="tab-pane" id="report" aria-labelledby="report-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">

                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Report</b> <span data-feather="edit"></span> </span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">

                            Report is not yet available

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /Report -->
              </div>
            </div>
          </div>
          <!-- /panel  -->

        </div>
      </div>
    </div>
  </div>
  <!-- /panel coachee -->



  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <script type="text/javascript">
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
    })
  </script>

  @endpush