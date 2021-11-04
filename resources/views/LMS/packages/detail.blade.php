@extends('layouts.layoutVerticalMenu')

@section('title','Client')

@section('content')

@include('panels.navbar')

@include('LMS.sidemenuLMS')

<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Program List</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('program.index')}}">Program List</a>
                </li>
                <li class="breadcrumb-item active">Detail Program
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><b>Detail Program</b></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <dt class="col-sm-3"><b>Package Name</b></dt>
                  <dt class="col-sm-9"><b>{{ $package->package_name }}</b></dt>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>
</div>
</div>
</div>
</div>
<!-- END: Content-->
@endsection