@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

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
            <h2 class="content-header-title float-left mb-0">Topics
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Topic
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#coach" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee" aria-controls="profile" role="tab" aria-selected="false">Group</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- Panel Individu -->
          <div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">
            <div class="content-body">
              <div class="alert alert-danger alert-dissmisable fade show" style="display:none" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-dissmisable">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif
              <div class="row">
                <div class="col-12">

                  <a href={{ route('topic.create')}} class="create-new btn btn-primary">New Topic</a>

                </div>
              </div>
              <br>
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <table class="datatables-basic table-striped table plan-datatable-individual">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Topic</th>
                            <th>Participant</th>
                            <th>Action</th>
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
          </div>
          <!-- /panel individu -->


          <!-- Panel Grup -->
          <div class="tab-pane" id="coachee" aria-labelledby="coachee-tab" role="tabpanel">
            <div class="content-body">
              <div class="alert alert-danger alert-dissmisable fade show" style="display:none" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-dissmisable">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif

              <div class="row">
                <div class="col-12">

                  <a href={{ route('topic.create')}} class="create-new btn btn-primary">New Topic</a>

                </div>
              </div>
              <br>
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">

                      <table class="datatables-basic table-striped table plan-datatable-group">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Topic</th>
                            <th>Participant</th>
                            <th>Action</th>
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
          </div>
          <!-- /coachee list admin -->
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

      $(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });



      });
    </script>

    @endpush