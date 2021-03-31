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
              <h4 class="card-title"><b>Detail Plan</b>
              </h4>
              <a href="{{ route('plans.detail_to_pdf', $plan->id) }}" class="btn btn-primary">Download PDF</a>
            </div>
            @role('coachee')
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <b>Coach</b>
                </div>
                <div class="col-sm-6">
                  {{$coach_detail->name}}
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <strong>Client Name</strong>
                </div>
                <div class="col-6">
                  <strong>Organization</strong>
                </div>
              </div>
              <div class="row mb-2">
                @foreach ($plan->clients as $client)
                <div class="col-6">
                  {{ $client->name }}
                </div>
                <div class="col-6">
                  {{ $client->organization ?? '-' }}
                </div>
                @endforeach
              </div>
              {{-- <div class="row mb-2">
                <div class="col-sm-3">
                  <b>Organization</b>
                </div>
                <div class="col-sm-9">
                  {{$client->organization}}
            </div>
          </div> --}}
          <div class="row mb-2">
            <div class="col-sm-6">
              <b>Date</b>
            </div>
            <div class="col-sm-6">
              {{$plan->date}}
            </div>
          </div>
          <div class="collapse-icon">
            <div class="collapse-default">
              <div class="card">
                <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                  <span class="lead collapse-title"><b>Objective</b></span>
                </div>
                <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                  <div class="card-body">
                    {!!$plan->objective!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse2" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                  <span class="lead collapse-title"><b>Success Indicator</b></span>
                </div>
                <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->success_indicator!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse3" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  <span class="lead collapse-title"><b>Development Areas</b></span>
                </div>
                <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->development_areas!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse34" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                  <span class="lead collapse-title"><b>Support</b></span>
                </div>
                <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->support!!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endrole

        @role('coach|admin')
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <strong>Client Name</strong>
            </div>
            <div class="col-6">
              <strong>Organization</strong>
            </div>
          </div>
          <div class="row mb-2">
            @foreach ($plan->clients as $client)
            <div class="col-6">
              {{ $client->name }}
            </div>
            <div class="col-6">
              {{ $client->organization ?? '-' }}
            </div>
            @endforeach
          </div>
          <div class="row mb-2">
            <div class="col-sm-6">
              <b>Date</b>
            </div>
            <div class="col-sm-6">
              {{$plan->date}}
            </div>
          </div>
          <div class="collapse-icon">
            <div class="collapse-default">
              <div class="card">
                <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                  <span class="lead collapse-title"><b>Objective</b></span>
                </div>
                <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                  <div class="card-body">
                    {!!$plan->objective!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse2" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                  <span class="lead collapse-title"><b>Success Indicator</b></span>
                </div>
                <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->success_indicator!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse3" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  <span class="lead collapse-title"><b>Development Areas</b></span>
                </div>
                <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->development_areas!!}
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="headingCollapse34" class="card-header collapse-header" data-toggle="collapse" role="button" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                  <span class="lead collapse-title"><b>Support</b></span>
                </div>
                <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="collapse" aria-expanded="false">
                  <div class="card-body">
                    {!!$plan->support!!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endrole

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