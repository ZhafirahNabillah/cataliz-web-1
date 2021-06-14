@extends('layouts.layoutVerticalMenu')

@section('title','Report')

@push('styles')

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
                <li class="breadcrumb-item active">Detail Report
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
              <h4 class="card-title"><b>Detail Report</b>
              </h4>
            </div>

            <div class="card-body">
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Coachee Name</b>
                </div>
                <div class="col-sm-2">
                  {{$client_name}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Program</b>
                </div>
                <div class="col-sm-2">
                  {{$report->program}}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Awarness</b>
                </div>
                <div class="col-sm-2">
                  {{$report->awarness}}/5
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Mindset</b>
                </div>
                <div class="col-sm-2">
                  {{$report->mindset}}/5
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Behaviour</b>
                </div>
                <div class="col-sm-2">
                  {{$report->behaviour}}/5
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Engagement</b>
                </div>
                <div class="col-sm-2">
                  {{$report->engagement}}/5
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Result</b>
                </div>
                <div class="col-sm-2">
                  {{$report->result}}/5
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-2">
                  <b>Note</b>
                </div>
                <div class="col-sm-2">
                  {!!$report->note!!}
                </div>
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
<script type="text/javascript">
  // popover
 $(function() {
      $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'hover',
        placement: 'top',
        content: function() {
          return '<img src="' + $(this).data('img') + '" />';
        }
      });
  });
</script>
@endpush