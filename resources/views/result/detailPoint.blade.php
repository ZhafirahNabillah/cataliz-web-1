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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="This page displays a list of the exam results that the mentee has obtained." />

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
              <h3 class="mt-1"><b>{{$topic->topic}}</b></h3>
              <p><span>created by {{$trainer_name->name}} </span></p>
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
                  {{$client->name}}
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
                  {{$grade}} out of 100
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
                  <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#review" aria-controls="coach"
                    role="tab" aria-selected="true">Review</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#feedback" aria-controls="profile"
                    role="tab" aria-selected="false">Feedback to Mentee</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#report" aria-controls="profile"
                    role="tab" aria-selected="false">Report to Coach</a>
                </li>

              </ul>

              <div class="tab-content">
                <!-- Panel Review -->
                <div class="tab-pane active" id="review" aria-labelledby="review-tab" role="tabpanel">
                  <div class="collapse-icon">
                    <div class="collapse-default">
                      @foreach ($answers as $answer)
                      <div class="card">
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
                          data-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>{{ 'Question '.$loop->iteration }}</b></span>
                        </div>
                        <div id="collapse{{ $loop->iteration }}" role="tabpanel" aria-labelledby="headingCollapse1"
                          class="collapse">
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
                              <span style="background-color: #9EEEA1;" class="d-block p-1">
                                {{ $answer_choices[$answer->question->true_answer] }}</span>
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
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
                          data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Feedback</b> </span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">
                            <a href="javascript:;" class="createNewFeedback"><span data-feather="edit"></span></a>

                            <p>Feedback is not yet available</p>

                            <!-- Modal Feedback-->
                            <div class="modal fade bd-example-modal-lg" id="modalCreateFeedback" tabindex="-1"
                              role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Feedback to Mentee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="description">New Feedback</label>
                                      <textarea name="description" id="description" cols="20" rows="20"
                                        placeholder="Type your text here ..."></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /modal Feedback-->

                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button"
                          data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                          <span class="lead collapse-title"><b>Meeting</b> <span data-feather="edit"></span> </span>
                        </div>
                        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse show">
                          <div class="card-body">
                            <a href="javascript:;" class="createNewMeeting text-right"><span
                                data-feather="edit"></span></a>
                            <p>The meeting has not been scheduled</p>

                            <!-- Modal Meeting-->
                            <div class="modal fade bd-example-modal-lg" id="modalCreateMeeting" tabindex="-1"
                              role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Meeting</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="meetingDate">Meeting Date</label>
                                          <input type="date" class="form-control" name="date" id="date" value=""
                                            placeholder="Select Meeting Date...">
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="meetingTime">Meeting Time</label>
                                          <label for="appt"></label>
                                          <input class="form-control" type="time" id="appt" name="appt">
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="meetingTime">Meeting Media</label>
                                          <select class="form-select form-control" aria-label="Default select example">
                                            <option selected disabled>Select your media</option>
                                            <option value="1">Sub One</option>
                                            <option value="2">Sub Two</option>
                                            <option value="3">Sub Three</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="meetingTime">Meeting Media</label>
                                          <input class="form-control" id="" type="text" name=""
                                            placeholder="Your url link ..." aria-describedby="" value="" autocomplete=""
                                            autofocus tabindex="1" />
                                        </div>
                                      </div>
                                    </div>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /modal Meeting-->

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
                        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
                          data-target="#collapse" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Report</b> <span data-feather="edit"></span> </span>
                        </div>
                        <div id="collapse" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show">
                          <div class="card-body">
                            <a href="javascript:;" class="createNewReport text-right"><span
                                data-feather="edit"></span></a>
                            <p> Report is not yet available</p>

                            <!-- Modal Report-->
                            <div class="modal fade bd-example-modal-lg" id="modalCreateReport" tabindex="-1"
                              role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Report to Coach</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="description">New Report</label>
                                      <textarea name="description" id="description" cols="20" rows="20"
                                        placeholder="Type your text here ..."></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
  <script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
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
    // feedback
    $('body').on('click', '.createNewFeedback', function() {
      $('#modalHeading').html("Feedback to Mentee");
      $('#modalCreateFeedback').modal('show');
    });

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


    // textarea
    tinymce.init({
      selector: 'textarea',

      image_class_list: [{
        title: 'img-fluid',
        value: 'img-fluid'
      }, ],
      height: 283,
      setup: function(editor) {
        editor.on('init change', function() {
          editor.save();
        });
      },
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

      image_title: true,
      automatic_uploads: true,
      images_upload_url: '/docs/upload_image',
      file_picker_types: 'image',
      file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
          var file = this.files[0];

          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function() {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), {
              title: file.name
            });
          };
        };
        input.click();
      }
    });
  </script>

  @endpush