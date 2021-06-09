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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan report yang anda miliki" />
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
              <div class="row mb-2 ">
                <div class="col-sm-2">
                  <b>Coachee Name</b>
                </div>
                <div class="col-sm-2">
                  #
                </div>
              </div>
              <div class="row mb-2 ">
                <div class="col-sm-2">
                  <b>Program</b>
                </div>
                <div class="col-sm-2">
                  #
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <!-- awarness -->
                  <div class="col-sm-2">
                    <b>Awarness</b>
                  </div>
                  <div class="col-sm-2">
                    <div class="border p-1" id="awarness"></div>
                  </div>

                  <!-- mindset -->
                  <div class="col-sm-2">
                    <b>Mindset</b>
                  </div>
                  <div class="col-sm-2">
                    <div class="border p-1" id="mindset"></div>
                  </div>

                  <!-- behaviour -->

                  <div class="col-sm-2">
                    <b>Behaviour</b>
                  </div>
                  <div class="col-sm-2">
                    <div class="border p-1" id="behaviour"></div>
                  </div>

                  <!-- engagement -->

                  <div class="col-sm-2">
                    <b>Engagement</b>
                  </div>
                  <div class="col-sm-2">
                    <div class="border p-1" id="engagement"></div>
                  </div>

                  <!-- result -->
                  <div class="col-sm-2">
                    <b>Result</b>
                  </div>
                  <div class="col-sm-2">
                    <div class="border p-1" id="result"></div>
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
  <script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
        numStars: 10,
        spacing: "30px"
      });

      $("#mindset").rateYo({
        ratedFill: "#F1AF33",
        numStars: 10,
        spacing: "30px"
      });

      $("#behaviour").rateYo({
        ratedFill: "#F1AF33",
        numStars: 10,
        spacing: "30px"
      });

      $("#engagement").rateYo({
        ratedFill: "#F1AF33",
        numStars: 10,
        spacing: "30px"
      });

      $("#result").rateYo({
        ratedFill: "#F1AF33",
        numStars: 10,
        spacing: "30px"
      });

      tinymce.init({
        selector: 'textarea',
      });
    });
  </script>
  @endpush