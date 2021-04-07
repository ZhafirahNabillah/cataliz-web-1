@extends('layouts.layoutVerticalMenu')

@section('title','Documentations')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <h2 class="content-header-title float-left mb-0">Create Documentation</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('docs.index')}}">Docs</a>
                </li>
                <li class="breadcrumb-item active">Create Documentation
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
            <form action="{{ route('docs.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" value="" placeholder="Your documentation title here...">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="fp-default">Category</label>
                    <select class="category-select form-control @error('category') is-invalid @enderror" name="category">
                      @foreach ($documentations as $documentation)
                        <option>{{ $documentation->first()->category }}</option>
                      @endforeach
                    </select>
                    @error('category')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="role">Role</label>
                    <select class="form-control" name="role">
                      <option hidden disabled selected>Select role</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="description">Documentation Content</label>
                <textarea name="description" id="description" cols="20" rows="20"
                  placeholder="Your documentation content here..."></textarea>
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
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>
<script type="text/javascript">
  $('.category-select').select2({
    placeholder: 'Select plans',
    tags: true
  });

  tinymce.init({
    selector: 'textarea',

    image_class_list: [
      {title: 'img-responsive', value: 'img-responsive'},
    ],
    height: 700,
    setup: function (editor) {
      editor.on('init change', function () {
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
        reader.onload = function () {
          var id = 'blobid' + (new Date()).getTime();
          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
          cb(blobInfo.blobUri(), { title: file.name });
        };
      };
      input.click();
    }
  });
</script>
@endpush
