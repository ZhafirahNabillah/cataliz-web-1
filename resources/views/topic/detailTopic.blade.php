@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Topics
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('topic.index')}}">Topic</a>
                </li>
                <li class="breadcrumb-item active">{{ $category }}
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
            <div class="card-header">
              <h4 class="card-title"><b>Detail Topic</b>
              </h4>
              <a href="{{ route('topic.download', $topic->id) }}" class="btn btn-primary">Download PDF</a>
            </div>
            <div class="card-body">
              <div class="card border">
                <div class="text-center card-title mt-1">
                  <h2><b> {{ $topic->topic }}</b></h2><span>created by: {{ $topic->trainer->name }}</span>
                </div>
                <div class="card-body">
                  <div class="collapse-icon">
                    <div class="accordion" id="accordionExample">
                      <div class="card">
                        <div id="headingCollapse1" class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                          <span class="lead collapse-title"><b>Description</b></span>
                        </div>
                        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show" data-parent="#accordionExample">
                          <div class="card-body">
                            {!!$topic->description!!}
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                          <span class="lead collapse-title"><b>Requirement</b></span>
                        </div>
                        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" data-parent="#accordionExample">
                          <div class="card-body">
                            {!!$topic->client_requirement!!}
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div id="headingCollapse3" class="card-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                          <span class="lead collapse-title"><b>Who Is This Topic For?</b></span>
                        </div>
                        <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" data-parent="#accordionExample">
                          <div class="card-body">
                            {!!$topic->client_target!!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <ul class="nav nav-tabs justify-content-center pt-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#sub-topic" aria-controls="profile" role="tab" aria-selected="false">Sub Topic</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="coach-tab" data-toggle="tab" href="#participant" aria-controls="coach" role="tab" aria-selected="true">Participant</a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="sub-topic" aria-labelledby="sub-topic-tab" role="tabpanel">
                <div class="card-body">
                  <div class="row mb-1">
                    <div class="col-12">
                      <!-- Button trigger modal -->
                      @can('create-topic')
                      <button type="button" class="btn btn-primary" data-toggle="modal" id="add-sub-topic-btn">
                        New Sub Topic
                      </button>
                      @endcan
                    </div>
                  </div>
                  <div class="card border">
                    <div class="card-body">
                      <div class="collapse-icon">
                        <div class="collapse-default sub-topic-wrapper">
                          @forelse ($sub_topics as $sub_topic)
                            <div class="card" id="{{ $sub_topic->id }}">
                              <div class="card-header" data-toggle="collapse" role="button"
                                data-target="#sub-topic-{{ $sub_topic->id }}" aria-expanded="false"
                                aria-controls="collapse1">
                                <span class="lead collapse-title"><b>{{ $sub_topic->sub_topic }}</b></span>
                              </div>
                              <div id="sub-topic-{{ $sub_topic->id }}" role="tabpanel" class="collapse">
                                <div class="card-body">

                                  @if ($message = Session::get('success'))
                                  <div class="alert alert-success alert-dissmisable">
                                      <h4 class="alert-heading">Success</h4>
                                      <div class="alert-body">{{ $message }}</div>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  @endif

                                  @can('create-topic')
                                  <div class="text-left">
                                    {{-- <button type="button" class="btn btn-primary create-lesson-btn mb-1" data-toggle="modal" data-id="{{ $sub_topic->id }}">
                                      New Materi
                                    </button> --}}
                                    <a href="{{ url('/lesson/create?sub_topic='.$sub_topic->id) }}" class="btn btn-primary mb-1">New Lesson</a>
                                  </div>
                                  @endcan
                                  <div class="lesson-wrapper-{{ $sub_topic->id }}">
                                    @forelse ($sub_topic->lessons as $lesson)
                                    <div class="row mb-1 align-items-center lesson-{{ $lesson->id }}">
                                      <div class="col-sm-4"><b>{{ $lesson->lesson_name }}</b></div>
                                      <div class="col-sm-4">
                                        <button type="button" class="btn btn-sm btn-primary playLessonBtn" data-id="{{ $lesson->id }}" data-toggle="modal">Play</button>
                                        <a href="{{ $lesson->meeting->meeting_url }}" class="btn btn-sm btn-primary">URL</a>
                                        {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal">Edit</button> --}}
                                        @can('create-topic')
                                        <a href="{{ route('lesson.edit', $lesson->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                      </div>
                                    </div>
                                    @empty
                                      <div class="lesson-empty">
                                        No lesson available yet.
                                      </div>
                                    @endforelse
                                  </div>
                                </div>
                              </div>
                            </div>
                          @empty
                            <div class="sub-topic-empty">
                              No sub topic available
                            </div>
                          @endforelse
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal create sub topic -->
                  <div class="modal fade" id="create-sub-topic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Create Sub Topic</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="create-sub-topic-form">
                            <div class="form-group">
                              <label for="sub_topic">Name</label>
                              <input class="form-control" type="text" name="sub_topic" placeholder="Your Sub Topic Here...">
                              <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="save-sub-topic-btn">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal create lesson -->
                  <div class="modal fade" id="create-lesson-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Create Materi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="create-lesson-form" id="create-lesson-form" method="post" action="{{ route('lesson.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="topic">Lesson Title</label>
                              <input class="form-control" type="text" name="lesson_name" placeholder="Title ...">
                            </div>
                            <input type="hidden" name="sub_topic_id" id="sub_topic_id">
                            <input type="hidden" name="video_name" id="video_name">
                          </form>
                          <label for="dropzone">Upload Lesson Video</label>
                          <form action="{{ route('lesson.chunk_upload') }}" class='dropzone' id="dropzone"></form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="save-lesson-btn">Create</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal play lesson -->
                  <div class="modal fade" id="play-lesson-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="lesson-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body video_wrapper">
                            <video width="100%" controls autoplay name="media">
                              <source id="video_source" src="" type="video/mp4">
                            </video>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="tab-pane" id="participant" aria-labelledby="participant-tab" role="tabpanel">
                  <div class="card-header py-0">
                    <h4 class="card-title"><b>Detail Participant</b>
                    </h4>
                  </div>
                  <div class="card-body">
                    <!-- Basic table -->
                    <section id="basic-datatable">
                      <div class="row">
                        <div class="col-12">
                          <table class="datatables-basic table-striped table topic-participant-datatable">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Program</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script type="text/javascript">
  // popover
  $(function() {
    var collapse_id = $(location).attr('hash');
    console.log(collapse_id);
    $(collapse_id).collapse('show');

    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'top',
      content: function() {
        return '<img src="' + $(this).data('img') + '" />';
      }
    });

    var table_topic_participant = $('.topic-participant-datatable').DataTable({
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
          data: 'email',
          name: 'email',
        },
        {
          data: 'program',
          name: 'program',
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

    $('#add-sub-topic-btn').click(function() {
      $('#create-sub-topic-modal').modal('show');
    });

    var sub_topic_active = 0;
    $('body').on('click', '.create-lesson-btn', function() {
      sub_topic_active = $(this).data('id');
      $('#create-lesson-modal').modal('show');
      $('#sub_topic_id').val(sub_topic_active);
    });

    $('body').on('click', '.playLessonBtn', function() {
      console.log('tes');
      var lesson_id = $(this).data('id');
      $.get("" + '/lesson/' + lesson_id, function(data) {
        $('#lesson-title').html(data.lesson_name);
        // console.log(data);
        $('#video_source').attr('src', 'https://cataliz-s3.s3.ap-southeast-1.amazonaws.com/lessons/' + data.video);
        $('.video_wrapper video')[0].load();
        $('#play-lesson-modal').modal('show');
      })
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#save-sub-topic-btn').click(function() {
      var data = $('.create-sub-topic-form').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('sub-topic.store') }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#create-sub-topic-modal').modal('hide');
          $('.create-sub-topic-form').trigger("reset");
          $('.sub-topic-empty').empty();
          append_sub_topic(data.id, data.sub_topic);
          Swal.fire({
            icon: 'success',
            title: 'Account updated successfully!',
          });
        },
        error: function(reject) {
          $('#saveBtn').html('Submit');
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

    // $('#save-lesson-btn').click(function () {
    //   $('.create-lesson-form').submit();
    //       // var data = $('.create-lesson-form').serialize();
    //       // var formData = new FormData(document.getElementById('create-lesson-form'));
    //       // console.log(formData);
    //       // $(this).html('Submitting...')
    //       //
    //       // $.ajax({
    //       //   url: "",
    //       //   type: "POST",
    //       //   data: formData,
    //       //   dataType:'JSON',
    //       //   cache:false,
    //       //   contentType: false,
    //       //   processData: false,
    //       //   success: function(data) {
    //       //     console.log(data);
    //       //     $('#create-lesson-modal').modal('hide');
    //       //     $('.create-lesson-form').trigger("reset");
    //       //     // $('.sub-topic-empty').empty();
    //       //     append_lesson(data.id, data.lesson_name, data.sub_topic_id);
    //       //     Swal.fire({
    //       //       icon: 'success',
    //       //       title: 'Account updated successfully!',
    //       //     });
    //       //   },
    //       //   error: function(reject) {
    //       //     $('#saveBtn').html('Submit');
    //       //     // if (reject.status === 422) {
    //       //     //   var errors = JSON.parse(reject.responseText);
    //       //     //   if (errors.name) {
    //       //     //     $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
    //       //     //   }
    //       //     //   if (errors.phone) {
    //       //     //     $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
    //       //     //   }
    //       //     //   if (errors.email) {
    //       //     //     $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
    //       //     //   }
    //       //     //   if (errors.roles) {
    //       //     //     $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
    //       //     //   }
    //       //     // }
    //       //   }
    //       // });
    // });

    // var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    //
    // Dropzone.autoDiscover = false;
    // var myDropzone = new Dropzone(".dropzone",{
    //     // maxFilesize: 20,  // 3 mb
    //     // acceptedFiles: ".mp4, .mkv",
    //     // chunking: true,
    //     // chunkSize: 1024,
    //     // retryChunks: true,
    //     // retryChunksLimit: 3
    //     acceptedFiles: ".mp4, .mkv",
    //     chunking: true,
    //     method: "POST",
    //     maxFilesize: 400000000,
    //     chunkSize: 1000000,
    //     // If true, the individual chunks of a file are being uploaded simultaneously.
    //     parallelChunkUploads: true
    // });

    // myDropzone.on("sending", function(file, xhr, formData) {
    //    formData.append("_token", {{ csrf_token() }});
    // });

    // myDropzone.on("success", function(file, response) {
    //    console.log(response);
    // });

    function append_sub_topic(id, sub_topic) {
      var base_url = window.location.origin;
      var sub_topic_html = '<div class="card" id="' + id + '">';
      sub_topic_html += '<div class="card-header" data-toggle="collapse" role="button" data-target="#sub-topic-' + id + '" aria-expanded="false" aria-controls="collapse1"><span class="lead collapse-title"><b>' + sub_topic + '</b></span></div>';
      sub_topic_html += '<div id="sub-topic-' + id + '" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">';
      sub_topic_html += '<div class="card-body">';
      sub_topic_html += '<div class="text-left"><a href="'+base_url+'/lesson/create?sub_topic='+id+'" class="btn btn-primary mb-1">New Lesson</a></div>';
      sub_topic_html += '<div class="lesson-wrapper-' + id + '">'
      sub_topic_html += '</div>';
      sub_topic_html += '</div>';
      sub_topic_html += '</div>';
      sub_topic_html += '</div>';

      $('.sub-topic-wrapper').append(sub_topic_html);
    }

    // function append_lesson(id, lesson_name, sub_topic_id) {
    //   var lesson_html = '<div class="row mb-1 align-items-center lesson-' + id + '">';
    //   lesson_html += '<div class="col-sm-4"><b>' + lesson_name + '</b></div>';
    //   lesson_html += '<div class="col-sm-4">';
    //   lesson_html += '<button type="button" class="btn btn-sm btn-primary playLessonBtn" data-id="' + id + '" data-toggle="modal">Play</button>';
    //   lesson_html += '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal">Edit</button>';
    //   lesson_html += '</div>';
    //   lesson_html += '</div>';
    //
    //   $('.lesson-wrapper-' + sub_topic_id).append(lesson_html);
    // }
  });
</script>
@endpush
