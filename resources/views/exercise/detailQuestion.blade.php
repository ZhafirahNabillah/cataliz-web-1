@extends('layouts.layoutVerticalMenu')

@section('title','Exam')

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
            <h2 class="content-header-title float-left mb-0">Exam
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar ujian yang tersedia dalam sistem" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('exercise.index')}}">Exam</a>
                </li>
                <li class="breadcrumb-item active">#category
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

            <div class="text-center card-title ">
              <h3 class="mt-1"><b>{{ $topic->topic }}</b></h3>
              <p><span>created by {{ $topic->trainer->name }} </span></p>
              <p><span>Question:#totalQuestion </span></p>
            </div>

            <!-- Panel Exam -->
            <div class="tab-pane active" id="review" aria-labelledby="review-tab" role="tabpanel">
              <div class="collapse-icon">
                <div class="collapse-default">
                  @foreach ($answers as $answer)
                  <div class="card">
                    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse1">
                      <span class="lead collapse-title"><b>{{ 'Question '.$loop->iteration }}</b></span>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                      <div class="card-body">
                        <p><b>Score:{{ $answer->question->weight }}</b></p>
                        <div class="question d-inline-flex">
                          <div class="form-group">
                            <input class="form-check-input form-control" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              {!! $answer->question->question !!}
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <!-- /panel Exam-->
            <!-- tbl submit -->
            <div class="text-left">
              <button class="btn btn-sm btn-primary" type="submit">Submit All</button>
            </div>
            <!-- /tbl submit -->
          </div>
        </div>
      </div>
    </div>



  </div>




  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


  <script type="text/javascript">
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });

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
    });
  </script>

  @endpush