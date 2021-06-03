@extends('layouts.layoutVerticalMenu')
@section('title','Exam')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Exam
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar ujian yang tersedia dalam sistem" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('exercise.index')}}">Exam</a>
                </li>
                <li class="breadcrumb-item active">Detail Question
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="card border">
              <p class="mt-2 ml-2"><b>{{strip_tags($question->question)}}</b></p>
              <div class="card-body">
                @foreach ($ans_array as $dt)

                <ul>{{$choice_itr++}}. {{$dt}}</ul>
                @endforeach
              </div>
              <p class="ml-2">Answer : <b>{{ $ans_array[$question->true_answer - 1] }}</b></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Content-->
  @endsection
