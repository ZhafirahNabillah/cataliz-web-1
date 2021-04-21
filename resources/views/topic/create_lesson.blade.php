@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

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
              <img class="align-text width="15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Topic</a>
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
            {{-- <form class="create-lesson-form" id="create-lesson-form" method="post" action="{{ route('lesson.store') }}" enctype="multipart/form-data">
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
            <form action="{{ route('lesson.video_upload') }}" class='dropzone'>
            </form>
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
      // var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone(".dropzone",{
          maxFilesize: 20,  // 3 mb
          acceptedFiles: ".mp4, .mkv",
      });
      myDropzone.on("sending", function(file, xhr, formData) {
         formData.append("_token", {{ csrf_token() }});
      });
  </script>
  @endpush
