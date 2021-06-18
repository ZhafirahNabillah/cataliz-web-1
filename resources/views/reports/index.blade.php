@extends('layouts.layoutVerticalMenu')

@section('title','Report')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Report
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan report yang anda miliki" />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Report
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">

        {{-- Alert for success message --}}
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dissmisable">
          <h4 class="alert-heading">Success</h4>
          <div class="alert-body">{{ $message }}</div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        @endif

        {{-- create topic button --}}
        @can('create-report')
        <div class="row">
          <div class="col-12">
            <a href={{ route('report.create')}} class="create-new btn btn-primary">New Report</a>
          </div>
        </div>
        @endcan
        <br>

        <ul class="nav nav-tabs justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="individual-tab" data-toggle="tab" href="#individual"
              aria-controls="individual" role="tab" aria-selected="true">Individual</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" aria-controls="group" role="tab"
              aria-selected="false">Group</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- Panel Individu -->
          <div class="tab-pane active" id="individual" aria-labelledby="individual-tab" role="tabpanel">
            <!-- Basic table -->
            <section id="basic-datatable">
              <div class="row">
                <div class="col-12">
                  <div class="card style=" border-radius: 15px;>
                    <table class="datatables-basic table-striped report-datatable-individual">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Coachee Name</th>
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
          <!-- /panel individu -->

          <!-- Panel Grup -->
          <div class="tab-pane" id="group" aria-labelledby="group-tab" role="tabpanel">
            <!-- Basic table -->
            <section id="basic-datatable">
              <div class="row">
                <div class="col-12">
                  <div class="card style=" border-radius: 15px;>
                    <table class="datatables-basic table-striped report-datatable-group">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Group Code</th>
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
          <!-- /coachee list -->
        </div>
      </div>
    </div>
    <!-- /panel  -->
  </div>
  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
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
      });

      var table_report_individual = $('.report-datatable-individual').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'client.name',
                            name: 'client.name'
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
					// render: '<i data-feather="search"></i>',
					// search: '<i data-feather="search"/>',
					searchPlaceholder: "Search records"
				}
      });

      var table_report_group = $('.report-datatable-group').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('report.show_group_table') }}",
          columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
              },
              {
                  name: 'group_id',
                  data: 'group_id'
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

      $('#group-tab').click(function() {
        $('.create-new').attr("href","{{route('report.create_group')}}");
      });

      $('#individual-tab').click(function() {
        $('.create-new').attr("href", "{{route('report.create')}}");
      });
    });
  </script>

  @endpush