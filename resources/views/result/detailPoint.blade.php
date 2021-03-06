@extends('layouts.layoutVerticalMenu')

@section('title','Result')

@push('styles')
<style media="screen">
  li {
    list-style-type: none;
  }
</style>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
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
              <h3 class="mt-1"><b>{{ $topic->topic }}</b></h3>
              <p><span>created by {{ $topic->trainer->name }} </span></p>
            </div>

            <div class="card-body">

              <div class="row mb-2">
                <div class="col-sm-2">
                  @role('trainer|admin|coachee')
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
                  {{ $client->name }}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Submitted at</b>
                </div>
                <div class="col-sm-3">
                  {{ $exam_result->attempt_submit }}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Score</b>
                </div>
                <div class="col-sm-3">
                  {{ $exam_result->grade }} out of 100
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Total Question</b>
                </div>
                <div class="col-sm-3">
                  {{ $exam_result->answers->count() }}
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs justify-content-center" role="tablist">
                @role('mentor|trainer|admin|coach')
                <li class="nav-item">
                  <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#review" aria-controls="coach" role="tab" aria-selected="true">Review</a>
                </li>
                @endrole
                <li class="nav-item">
                  @role('mentor')
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile" role="tab" aria-selected="false">Feedback to Mentee</a>
                  @endrole
                  @role('trainer')
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile" role="tab" aria-selected="false">Feedback to Trainee</a>
                  @endrole
                </li>
                @role('mentor|trainer')
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#report" aria-controls="profile" role="tab" aria-selected="false">Report to Coach</a>
                </li>
                @endrole
                @role('coachee')
                <li class="nav-item">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#feedback_from_trainer" aria-controls="profile" role="tab" aria-selected="false">Feedback from Trainer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback_from_mentor" aria-controls="profile" role="tab" aria-selected="false">Feedback from Mentor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback_to_trainer" aria-controls="profile" role="tab" aria-selected="false">Feedback to Trainer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback_to_mentor" aria-controls="profile" role="tab" aria-selected="false">Feedback to Mentor</a>
                </li>
                @endrole
                @role('admin|coach')
                <li class="nav-item">
                  <a class="nav-link" id="coach-tab" data-toggle="tab" href="#feedback" aria-controls="coach" role="tab" aria-selected="true">Feedback</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="coach-tab" data-toggle="tab" href="#report" aria-controls="coach" role="tab" aria-selected="true">Report</a>
                </li>
                @endrole
              </ul>
              <div class="tab-content">
                @role('mentor|trainer|admin|coach')
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
                                  @if ($answer->answer == $loop->iteration && $answer->is_correct_answer == 1)
                                    <li class="text-success">{{$choice_itr++}}. {{ $answer_choice }}</li>
                                  @elseif ($answer->answer == $loop->iteration && $answer->is_correct_answer == 0)
                                    <li class="text-danger">{{$choice_itr++}}. {{ $answer_choice }}</li>
                                  @else
                                    <li>{{$choice_itr++}}. {{ $answer_choice }}</li>
                                  @endif
                                @endforeach
                                <br>
                                <p><b> The correct answer is:</b><br>
                                  <span style="background-color: #9EEEA1;" class="d-block p-1">
                                    {{ $answer_choices[$answer->question->true_answer - 1] }}</span>
                                  </p>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  <!-- /panel Review-->
                @endrole

                @role('trainer|mentor')
                <!-- Panel Feedback -->
                <div class="tab-pane" id="feedback" aria-labelledby="feedback-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">
                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Feedback</b></span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">
                            @empty ($feedback)
                              <a href="javascript:;" class="createNewFeedback btn btn-primary">Create <span data-feather="edit"></span></a>
                            @endempty

                            <div id="feedback_wrapper">
                              @if($feedback)
                                {!! $feedback->description !!}
                              @else
                                <small><i>Feedback is not yet available</i></small>
                              @endif
                            </div>
                            <!-- Modal Feedback-->
                            <div class="modal fade bd-example-modal-lg" id="modalCreateFeedback" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Feedback to Mentee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form id="feedbackForm">
                                      <div class="form-group">
                                        <label for="description">Feedback</label>
                                        <textarea name="description" id="description" cols="20" rows="20" placeholder="Type your text here ..."></textarea>
                                      </div>
                                      @role('mentor')
                                        <input type="hidden" name="to" value="mentee">
                                      @endrole
                                      @role('trainer')
                                        <input type="hidden" name="to" value="trainee">
                                      @endrole
                                      <input type="hidden" name="from" value="{{ auth()->user()->getRoleNames()->first() }}">
                                      <input type="hidden" name="result_id" value="{{ $exam_result->id }}">
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary saveFeedback">Submit</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /modal Feedback-->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /feedback-->
                @endrole

                @role('coachee')
                  <!-- Panel Feedback -->
                  <div class="tab-pane active" id="feedback_from_trainer" aria-labelledby="feedback-tab" role="tabpanel">
                    <div class="card mb-0">
                      <div class="card-body">
                          <div id="feedback_wrapper">
                            @if($feedback_to->contains('from','trainer'))
                              {!! $feedback_to->where('from','trainer')->first()->description !!}
                            @else
                              Feedback is not yet available
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="feedback_from_mentor" aria-labelledby="feedback-tab" role="tabpanel">
                    <div class="card mb-0">
                      <div class="card-body">
                          <div id="feedback_wrapper">
                            @if($feedback_to->contains('from','mentor'))
                              {!! $feedback_to->where('from','mentor')->first()->description !!}
                            @else
                              Feedback is not yet available
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="feedback_to_mentor" aria-labelledby="feedback-tab" role="tabpanel">
                    <div class="card mb-0">
                      <div class="card-body">
                          @empty ($feedback_from->where('from','mentee')->first())
                            <a href="javascript:;" class="createNewFeedback btn btn-primary" id="feedback_to_mentor_btn" data-id="mentee_to_mentor">Create <span data-feather="edit"></span></a>
                          @endempty
                          <div id="feedback_wrapper_to_mentor">
                            @if($feedback_from->where('from','mentee')->first())
                              {!! $feedback_from->where('from','mentee')->first()->description !!}
                            @else
                              <small><i>Feedback is not yet available</i></small>
                            @endif
                          </div>
                          <!-- Modal Feedback-->
                          <div class="modal fade bd-example-modal-lg" id="modalCreateFeedback_to_mentor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Feedback to Mentor</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form id="feedback_form_to_mentor">
                                    <div class="form-group">
                                      <label for="description">Feedback</label>
                                      <textarea name="description" id="description" cols="20" rows="20" placeholder="Type your text here ..."></textarea>
                                    </div>
                                    <input type="hidden" name="to" value="mentor">
                                    <input type="hidden" name="from" value="mentee">
                                    <input type="hidden" name="result_id" value="{{ $exam_result->id }}">
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary saveFeedback" data-id="mentee_to_mentor">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /modal Feedback-->
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="feedback_to_trainer" aria-labelledby="feedback-tab" role="tabpanel">
                    <div class="card mb-0">
                      <div class="card-body">

                          @empty ($feedback_from->where('from','trainee')->first())
                            <a href="javascript:;" class="createNewFeedback btn btn-primary" id="feedback_to_trainer_btn" data-id="trainee_to_trainer">Create <span data-feather="edit"></span></a>
                          @endempty
                          <div id="feedback_wrapper_to_trainer">
                            @if($feedback_from->where('from','trainee')->first())
                              {!! $feedback_from->where('from','trainee')->first()->description !!}
                            @else
                              <small><i>Feedback is not yet available</i></small>
                            @endif
                          </div>
                          <!-- Modal Feedback-->
                          <div class="modal fade bd-example-modal-lg" id="modalCreateFeedback_to_trainer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Feedback to Trainer</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form id="feedback_form_to_trainer">
                                    <div class="form-group">
                                      <label for="description">Feedback</label>
                                      <textarea name="description" id="description" cols="20" rows="20" placeholder="Type your text here ..."></textarea>
                                    </div>
                                    <input type="hidden" name="to" value="trainer">
                                    <input type="hidden" name="from" value="trainee">
                                    <input type="hidden" name="result_id" value="{{ $exam_result->id }}">
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary saveFeedback" data-id="trainee_to_trainer">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /modal Feedback-->
                      </div>
                    </div>
                  </div>
                  <!-- /feedback-->
                @endrole

                @role('trainer|mentor')
                <!-- Panel Report -->
                <div class="tab-pane" id="report" aria-labelledby="report-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">

                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Report</b></span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">
                          @empty ($report)
                            <a href="javascript:;" class="createNewReport btn btn-primary">Create<span data-feather="edit"></span></a>
                          @endempty

                          <div id="report_wrapper">
                            @if($report)
                              {!! $report->description !!}
                            @else
                              <small><i>Report is not yet available</i></small>
                            @endif
                          </div>

                          <!-- Modal Feedback-->
                          <div class="modal fade bd-example-modal-lg" id="modalCreateReport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Report to Coach</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form id="reportForm">
                                    <div class="form-group">
                                      <label for="description">Report</label>
                                      <textarea name="description" id="description" cols="20" rows="20" placeholder="Type your text here ..."></textarea>
                                    </div>
                                    <input type="hidden" name="to" value="coach">
                                    <input type="hidden" name="from" value="{{ auth()->user()->getRoleNames()->first() }}">
                                    <input type="hidden" name="result_id" value="{{ $exam_result->id }}">
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary saveReport">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /modal Feedback-->
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                </div>
                <!-- /Report -->
                @endrole

                @role('admin|coach')
                <div class="tab-pane" id="feedback" aria-labelledby="feedback-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">
                      @forelse ($feedback as $feedback_data)
                        <div class="card">
                          <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#feedback-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse1">
                            <span class="lead collapse-title"><b>Feedback {{ ucfirst(trans($feedback_data->from)) }} to {{ ucfirst(trans($feedback_data->to)) }}</b></span>
                          </div>
                          <div id="feedback-{{ $loop->index }}" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                            <div class="card-body">
                              <div id="feedback_wrapper">
                                {!! $feedback_data->description !!}
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="card">
                          No report available
                        </div>
                      @endforelse
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="report" aria-labelledby="report-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">
                      @forelse ($report as $report_data)
                        <div class="card">
                          <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#report-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse1">
                            <span class="lead collapse-title"><b>Report {{ ucfirst(trans($report_data->from)) }} to {{ ucfirst(trans($report_data->to)) }}</b></span>
                          </div>
                          <div id="report-{{ $loop->index }}" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                            <div class="card-body">
                              <div id="feedback_wrapper">
                                {!! $report_data->description !!}
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="card">
                          No report available
                        </div>
                      @endforelse
                    </div>
                  </div>
                </div>
                @endrole
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  @role('mentor|trainer')
  // feedback
  $('body').on('click', '.createNewFeedback', function() {
    $('#modalHeading').html("Feedback to Trainee");
    $('#modalCreateFeedback').modal('show');
  });
  @endrole

  @role('coachee')
  // feedback
  $('.createNewFeedback').click(function() {
    var target = $(this).data('id');
    console.log(target);
    if (target == 'mentee_to_mentor') {
      console.log(target);
      $('#modalCreateFeedback_to_mentor').modal('show');
    } else if (target == 'trainee_to_trainer') {
      console.log(target);
      $('#modalCreateFeedback_to_trainer').modal('show');
    }
  });
  @endrole

  // meeting
  $('body').on('click', '.createNewMeeting', function() {
    $('#modalHeading').html("Meeting");
    $('#modalCreateMeeting').modal('show');
  });

  // Report
  $('body').on('click', '.createNewReport', function() {
    $('#modalHeading').html("Meeting");
    $('#modalCreateReport').modal('show');
  });

  // Feedback Submit
  @role('trainer|mentor')
  $('body').on('click', '.saveFeedback', function() {
    var data = $('#feedbackForm').serialize();
    $('#modalCreateFeedback').html('Submitting...');
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('training_feedback.store') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#modalCreateFeedback').modal('hide');
        $('.feedbackForm').trigger("reset");
        // $('.sub-topic-empty').empty();
        // append_sub_topic(data.id, data.sub_topic);
        $('#feedback_wrapper').html(data.description);
        $('.createNewFeedback').hide();
        Swal.fire({
          icon: 'success',
          title: 'Feedback saved successfully!',
        });
      },
      error: function(reject) {
        $('#modalCreateFeedback').html('Submit');
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.name) {
        //     $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
        //   }
        //   if (errors.phone) {
        //     $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
        //   }
        //   if (errors.email) {
        //     $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
        //   }
        //   if (errors.roles) {
        //     $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });
  @endrole

  @role('coachee')
  $('body').on('click', '.saveFeedback', function() {
    var target = $(this).data('id');
    console.log(target);
    if (target == 'trainee_to_trainer') {
      var data = $('#feedback_form_to_trainer').serialize();
    } else if (target == 'mentee_to_mentor') {
      var data = $('#feedback_form_to_mentor').serialize();
    }
    // console.log(data);

    $(this).html('Submitting...');

    $.ajax({
      data: data,
      url: "{{ route('training_feedback.store') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        // $('#modalCreateFeedback').modal('hide');
        // $('.feedbackForm').trigger("reset");
        // $('.sub-topic-empty').empty();
        // append_sub_topic(data.id, data.sub_topic);
        if (target == 'trainee_to_trainer') {
          $('#modalCreateFeedback_to_trainer').modal('hide');
          $('#feedback_form_to_trainer').trigger("reset");
          $('#feedback_wrapper_to_trainer').html(data.description);
          $('#feedback_to_trainer_btn').hide();
        } else if (target == 'mentee_to_mentor') {
          $('#modalCreateFeedback_to_mentor').modal('hide');
          $('#feedback_form_to_mentor').trigger("reset");
          $('#feedback_wrapper_to_mentor').html(data.description);
          $('#feedback_to_mentor_btn').hide();
        }
        Swal.fire({
          icon: 'success',
          title: 'Feedback saved successfully!',
        });
      },
      error: function(reject) {
        $(this).html('Submit');
      }
    });
  });
  @endrole

  // Report Submit
  $('body').on('click', '.saveReport', function() {
    var data = $('#reportForm').serialize();
    $('.saveReport').html('Submitting...');
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('training_feedback.store') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#modalCreateReport').modal('hide');
        $('#reportForm').trigger("reset");
        // $('.sub-topic-empty').empty();
        // append_sub_topic(data.id, data.sub_topic);
        $('#report_wrapper').html(data.description);
        $('.createNewReport').hide();
        Swal.fire({
          icon: 'success',
          title: 'Feedback saved successfully!',
        });
      },
      error: function(reject) {
        $('#modalCreateReport').html('Submit');
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.name) {
        //     $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
        //   }
        //   if (errors.phone) {
        //     $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
        //   }
        //   if (errors.email) {
        //     $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
        //   }
        //   if (errors.roles) {
        //     $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //Meeting Submit
  $('body').on('click', '.submitMeetingBtn', function() {
    var data = $('#meetingForm').serialize();
    $('.submitMeetingBtn').html('Submitting...');
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('training_meeting.store') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#modalCreateMeeting').modal('hide');
        $('#meetingForm').trigger("reset");
        // $('.sub-topic-empty').empty();
        // append_sub_topic(data.id, data.sub_topic);
        // $('#meeting_wrapper').html(data.description);
        append_meeting(data.date_time, data.media, data.id);
        // $('.createNewMeeting').hide();
        Swal.fire({
          icon: 'success',
          title: 'Meeting created successfully!',
        });
      },
      error: function(reject) {
        $('#modalCreateMeeting').html('Submit');
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.name) {
        //     $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
        //   }
        //   if (errors.phone) {
        //     $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
        //   }
        //   if (errors.email) {
        //     $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
        //   }
        //   if (errors.roles) {
        //     $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  function append_meeting(date_time, media, meeting_id) {
    var meeting_html = '<div class="card" id="meeting' + meeting_id + '"><div class="row">';
    meeting_html += '<div class="col-sm-6"><strong>Time: </strong>' + date_time + '</div>';
    meeting_html += '<div class="col-sm-6"><strong>Media: </strong>' + media + '</div>';
    meeting_html += '</div></div>';

    $('#meeting_empty').empty();
    $('#meeting_wrapper').append(meeting_html);
  }

  // textarea
  tinymce.init({
    selector: 'textarea',
    height: 283,
    setup: function(editor) {
      editor.on('init change', function() {
        editor.save();
      });
    }
  });
</script>

@endpush
