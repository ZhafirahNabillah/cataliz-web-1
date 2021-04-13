@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

@push('styles')

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
                <li class="breadcrumb-item"><a href="#">Topic</a>
                </li>
                <li class="breadcrumb-item active">Create Topic
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
            <form action="{{ route('topic.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="topic">Topic Name</label>
                <input class="form-control" type="text" name="topic" value="" placeholder="Your Topic Here...">
              </div>
              <div class="form-group">
                <label for="client_requirement">Requirements</label>
                <textarea name="client_requirement" id="client_requirement" cols="20" rows="20"
                  placeholder="Your Requirement Here....."></textarea>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="20" rows="20"
                  placeholder="Your Description Here....."></textarea>
              </div>
              <div class="form-group">
                <label for="client_target">Who Is This Topic For?</label>
                <textarea name="client_target" id="client_target" cols="20" rows="20"
                  placeholder="Your List Here....."></textarea>
              </div>
              <div class="form-group text-right mb-0">
                <Button type="submit" class="btn btn-primary">Submit</Button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END: Content-->
  @endsection

  @push('scripts')
  <script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
      height: 300,
      setup: function(editor) {
        editor.on('init change', function() {
          editor.save();
        });
      }
    });
  </script>
  @endpush