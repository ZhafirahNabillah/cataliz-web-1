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
                <?php
                for ($i=1;$i<=$total_questions;$i++) {
                ?>
                <li role="presentation" class="col-md-2">
                  <a href="#step{{$i}}" data-toggle="tab" aria-controls="step{{$i}}" role="tab"
                    aria-expanded="true"><span class="round-tab">{{$i}}</span></a>
                </li>
                <?php
                }
                ?>

                {{-- <li role="presentation" class="disabled col-md-2">
                  <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">02</span></a>
                </li>
                <li role="presentation" class="disabled col-md-2">
                  <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">03</span> </a>
                </li>
                <li role="presentation" class="disabled col-md-2">
                  <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">04</span> </a>
                </li>
                <li role="presentation" class="disabled col-md-2">
                  <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">05</span> </a>
                </li> --}}
              </ul>
            </div>

            <br>
            <div class="card-footer" style="color: #F1AF33;">Time remaining 02:19 </div>
          </div>
        </div>
      </div>


      <div class="col-md-8">
        <div class="card">
          <div class="card-body">

            <div class="container">
              <div class="row d-flex ">
                <div class="col-auto">
                  <div class="wizard">
                    <form role="form" action="index.html" class="login-box">
                      <div class="tab-content" id="main_form">

                        {{-- Question 1 --}}
                        <div class="tab-pane active" role="tabpanel" id="step">
                          <h4><b>Click The Question Number To Start</b></h4>
                        </div>

                        @foreach ($questions as $question)
                        <!-- tab -->
                        <div class="tab-pane" role="tabpanel" id="step{{$loop->iteration}}">

                          <p class="text-justify">{{$loop->iteration . '. ' . strip_tags($question->question)}}</p>
                          {{-- @foreach ($question as $answer) --}}
                          <?php
                          $arr = explode(',', $question->answers);
                          for($i=0; $i<=4; $i++)
                          {
                            ?>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              {{$arr[$i]}}
                            </label>
                          </div>
                          <?php
                          }
                          ?>
                          {{-- @endforeach --}}
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 3
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 5
                            </label>
                          </div> --}}
                          <ul class="list-inline pull-right">
                            <li><button type="button" class="default-btn next-step">Next</button></li>
                          </ul>

                        </div>
                        @endforeach

                        {{-- <!-- tab2 -->
                        <div class="tab-pane" role="tabpanel" id="step2">

                          <p class="text-justify">Ut ornare arcu sit amet lectus dignissim, et convallis tellus viverra.
                            In eget cursus diam, posuere hendrerit ex. Mauris sit amet sem lacinia, mattis quam et,
                            blandit orci. Duis in scelerisque odio. Cras convallis, leo sit amet tincidunt dignissim,
                            lorem nibh posuere metus, sit amet convallis diam diam eget magna. Nam auctor sodales nisi,
                            quis euismod nisl aliquam sit amet. Proin sed ipsum convallis mi ultrices lacinia. Integer
                            at arcu id risus imperdiet sagittis id ut erat.</p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 3
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 5
                            </label>
                          </div>


                          <ul class="list-inline pull-right">
                            <li><button type="button" class="default-btn prev-step">Previous</button></li>
                            <li><button type="button" class="default-btn next-step">Next</button></li>
                          </ul>
                        </div>

                        <!-- tab3 -->
                        <div class="tab-pane" role="tabpanel" id="step3">
                          <p class="text-justify">Nam auctor sodales nisi, quis euismod nisl aliquam sit amet. Proin sed
                            ipsum convallis mi ultrices lacinia. Integer at arcu id risus imperdiet sagittis id ut erat.
                          </p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 3
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 5
                            </label>
                          </div>
                          <ul class="list-inline pull-right">
                            <li><button type="button" class="default-btn prev-step">Previous</button></li>
                            <li><button type="button" class="default-btn next-step">Next</button></li>
                          </ul>
                        </div>

                        <!-- tab4 -->
                        <div class="tab-pane" role="tabpanel" id="step4">
                          <p class="text-justify">Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel
                            pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Phasellus enim
                            ante, accumsan ut eros non, viverra egestas lectus. </p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 3
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 5
                            </label>
                          </div>


                          <ul class="list-inline pull-right">
                            <li><button type="button" class="default-btn prev-step">Previous</button></li>
                            <li><button type="button" class="default-btn next-step">Next</button></li>
                          </ul>
                        </div>

                        <!-- tab5 -->
                        <div class="tab-pane" role="tabpanel" id="step5">

                          <p class="text-justify">Proin vitae vestibulum sapien. Curabitur tempus maximus sapien, sit
                            amet cursus diam volutpat viverra. Ut ornare arcu sit amet lectus dignissim, et convallis
                            tellus viverra. In eget cursus diam, posuere hendrerit ex. Mauris sit amet sem lacinia,
                            mattis quam et, blandit orci. Duis in scelerisque odio. Cras convallis, leo sit amet
                            tincidunt dignissim, lorem nibh posuere metus, sit amet convallis diam diam eget magna. Nam
                            auctor sodales nisi, quis euismod nisl aliquam sit amet. Proin sed ipsum convallis mi
                            ultrices lacinia. Integer at arcu id risus imperdiet sagittis id ut erat.</p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 3
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="#" id="#">
                            <label class="form-check-label" for="#">
                              Answer 5
                            </label>
                          </div>

                          <ul class="list-inline pull-right">
                            <li><button type="button" class="default-btn prev-step">Previous</button></li>
                            <li><button type="button" class="default-btn next-step">Finish and Submit</button></li>
                          </ul>
                        </div>

                        <div class="clearfix"></div>
                      </div> --}}

                    </form>
                  </div>
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
    </script>



    @endpush