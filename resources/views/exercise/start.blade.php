@extends('layouts.layoutVerticalMenu')
@push('styles')

<style>
  @import url('https://fonts.googleapis.com/css?family=Roboto');

  body {
    font-family: 'Roboto', sans-serif;
  }

  * {
    margin: 0;
    padding: 0;
  }



  /*------------------------*/


  .wizard .nav-tabs {
    position: relative;
    margin-bottom: 0;
    border-bottom-color: transparent;
  }

  .wizard>div.wizard-inner {
    position: relative;
    margin-bottom: 50px;
    text-align: center;
  }

  .wizard .nav-tabs>li.active>a,
  .wizard .nav-tabs>li.active>a:hover,
  .wizard .nav-tabs>li.active>a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;

  }

  span.round-tab {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: inline-block;
    background: #fff;
    z-index: 2;
    text-align: center;
    font-size: 15px;
    color: #0e214b;
    font-weight: 200px;
    border: 1px solid #ddd;
  }

  span.round-tab i {
    color: #555555;
  }

  .wizard-inner li.active span.round-tab {
    background: #7367F0;
    color: #fff;
    border-color: black;

  }

  .wizard li.active span.round-tab i {
    color: #5bc0de;

  }

  .wizard .nav-tabs>li.active>a i {
    color: #0db02b;

  }

  .wizard .nav-tabs>li {
    width: 25%;
  }

  .wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: red;
    transition: 0.1s ease-in-out;

  }



  .wizard .nav-tabs>li a {
    width: 30px;
    height: 30px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
    background-color: transparent;
    position: relative;
    top: 0;

  }


  .wizard .tab-pane {
    position: relative;
    padding-top: 20px;
  }


  .wizard h3 {
    margin-top: 0;
  }

  .prev-step,
  .next-step {
    font-size: 13px;
    padding: 8px 24px;
    border: none;
    border-radius: 4px;
    margin-top: 30px;
    color: white;
  }

  .next-step {
    background-color: #7367F0;
  }

  .prev-step {
    background-color: #C4C4C4;
    color: black;
  }

  .skip-btn {
    background-color: #cec12d;
  }


  .list-inline li {
    display: inline-block;
  }

  .pull-right {
    float: right;
  }

  .question-wrapper p {
    display: inline
  }
</style>
@endpush

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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan daftar ujian yang tersedia dalam sistem" />
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
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="wizard-inner">
              <div class="connecting-line"></div>
              <ul class="nav nav-tabs" role="tablist">
                @for ($i=0; $i < $questions->count(); $i++)
                  <li role="presentation" class="col-md-2 @if ($i == 0) active @endif">
                    <a href="#step-{{ $i }}" role="tab" data-toggle="tab"><span class="round-tab">{{ $i+1 }}</span></a>
                  </li>
                @endfor
            </div>
            <br>
            <div class="card-footer" style="color: #F1AF33;">Time remaining 02:19 </div>
          </div>
        </div>
      </div>


      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="wizard">
                    <div class="tab-content" id="main_form">

                      @foreach ($answers as $answer)
                        <!-- tab -->
                        <div class="tab-pane @if ($loop->first) active @endif" role="tabpanel" id="step-{{$loop->index}}">

                          <div class="question-wrapper mb-1">
                            <span class="round-tab bg-primary text-white">{{ $loop->iteration }}</span>
                            {!! $answer->question->question !!}
                          </div>

                          <form id="save_answer_form_{{ $answer->id }}">
                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                            <?php
                            $arr = explode(',', $answer->question->answers);
                            for($i=0; $i<=4; $i++)
                            {
                              ?>
                              <div class="form-check">
                                @if ($answer->answer == $i+1)
                                  <input class="form-check-input" type="radio" name="answer" id="choice-{{ $loop->iteration }}-{{ $i }}" value="{{ $i+1 }}" checked>
                                @else
                                  <input class="form-check-input" type="radio" name="answer" id="choice-{{ $loop->iteration }}-{{ $i }}" value="{{ $i+1 }}">
                                @endif
                                <label class="form-check-label" for="#choice-{{ $loop->iteration }}-{{ $i }}">
                                  {{$arr[$i]}}
                                </label>
                              </div>
                              <?php
                            }
                            ?>
                          </form>

                          <ul class="list-inline pull-right">
                            <li>
                              @if ($loop->last)
                                <button type="button" class="default-btn next-step mt-0" data-id="{{ $answer->id }}" id="submitExamBtn">Submit All</button>
                              @else
                                <button type="button" class="default-btn next-step mt-0" data-id="{{ $answer->id }}">Next</button>
                              @endif
                            </li>
                          </ul>
                        </div>
                      @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endrole


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


      // ------------step-wizard-------------
      $(document).ready(function() {
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

          var target = $(e.target);

          if (target.parent().hasClass('disabled')) {
            return false;
          }
        });

        $(".next-step").click(function(e) {

          var active = $('.wizard-inner .nav-tabs li.active');
          active.next().removeClass('disabled');
          nextTab(active);

        });

        $(".prev-step").click(function(e) {

          var active = $('.wizard-inner .nav-tabs li.active');
          prevTab(active);

        });
      });

      function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
      }

      function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
      }

      $('.nav-tabs').on('click', 'li', function() {
        $('.nav-tabs li.active').removeClass('active');
        $(this).addClass('active');
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      //submit each answer
      $(".next-step").click(function() {
        answer_id = $(this).data("id");
        var data = $('#save_answer_form_'+answer_id).serialize();
        console.log(data);

        $.ajax({
          data: data,
          url: "{{ route('exercise.save_answer') }}",
          type: "POST",
          dataType: 'json',
          success: function(data) {
            console.log(data);
          },
          error: function(reject) {
            console.log('something wrong');
          }
        });
      });

      $('#submitExamBtn').click(function() {
        window.location.href = "{{route('exercise.submit_all', $exam->id)}}";
      });
    </script>
    @endpush
