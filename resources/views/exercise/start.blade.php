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

  .wizard-inner li.disabled span.round-tab {
    background: grey;
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

  span .disabled {
    background-color: grey;
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
                @foreach ($answers as $answer)
                  <li role="presentation" data-index={{ $loop->index }} class="col-md-2 @if ($answer->answer != null) disabled @elseif ($answer->answer == null && $answer->id == $active_question->id) active @endif">
                    <a href="#step-{{ $loop->index }}" role="tab" data-toggle="tab"><span class="round-tab">{{ $loop->iteration }}</span></a>
                  </li>
                @endforeach
            </div>
            <br>
            <div class="card-footer" style="color: #F1AF33;">Time remaining <span id="time_remaining"></span></div>
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
                        <div class="tab-pane @if ($answer->answer == null && $answer->id == $active_question->id) active @endif" role="tabpanel" id="step-{{$loop->index}}">

                          <div class="question-wrapper mb-1">
                            <span class="round-tab bg-primary text-white">{{ $loop->iteration }}</span>
                            {!! $answer->question->question !!}
                          </div>

                          <form class="answer_form" id="save_answer_form_{{ $answer->id }}">
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
                            <ul class="list-inline pull-right btn_wrapper">
                              <li>
                                @if ($loop->last)
                                  <button type="button" class="default-btn next-step mt-0" data-id="{{ $answer->id }}" id="submitExamBtn">Submit All</button>
                                @else
                                  <button type="button" class="default-btn next-step mt-0" data-id="{{ $answer->id }}">Next</button>
                                @endif
                              </li>
                            </ul>
                          </form>
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

      var countDownDate = new Date("{{ $exam->attempt_submit }}").getTime();

      // Update the count down every 1 second
      var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("time_remaining").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("time_remaining").innerHTML = "EXPIRED";
          $('#submitExamBtn').trigger('click');
        }
      }, 1000);

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

      $('.btn_wrapper').hide();
      // $('input:radio[name="answer"]').change(function(){
      //     if ($(this).is(':checked')) {
      //         $('.btn_wrapper').show();
      //     }
      // });


      @foreach ($answers as $answer)
      if ($('#save_answer_form_'+{{ $answer->id }}+' input:radio[name="answer"]').is(':checked')) {
        $('#save_answer_form_'+{{ $answer->id }}+' .btn_wrapper').show();
      }

      $('#save_answer_form_'+{{ $answer->id }}+' input:radio[name="answer"]').change(function(){
        console.log('tes')
        if ($(this).is(':checked')) {
          $('#save_answer_form_'+{{ $answer->id }}+' .btn_wrapper').show();
        }
      });
      @endforeach

      // ------------step-wizard-------------
      $(document).ready(function() {
        $('.wizard-inner .nav-tabs li').click(false);

        $('.nav-tabs > li a[title]').tooltip();

        $(".next-step").click(function(e) {
          var active = $('.wizard-inner .nav-tabs li.active');
          active.removeClass('active');
          active.addClass('disabled');

          if($(this).is($(".next-step:last"))){
            // console.log('last');
            window.location.href = "{{route('exercise.submit_all', $exam->id)}}";
          } else {
            // console.log('not-last');
            active.next().addClass('active');
            active_tab_index = active.data('index');
            next_tab_index = active.next().data('index');
            $("#step-"+active_tab_index).removeClass("active");
            $("#step-"+next_tab_index).addClass("active");
          }
          // console.log(active.next());
          // nextTab(active);
        });
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
    </script>
    @endpush
