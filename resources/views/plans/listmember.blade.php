@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

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
            <h2 class="content-header-title float-left mb-0">Coaching Plans</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Coaching Plans</a>
                </li>
                <li class="breadcrumb-item active">Detail Coaching Plan
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
              <h4 class="card-title"><b>Group Member</b></h4>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-sm-3">
                  <b>Coach Name</b>
                </div>
                <div class="col-sm-9">
                  #
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-3">
                  <b>Group ID</b>
                </div>
                <div class="col-sm-9">
                  #
                </div>
              </div>
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <table class="datatables-basic table default-datatable-plans">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Coachee Name</th>
                            <th>Email</th>
                            <th>Program</th>
                            <th>Phone</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section>
              <!--/ Basic table -->
            </div>
            <a href="" class="create-new btn btn-primary">Add New</a>


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
</script>
@endpush