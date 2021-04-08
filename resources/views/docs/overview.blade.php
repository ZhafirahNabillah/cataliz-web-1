@extends('layouts.layoutVerticalMenu')

@section('title','Documentations')

@section('content')

@include('panels.navbar')
@include('panels.sidemenuDocs')
<div class="app-content content ">
  <div class="content-wrapper">
    <!-- Vertical Tabs start -->
    <section id="vertical-tabs">
      <div class="row match-height">
        <!-- Vertical Left Tabs start -->
        <div class="Col-sm-12 col-md-12">
          <div class="nav-vertical">
            <ul class="nav nav-tabs nav-left flex-column col-2" role="tablist">
              @foreach ($documentations as $documentation)
                {{-- <li class="nav-item">
                  <a class="nav-link @if ($loop->first) active @endif" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#{{ $documentation->id }}" role="tab" aria-selected="true">{{ $documentation->title }}</a>
                </li> --}}

                <li class="nav-item">
                  <a class="nav-link @if ($loop->first) active @endif" id="{{ $documentation->id }}-tab" data-toggle="tab" href="#{{ $documentation->category.'-'.$documentation->id }}" role="tab" >{{ ucfirst($documentation->title) }}</a>
                </li>
              @endforeach
            </ul>
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  {{-- @foreach ($documentations as $documentation)
                    <div class="tab-pane @if ($loop->first) active @endif" id="{{ $documentation->id }}" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
                      {!! $documentation->description !!}
                    </div>
                  @endforeach --}}

                  @foreach ($documentations as $documentation)
                    <div class="tab-pane @if ($loop->first) active @endif" id="{{ $documentation->category.'-'.$documentation->id }}" aria-labelledby="coach-tab" role="tabpanel">
                      {!! $documentation->description !!}
                    </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Vertical Left Tabs ends -->
      </div>
      @endsection
