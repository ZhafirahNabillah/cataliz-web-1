@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')
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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('topic.index')}}">Topic</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Detail Topic</a>
                </li>
                <li class="breadcrumb-item active">Create Lesson
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-12">
          <div class="card p-2">
            {{-- <form class="create-lesson-form" id="create-lesson-form" method="post" action="{{ route('lesson.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="topic">Lesson Title</label>
              <input class="form-control" type="text" name="lesson_name" placeholder="Tittle ...">
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Upload Video</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="video" id="video_input">
                  <label class="custom-file-label" for="video_input">Choose file</label>
                </div>
              </div>
            </div>
            <input type="hidden" name="sub_topic_id" id="sub_topic_id" value="{{ request()->get('sub_topic') }}">
            <button type="submit" class="btn btn-primary" name="button">Submit</button>
            </form> --}}
            <form class="create-lesson-form" id="create-lesson-form">
              @csrf
              <div class="form-group">
                <label for="topic">Lesson Title</label>
                <input class="form-control" type="text" name="lesson_name" placeholder="Title ...">
              </div>
              <input type="hidden" name="sub_topic_id" id="sub_topic_id" value="{{ request()->sub_topic }}">
              <input type="hidden" name="video_name" id="video_name">
            </form>
            <label for="dropzone">Video Upload</label>
            <form action="{{ route('lesson.chunk_upload') }}" class='dropzone' id="dropzone"></form>
            <form class="mt-1" id="meetingForm">
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
                    <input class="form-control" type="time" id="time" name="time">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="meetingTime">Meeting Media</label>
                    <select class="form-select form-control" name="media">
                      <option selected disabled>Select your media</option>
                      <option value="zoom">Zoom</option>
                      <option value="whatsapp">WhatsApp</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="meetingTime">Media URL</label>
                    <input class="form-control" id="" type="text" name="meeting_url" placeholder="Your url link ..." />
                  </div>
                </div>
              </div>
            </form>
            <div class="text-right">
              <button type="button" class="btn btn-primary" id="save-lesson-btn">Create</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END: Content-->
  @endsection

  @push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
  <script type="text/javascript">
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone(".dropzone",{
          // maxFilesize: 20,  // 3 mb
          // acceptedFiles: ".mp4, .mkv",
          // chunking: true,
          // chunkSize: 1024,
          // retryChunks: true,
          // retryChunksLimit: 3
          acceptedFiles: ".mp4, .mkv",
          chunking: true,
          method: "POST",
          maxFilesize: 400000000,
          chunkSize: 1000000,
          forceChunking: true,
          // If true, the individual chunks of a file are being uploaded simultaneously.
          parallelChunkUploads: true
      });

      myDropzone.on("sending", function(file, xhr, formData) {
         formData.append("_token", CSRF_TOKEN);
      });

      myDropzone.on("success", function(file, response) {
         console.log(response);
         $('#video_name').val(response.name);
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#save-lesson-btn').click(function () {
        var lesson_data = $('#create-lesson-form').serialize();
        var meeting_data = $('#meetingForm').serialize();

        var data = lesson_data+'&'+meeting_data;
        $('#save-lesson-button').html('Creating...');
        console.log(data);

        // $('.create-lesson-form').submit();

        $.ajax({
          data: data,
          url: "{{ route('lesson.store') }}",
          type: "POST",
          dataType: 'json',
          success: function(data) {
            console.log(data);
            // $('#modalCreateMeeting').modal('hide');
            $('#meetingForm').trigger("reset");
            $('#create-lesson-form').trigger("reset");
            window.location = "{{ url()->previous() }}"+"#sub-topic-"+data.lesson.sub_topic_id
            // $('.sub-topic-empty').empty();
            // append_sub_topic(data.id, data.sub_topic);
            // $('#meeting_wrapper').html(data.description);
            // append_meeting(data.date_time, data.media, data.id);
            // $('.createNewMeeting').hide();
            // Swal.fire({
            //   icon: 'success',
            //   title: 'Meeting created successfully!',
            // });
          },
          error: function(reject) {
            $('#save-lesson-button').html('Create');
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
  </script>
  @endpush