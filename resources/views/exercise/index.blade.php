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
                <li class="breadcrumb-item active">Exam
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    @role('trainer')
    <div class="card">
      <div class="card-body">
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

              <a href={{ route('exercise.create')}} class="create-new btn btn-primary">New Exam</a>
            </div>
          </div>
          <br>
          <!-- Basic table -->
          <section id="basic-datatable">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <table class="datatables-basic table-striped table exercise-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Topic</th>
                        <th>Total Questions</th>
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
    </div>
    @endrole

    @role('mentor')
    <div class="card">
      <div class="card-body">
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
          </div>
          <br>
          <!-- Basic table -->
          <section id="basic-datatable">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <table class="datatables-basic table-striped table exam-result-datatable-mentor">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Question</th>
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
    </div>
    @endrole

    @role('coach|admin|coachee')
    <div class="card">
      <div class="card-body">
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
          </div>
          <br>
          <!-- Basic table -->
          <section id="basic-datatable">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <table class="datatables-basic table-striped table exam-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Topic</th>
                        <th>Category</th>
                        <th>Question</th>
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
    </div>
    @endrole

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

      var table_exercise = $('.exercise-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'topic',
            name: 'topic'
          },
          {
            data: 'total_questions',
            name: 'total_questions',
            defaultContent: '0'
          },
          {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
          },
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          },
          search: "<i data-feather='search'></i>",
          searchPlaceholder: "Search records"
        }
      });

      var table_exam_result_mentor = $('.exam-result-datatable-mentor').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'user.name',
            name: 'user.name'
          },
          {
            data: 'category.category',
            name: 'category.category'
          },
          {
            data: 'total_questions',
            name: 'total_questions'
          },
          {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
          },
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          },
          search: "<i data-feather='search'></i>",
          searchPlaceholder: "Search records"
        }
      });

      var table_exercise = $('.exam-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'topic',
            name: 'topic'
          },
          {
            data: 'category',
            name: 'category'
          },
          {
            data: 'total_questions',
            name: 'total_questions',
            defaultContent: '0'
          },
          {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
          },
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          },
          search: "<i data-feather='search'></i>",
          searchPlaceholder: "Search records"
        }
      });
    });
  </script>

  @endpush