@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@push('styles')
<style media="screen">
  li {
    list-style-type: none;
  }
</style>
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Result
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan Exercise yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('result.index')}}">Result</a>
                </li>
                <li class="breadcrumb-item active">{{ $client->name }}
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
                  <strong>{{ $client->name }}</strong>
                </div>
                <div class="col-12">
                  <strong>Program</strong>
                </div>
                <div class="col-6">
                  <strong>{{ $client->program }}</strong>
                </div>
              </div>



              <div class="collapse-icon">
                <div class="collapse-default">
                  @foreach ($answers as $answer)
                  <div class="card">
                    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
                      data-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse1">
                      <span class="lead collapse-title"><b>{{ 'Question '.$loop->iteration }}</b></span>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" role="tabpanel" aria-labelledby="headingCollapse1"
                      class="collapse">
                      <div class="card-body">
                        <div class="question d-inline-flex">
                          {!! $answer->question->question !!}({{ $answer->question->weight }})
                        </div>
                        @php ($choice_itr = 'A')
                        @foreach ($answer_choices = explode(',', $answer->question->answers) as $answer_choice)
                        @if ($answer->answer == $loop->index && $answer->is_correct_answer == 1)
                        <li class="text-success">{{$choice_itr++}}. {{ $answer_choice }}</li>
                        @elseif ($answer->answer == $loop->index && $answer->is_correct_answer == 0)
                        <li class="text-danger">{{$choice_itr++}}. {{ $answer_choice }}</li>
                        @else
                        <li>{{$choice_itr++}}. {{ $answer_choice }}</li>
                        @endif
                        @endforeach
                        <p>True answer : {{ $answer_choices[$answer->question->true_answer] }}</p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /panel coachee -->



  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
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