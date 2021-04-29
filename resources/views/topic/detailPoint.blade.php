@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <h2 class="content-header-title float-left mb-0">Topics
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('topic.index')}}">Topic</a>
                </li>
                <li class="breadcrumb-item active">Detail Point
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      {{-- content --}}
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><b>Detail Point</b>
              </h4>

            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <strong>Full Name</strong>
                </div>
                <div class="col-6">
                  <strong>#</strong>
                </div>
                <div class="col-12">
                  <strong>Program</strong>
                </div>
                <div class="col-6">
                  <strong>#</strong>
                </div>
              </div>



              <div class="collapse-icon">
                <div class="collapse-default">
                  <div class="card">
                    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                      <span class="lead collapse-title"><b>1. Question 1 (10)</b></span>
                    </div>
                    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                      <div class="card-body">
                        #
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse2" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      <span class="lead collapse-title"><b>2. Question 2 (10)</b></span>
                    </div>
                    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" aria-expanded="false">
                      <div class="card-body">
                        #
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse3" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                      <span class="lead collapse-title"><b>3. Question 3 (10)</b></span>
                    </div>
                    <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" aria-expanded="false">
                      <div class="card-body">
                        #
                      </div>
                    </div>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
      })
    })
  </script>
  @endpush