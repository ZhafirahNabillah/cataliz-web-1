@extends('layouts.layoutVerticalMenu')

@section('title','Exercise')

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
            <h2 class="content-header-title float-left mb-0">Exercise
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan Exercise yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Exercise</a>
                </li>
                <li class="breadcrumb-item active">Create Exercise
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form action="{{ route('question.store') }}" method="post">
          @csrf
          <div class="card mb-1">
            <div class="card-body">
                <input type="hidden" name="number_of_question" id="number_of_question">
                <div class="question-wrapper" data-id="1">
                  <div class="title">
                    {{-- <button type="button" data-id="1" name="button" class="btn btn-danger float-right deleteQuestionBtn">Delete Question</button> --}}
                    <h4>Question 1</h4>
                  </div>
                  <div class="form-group">
                    <label for="question">Question</label>
                    <textarea name="question-1" id="question-1" placeholder="Your question here..."></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Answer A</label>
                    <input type="text" name="answer-1[]" class="form-control col-sm-6" id="a-answer-1" placeholder="Input your Answer...">
                  </div>
                  <div class="form-group">
                    <label for="">Answer B</label>
                    <input type="text" name="answer-1[]" class="form-control col-sm-6" id="b-answer-1" placeholder="Input your Answer...">
                  </div>
                  <div class="form-group">
                    <label for="">Answer C</label>
                    <input type="text" name="answer-1[]" class="form-control col-sm-6" id="c-answer-1" placeholder="Input your Answer...">
                  </div>
                  <div class="form-group">
                    <label for="">Answer D</label>
                    <input type="text" name="answer-1[]" class="form-control col-sm-6" id="d-answer-1" placeholder="Input your Answer...">
                  </div>
                  <div class="form-group">
                    <label for="">Answer E</label>
                    <input type="text" name="answer-1[]" class="form-control col-sm-6" id="e-answer-1" placeholder="Input your Answer...">
                  </div>
                  <div class="form-group">
                    <label for="true_answer">True Answer</label>
                    <select class="form-control" id="true_answer" name="true-answer-1">
                      <option selected disabled>Select True Answer</option>
                      <option value="1">A</option>
                      <option value="2">B</option>
                      <option value="3">C</option>
                      <option value="4">D</option>
                      <option value="5">E</option>
                    </select>
                  </div>
                </div>
                <button type="button" name="button" class="btn btn-secondary" id="addQuestionBtn">+ Add Question</button>
            </div>
            {{-- <div class="card-body">
              <h4 class="card-title">Input jumlah Soal</h4>
              <p class="card-text"></p>
              <form>
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <input type="number" name="" class="input form-control" id="form_numbers" placeholder="Enter number of forms" required>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="text-center">
                      <button class="btn btn-sm btn-primary generate" type="submit">Generate</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <form>
                <div class="forms">
                </div>
                <div class="text-left">
                  <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div> --}}
        </div>
        <button type="submit" name="button" class="btn btn-primary mb-2">Submit</button>
      </form>
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

      tinymce.init({
        selector: 'textarea',
      });

      $('#addQuestionBtn').click(append_form);
      $('body').on('click', '.deleteQuestionBtn', function() {
        var question_number = $(this).data("id");
        console.log(question_number);
        tinymce.get('question-'+question_number).remove();
        $('.question-wrapper#'+question_number).remove();
        if (question_number == number_of_question) {
          number_of_question = number_of_question - 1;
        }
      });
    });

    var number_of_question = 1;

    function append_form(){
      $('.question-wrapper:last').after('<div class="question-wrapper" id="'+(number_of_question+1)+'"></div>');
      console.log(number_of_question);
      number_of_question++;
      $('#number_of_question').val(number_of_question);
      var hr = '<hr>'
      var question_number = '<div class="title"><button type="button" data-id="'+number_of_question+'" class="btn btn-danger float-right deleteQuestionBtn">Delete Question</button><h4>Question '+number_of_question+'</h4></div>';
      var question_box = '<div class="form-group"><label for="question">Question</label><textarea name="question-'+number_of_question+'" id="question-'+number_of_question+'" placeholder="Your question here..."></textarea></div>';
      var option_A = '<div class="form-group"><label for="">Answer A</label><input type="text" class="form-control col-sm-6" name="answer-'+number_of_question+'[]" id="a-answer-'+number_of_question+'" placeholder="Input your Answer..."></div>';
      var option_B = '<div class="form-group"><label for="">Answer B</label><input type="text" class="form-control col-sm-6" name="answer-'+number_of_question+'[]" id="b-answer-'+number_of_question+'" placeholder="Input your Answer..."></div>';
      var option_C = '<div class="form-group"><label for="">Answer C</label><input type="text" class="form-control col-sm-6" name="answer-'+number_of_question+'[]" id="c-answer-'+number_of_question+'" placeholder="Input your Answer..."></div>';
      var option_D = '<div class="form-group"><label for="">Answer D</label><input type="text" class="form-control col-sm-6" name="answer-'+number_of_question+'[]" id="d-answer-'+number_of_question+'" placeholder="Input your Answer..."></div>';
      var option_E = '<div class="form-group"><label for="">Answer E</label><input type="text" class="form-control col-sm-6" name="answer-'+number_of_question+'[]" id="e-answer-'+number_of_question+'" placeholder="Input your Answer..."></div>';
      var true_answer = '<div class="form-group"><label for="true_answer">True Answer</label><select class="form-control" id="true_answer" name="true-answer-'+number_of_question+'"><option selected disabled>Select True Answer</option><option value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option><option value="5">E</option></select></div>';

      $(".question-wrapper:last").append(hr, question_number, question_box, option_A, option_B, option_C, option_D, option_E, true_answer);

      tinymce.init({
        selector: 'textarea'
      });
    }

    function delete_form(question_id){

    }

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
  </script>

  @endpush
