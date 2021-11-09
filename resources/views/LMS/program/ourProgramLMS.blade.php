@extends('layouts.layoutVerticalMenu')
@push('styles')
<link href="//cdn.jsdelivr.net/npm/fullcalendar@5.7.0/main.min.css" rel="stylesheet">
<style>
    /* @media only screen and (min-device-width : 769px) and (max-device-width : 1639px) {
    .imgDashboardWrapper {
      height: 5%;
      width: 5%;
      float: left;
    }

    .textCard {
      text-align: left !important;
      padding-top: 4%;
      font-size: 3%;
      

    }
  }

  .imgDashboardWrapper {
    height: 30%;
    width: 30%;
    float: left;
  }

  .textCard {
    text-align: left !important;
    padding-top: 4%;
    padding-left: 5%;
  } */
</style>
@endpush
@section('title','Home')


@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">

            <section id="card-demo-example">
                <div class="row match-height">
                    <div class="container-fluid">
                        <div class="row justify-content-left">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-tabs justify-content-center pt-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#sub-topic" aria-controls="profile" role="tab" aria-selected="false">All Program</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="coach-tab" data-toggle="tab" href="#participant" aria-controls="coach" role="tab" aria-selected="true">Packages</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="card-header">
                                        <h6 class="card-title">Recently Accesed Program
                                        </h6>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex flex-sm-row flex-column p-2">
                                            <div class="col-sm-4">
                                                <a href="{{route('programLms.detail_program')}}">
                                                    <div class="card text-silver" style="background-color : #E4E4E4;">
                                                        <img class="img-fluid" src=" {{asset('assets\images\abstract1.png')}}" alt=" ">
                                                        <div class="card-body">
                                                            <p class="card-text">SCMP</p>
                                                            <p class="card-text">UI/UX Design</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card text-silver" style="background-color : #E4E4E4;">
                                                    <img class="img-fluid" src=" {{asset('assets\images\abstract2.png')}}" alt=" ">
                                                    <div class="card-body">
                                                        <p class="card-text">SCMP</p>
                                                        <p class="card-text">Project Manager</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="card text-sliver" style="background-color : #E4E4E4;">
                                                    <img class="img-fluid" src=" {{asset('assets\images\abstract3.png')}}" alt=" ">
                                                    <div class="card-body">
                                                        <p class="card-text">SCMP</p>
                                                        <p class="card-text">Enterprise Arcitect</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h6 class="card-title">My Program
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-sm-row flex-column p-2">

                                        <div class="col-sm-4">
                                            <div class="card text-silver" style="background-color : #E4E4E4;">
                                                <img class="img-fluid" src=" {{asset('assets\images\abstract4.png')}}" alt=" ">
                                                <div class="card-body">
                                                    <p class="card-text">STARCO</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="card text-silver" style="background-color : #E4E4E4;">
                                                <img class="img-fluid" src=" {{asset('assets\images\abstract5.png')}}" alt=" ">
                                                <div class="card-body">
                                                    <p class="card-text">SCMP</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>

@endsection