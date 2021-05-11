@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
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
                <li class="breadcrumb-item active">Edit Topic
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
                <label for="title">Topic Name</label>
                <input class="form-control" type="text" name="topic" value="{{ $topic->topic }}" placeholder="Your Topic Here...">
                <input type="hidden" name="id" value="{{ $topic->id }}">
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select class="livesearch-categories form-control" name="category">
                  <option selected hidden value="{{ $topic->category_id }}">{{ $category }}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Requirements</label>
                <textarea name="client_requirement" id="client_requirement" cols="20" rows="20"
                  placeholder="Your Requirement Here.....">{{ $topic->client_requirement }}</textarea>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="20" rows="20"
                  placeholder="Your Description Here.....">{{ $topic->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="description">Who Is This Topic For?</label>
                <textarea name="client_target" id="client_target" cols="20" rows="20"
                  placeholder="Your List Here.....">{{ $topic->client_target }}</textarea>
              </div>
              <div class="form-group text-left mb-0">
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
  <script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
        <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script type="text/javascript">

  $('.livesearch-categories').select2({
    placeholder: 'Select Category',
    ajax: {
      url: "{{route('category.search')}}",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            console.log(item)
            return {
              text: item.category,
              id: item.id,
            }
          })
        };
      },
      cache: true
    }
  });

  $('.livesearch-sub-categories').select2({
    placeholder: 'Select Sub-Category',
    ajax: {
      url: "{{route('topic.search')}}",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            console.log(item)
            return {
              text: item.topic,
              id: item.id,
            }
          })
        };
      },
      cache: true
    }
  });

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
