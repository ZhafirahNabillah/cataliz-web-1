@extends('layouts.layoutVerticalMenu')

@section('title','Report')

@push('styles')

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
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

            <div class="card-body">
              <div class="row mb-2 ml-3">
                <div class="col-sm-2">
                  <b>Coachee Name</b>
                </div>
                <div class="col-sm-2 form-group">
                  <select class="livesearch-coachee form-control @error('coachee_id') is-invalid @enderror"
                    name="coachee_id">
                  </select>
                  @error('coachee_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-1 ml-3">
                <div class="col-sm-2">
                  <b>Program</b>
                </div>
                <div class="col-sm-2 form-group">
                  <select class="livesearch-program form-control @error('program_id') is-invalid @enderror"
                    name="program_id">
                  </select>
                  @error('program_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="card">
                <div class="card-body ml-0">
                  <form action="#" method="post">
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
                      <textarea class="form-control @error('summary') is-invalid @enderror" name="summary"></textarea>
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
  <script src="//cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
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

			var awarness = $('#awarness').data("awarness");
      $("#awarness").rateYo({
        ratedFill: "#F1AF33",
        numStars: 5,
        spacing: "30px",
				fullStar: true,
      });
      $('#awarness').click(function() {
				var awarness = $('#awarness').rateYo("awarness");
				$('#coachee_awarness').val(awarness);
			});

			var mindset = $('#mindset').data("mindset");
      $("#mindset").rateYo({
        ratedFill: "#F1AF33",
        numStars: 5,
        spacing: "30px",
        fullStar: true,
      });
      $('#mindset').click(function() {
				var mindset = $('#mindset').rateYo("mindset");
				$('#coachee_mindset').val(mindset);
			});

			var behaviour = $('#behaviour').data("behaviour");
      $("#behaviour").rateYo({
        ratedFill: "#F1AF33",
        numStars: 5,
        spacing: "30px",
        fullStar: true,
      });
      $('#behaviour').click(function() {
				var behaviour = $('#behaviour').rateYo("behaviour");
				$('#coachee_behaviour').val(behaviour);
			});

			var engagement = $('#engagement').data("engagement");
      $("#engagement").rateYo({
        ratedFill: "#F1AF33",
        numStars: 5,
        spacing: "30px",
        fullStar: true,
      });
      $('#engagement').click(function() {
				var engagement = $('#engagement').rateYo("engagement");
				$('#coachee_engagement').val(engagement);
			});

			var result = $('#result').data("result");
      $("#result").rateYo({
        ratedFill: "#F1AF33",
        numStars: 5,
        spacing: "30px",
        fullStar: true,
      });
      $('#result').click(function() {
				var result = $('#result').rateYo("result");
				$('#coachee_result').val(result);
			});

      tinymce.init({
        selector: 'textarea',
      });
    });
  </script>
  @endpush
