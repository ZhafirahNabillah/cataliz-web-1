@extends('layouts.layoutVerticalMenu')

@section('title','Result')

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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Result
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    @role('coachee')
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
                  <table class="datatables-basic table-striped table exam-result-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Topic</th>
                        <th>Grade</th>
                        <th>Action</th>
                      </tr>
                    </thead>
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

    @role('coach|admin')
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
                  <table class="datatables-basic table-striped table exam-result-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Topic</th>
                        <th>Grade</th>
                        <th>Action</th>
                      </tr>
                    </thead>
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
          </div>
          <br>
          <!-- Basic table -->
          <section id="basic-datatable">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <table class="datatables-basic table-striped table exam-result-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Topic</th>
                        <th>Grade</th>
                        <th>Action</th>
                      </tr>
                    </thead>
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
                  <table class="datatables-basic table-striped table exam-result-datatable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Topic</th>
                        <th>Grade</th>
                        <th>Action</th>
                      </tr>
                    </thead>
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

      var result_table = $('.exam-result-datatable').DataTable({
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
            data: 'topic.topic',
            name: 'topic.topic',
          },
          {
            data: 'grade',
            name: 'grade',
            render: function(data) {
              return '<strong>' + data + '</strong>' + '/100';
            }
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