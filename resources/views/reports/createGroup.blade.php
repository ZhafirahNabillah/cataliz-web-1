@extends('layouts.layoutVerticalMenu')

@section('title','Report')

@push('styles')

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="jquery.rateyo.css" />
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
            <h2 class="content-header-title float-left mb-0">Report
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan report yang anda miliki" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('report.index')}}">Report</a>
                </li>
                <li class="breadcrumb-item active">Create Report
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
          <div class="card">
            <div class="card-header">
              <h4 class="card-title pl-1"><b>Create Report</b>
              </h4>
            </div>
            <form action="{{route('report.store_group')}}" method="post">
              @csrf
              <div class="card-body form-wrapper" id="1">
                <div class="row mb-2 pl-1">
                  <div class="col-sm-2">
                    <b>Group Code</b>
                  </div>
                  <div class="col-sm-12 form-group">
                    <select class="livesearch-group form-control @error('group_id') is-invalid @enderror"
                      name="group_id">
                    </select>
                    @error('group_id')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-2 pl-1">
                  <div class="col-sm-2">
                    <b>Program</b>
                  </div>
                  <div class="col-sm-12 form-group">
                    <select class="livesearch-program form-control @error('program') is-invalid @enderror"
                      name="program">
                    </select>
                    @error('program')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="collapse-icon">
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div id="headingCollapse1" class="card-header" id="headingOne" data-toggle="collapse"
                        role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        <span class="lead collapse-title"><b>Chochee Name 1</b> Chochee Name</span>
                      </div>
                      <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show"
                        data-parent="#accordionExample">

                        <div class="card-body ml-0">

                          <!-- awarness -->
                          <div class="col-sm-2">
                            <b>Awarness</b>
                          </div>
                          <div class="col-sm-2 mb-1">
                            <div class="border p-1" id="awarness"></div>
                            <input name="coachee_awarness" id="coachee_awarness" type="hidden" value="">
                          </div>

                          <!-- mindset -->
                          <div class="col-sm-2">
                            <b>Mindset</b>
                          </div>
                          <div class="col-sm-2 mb-1">
                            <div class="border p-1" id="mindset"></div>
                            <input name="coachee_mindset" id="coachee_mindset" type="hidden" value="">
                          </div>

                          <!-- behaviour -->

                          <div class="col-sm-2">
                            <b>Behaviour</b>
                          </div>
                          <div class="col-sm-2 mb-1">
                            <div class="border p-1" id="behaviour"></div>
                            <input name="coachee_behaviour" id="coachee_behaviour" type="hidden" value="">
                          </div>

                          <!-- engagement -->

                          <div class="col-sm-2">
                            <b>Engagement</b>
                          </div>
                          <div class="col-sm-2 mb-1">
                            <div class="border p-1" id="engagement"></div>
                            <input name="coachee_engagement" id="coachee_engagement" type="hidden" value="">
                          </div>

                          <!-- result -->
                          <div class="col-sm-2">
                            <b>Result</b>
                          </div>
                          <div class="col-sm-2 mb-1">
                            <div class="border p-1" id="result"></div>
                            <input name="coachee_result" id="coachee_result" type="hidden" value="">
                          </div>

                          <!-- note -->
                          <div class="col-sm-2">
                            <b>Note</b>
                          </div>
                          <div class="col-md-12 form-group">
                            <textarea class="form-control @error('summary') is-invalid @enderror"
                              name="summary"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button"
                        data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        <span class="lead collapse-title"><b>Chochee Name 2</b> Chochee Name</span>
                      </div>
                      <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse"
                        data-parent="#accordionExample">
                        <div class="card-body">
                          <!-- awarness -->
                          <div class="col-sm-2">
                            <b>Awarness</b>
                          </div>
                          <div class="col-sm-2">
                            <div class="border p-1" id="awarness2"></div>
                          </div>

                          <!-- mindset -->
                          <div class="col-sm-2">
                            <b>Mindset</b>
                          </div>
                          <div class="col-sm-2">
                            <div class="border p-1" id="mindset2"></div>
                          </div>

                          <!-- behaviour -->

                          <div class="col-sm-2">
                            <b>Behaviour</b>
                          </div>
                          <div class="col-sm-2">
                            <div class="border p-1" id="behaviour2"></div>
                          </div>

                          <!-- engagement -->

                          <div class="col-sm-2">
                            <b>Engagement</b>
                          </div>
                          <div class="col-sm-2">
                            <div class="border p-1" id="engagement2"></div>
                          </div>

                          <!-- result -->
                          <div class="col-sm-2">
                            <b>Result</b>
                          </div>
                          <div class="col-sm-2">
                            <div class="border p-1" id="result2"></div>
                          </div>

                          <!-- note -->
                          <div class="col-sm-2">
                            <b>Note</b>
                          </div>
                          <div class="col-md-12 form-group">
                            <textarea class="form-control @error('summary') is-invalid @enderror"
                              name="summary"></textarea>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 text-right">
                  <a href="{{route('report.index')}}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-primary data-submit" id="saveBtn">Submit</button>
                </div>
            </form>

          </div>
        </div>

      </div>

    </div>
  </div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>
<script src="jquery.js"></script>
<script src="jquery.rateyo.js"></script>
<script type="text/javascript">
  $(function() {
    // popover
    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'top',
      content: function() {
        return '<img src="' + $(this).data('img') + '" />';
      }
    });

    $("#awarness").rateYo({
      ratedFill: "#F1AF33",
      numStars: 5,
      spacing: "30px",
			fullStar: true,
    });
    $('#awarness').click(function() {
      console.log('ok');
			var awarness = $('#awarness').rateYo("rating");
			$('#coachee_awarness').val(awarness);
		});

    $("#mindset").rateYo({
      ratedFill: "#F1AF33",
      numStars: 5,
      spacing: "30px",
      fullStar: true,
    });
    $('#mindset').click(function() {
			var mindset = $('#mindset').rateYo("rating");
			$('#coachee_mindset').val(mindset);
		});

    $("#behaviour").rateYo({
      ratedFill: "#F1AF33",
      numStars: 5,
      spacing: "30px",
      fullStar: true,
    });
    $('#behaviour').click(function() {
			var behaviour = $('#behaviour').rateYo("rating");
			$('#coachee_behaviour').val(behaviour);
		});

    $("#engagement").rateYo({
      ratedFill: "#F1AF33",
      numStars: 5,
      spacing: "30px",
      fullStar: true,
    });
    $('#engagement').click(function() {
			var engagement = $('#engagement').rateYo("rating");
			$('#coachee_engagement').val(engagement);
		});

    $("#result").rateYo({
      ratedFill: "#F1AF33",
      numStars: 5,
      spacing: "30px",
      fullStar: true,
    });
    $('#result').click(function() {
			var result = $('#result').rateYo("rating");
			$('#coachee_result').val(result);
		});

    $('.livesearch-group').select2({
      placeholder: 'Select Group Code',
      ajax: {
        url: "{{route('report.search_group')}}",
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            q: $.trim(params.term)
          };
        },
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              // console.log(item)
              return {
                text: item.group_id,
                id: item.group_id,
                // ct_id: item.client_id,
              }
            })
          };
        },
        cache: true
      }
    });

    $('.livesearch-program').select2({
      placeholder: 'Select program',
      tags: true
    });

    tinymce.init({
      selector: 'textarea',
    });

   
    $('body').on('change', '.livesearch-group', function() {
      var group_id = $(this).val();
      //get en id group e iso teko select seng dipilih

      $.get("" + '/group/' + group_id, function(data) {
        //gae route anyar seng isine get data user seng group_id ne iku
        //variable data iku isine return response e
        //kari di for sesuai banyaknya return data user e
        //opo nek gaperlu data user e return en count e tok ae
        for (var i; i<data; i++){
          function append_form() {
            var last_form_index = $('.form-wrapper:last').attr('id');
            var this_form_id = parseInt(last_form_index) + 1;
            $('.form-wrapper:last').after('<div class="form-wrapper" id="' + this_form_id + '"></div>');
            // console.log(this_question_id);
            var hr = '<hr>';
            var form_title = '<div class="title"><button type="button" data-id="' + this_form_id + '" class="btn btn-danger float-right deleteQuestionBtn">Delete Question</button><h4>Question ' + this_question_id + '</h4></div>';
            var form_box = '<div class="form-group"><label for="question">Question</label><textarea name="question-' + this_form_id + '" id="question-' + this_question_id + '" placeholder="Your question here..."></textarea></div>';
            var awarness_form = '<div class="form-group"><label for="">Answer A</label><input type="text" class="form-control col-sm-6" name="answer-' + this_question_id + '[]" id="a-answer-' + this_question_id + '" placeholder="Input your Answer..."></div>';
            var mindset_form = '<div class="form-group"><label for="">Answer B</label><input type="text" class="form-control col-sm-6" name="answer-' + this_question_id + '[]" id="b-answer-' + this_question_id + '" placeholder="Input your Answer..."></div>';
            var behaviour_form = '<div class="form-group"><label for="">Answer C</label><input type="text" class="form-control col-sm-6" name="answer-' + this_question_id + '[]" id="c-answer-' + this_question_id + '" placeholder="Input your Answer..."></div>';
            var engagement_form = '<div class="form-group"><label for="">Answer D</label><input type="text" class="form-control col-sm-6" name="answer-' + this_question_id + '[]" id="d-answer-' + this_question_id + '" placeholder="Input your Answer..."></div>';
            var result_form = '<div class="form-group"><label for="">Answer E</label><input type="text" class="form-control col-sm-6" name="answer-' + this_question_id + '[]" id="e-answer-' + this_question_id + '" placeholder="Input your Answer..."></div>';
            var form_id = '<input type="hidden" name="all_forms_id[]" value="' + this_form_id + '">';

            $(".question-wrapper:last").append(hr, question_title, question_box, option_A, option_B, option_C, option_D, option_E, true_answer, point, question_id);

            // question_length = question_length + 1;
            // $('#question_length').val(question_length);
          }
        }
      })
    });
    
  });
</script>
@endpush