@extends('layouts.layoutVerticalMenu')

@section('title','Exam')

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
            <h2 class="content-header-title float-left mb-0">Exam
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar ujian yang tersedia dalam sistem" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Exam</a>
                </li>
                <li class="breadcrumb-item active">Edit Question
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-lg-12">
        <div class="card ">
          <div class="card-body">
            <form action="{{ route('question.update', $question->id) }}" method="POST">
              @csrf
              @method('PUT')
              {{-- <div class="form-group"><label for="">Topic</label><input type="text" class="form-control col-sm-12" id="" aria-describedby="emailHelp" placeholder="Choose your topic" disabled></div> --}}
              <div class="form-group"><label for="question">Question</label><textarea name="question" id="question" placeholder="Your question here...">{{$question->question}}</textarea></div>
              @foreach ($ans_array as $dt)
              <div class="form-group"><label for="">Answer {{$choice_itr++}}</label><input type="text" name="answer-1[]" class="form-control col-sm-6" id="{{strtolower($choice_itr++)}}-answer-1" value="{!!$dt!!}"></div>
              @endforeach
              <div class="form-group">
                <label for="true_answer">Select True Answer</label>
                <select class="form-control col-sm-6" aria-label=" select example" name="true_answer">
                  {{-- <option selected disabled>Select True Answer</option> --}}
                  <option value="A" @if($question->true_answer == 'A') selected @endif>A</option>
                  <option value="B" @if($question->true_answer == 'B') selected @endif>B</option>
                  <option value="C" @if($question->true_answer == 'C') selected @endif>C</option>
                  <option value="D" @if($question->true_answer == 'D') selected @endif>D</option>
                  <option value="E" @if($question->true_answer == 'E') selected @endif>E</option>
                </select>
              </div>
              <div class="form-group">
                <div class="form-group"><label for="point">Point</label><input type="text" class="form-control col-sm-6" id="" name="point" value="{{$question->weight}}"></div>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


  <script type="text/javascript">
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });

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
    });


    tinymce.init({
      selector: 'textarea',

      image_class_list: [{
        title: 'img-fluid',
        value: 'img-fluid'
      }, ],
      height: 700,
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