@extends('layouts.layoutVerticalMenu')

@section('title','Exam')

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
            <h2 class="content-header-title float-left mb-0">Exam
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar ujian yang tersedia dalam sistem" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('exercise.index')}}">Exam</a>
                </li>
                <li class="breadcrumb-item active">Start Exam
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    @role('coachee')
    <div class="row ">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="text-center card-title ">
              <h3 class="mt-1"><b>{{ $topic->topic }}</b></h3>
              <p><span>Created by {{ $topic->trainer->name }} </span></p>
              <p><span>Total questions: {{ $questions->count() }} </span></p>
            </div>

            <!-- Panel Exam -->
            <div class="collapse-icon">
              <div class="collapse-default">
                @foreach ($questions as $question)
                <div class="card">
                  <div class="card-header" data-toggle="collapse" role="button" data-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse1">
                    <span class="lead collapse-title"><b>{{ 'Question '.$loop->iteration }}</b> | Score: {{ $question->weight }}</span>
                  </div>
                  <div id="collapse{{ $loop->iteration }}" role="tabpanel" class="collapse">
                    <div class="card-body">
                      <div class="question_wrapper">
                        {!! $question->question !!}
                      </div>
                      <div class="answer_choice_wrapper">
                        @foreach (explode(',', $question->answers) as $answer_choice)
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer_{{ $question->id }}" id="{{ $question->id.'-'.$loop->iteration }}">
                            <label class="form-check-label" for="{{ $question->id.'-'.$loop->iteration }}">
                              {{ $answer_choice }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>

            <!-- tbl submit -->
            <div class="text-left">
              <button class="btn btn-primary" type="submit">Submit All</button>
            </div>
            <!-- /tbl submit -->

          </div>
        </div>
      </div>
    </div>
    @endrole



  </div>




  <!-- END: Content-->
  @endsection

  @push('scripts')
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
  </script>

  @endpush
