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
            <h2 class="content-header-title float-left mb-0">Group Detail</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Client</a>
                </li>
                <li class="breadcrumb-item active">Group Detail
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
                  {{ $user->name }}
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-3">
                  <b>Group Code</b>
                </div>
                <div class="col-sm-9">
                  {{ $plan->group_id }}
                </div>
              </div>
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <table class="datatables-basic table client-datatable">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
  var table_client_group = $('.client-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "",
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'email',
        name: 'email',
        defaultContent: '<i>-</i>'
      },
      {
        data: 'program',
        name: 'program',
        orderable: true,
        searchable: true
      },
      {
        data: 'phone',
        name: 'phone',
        render: function (data, type, row) {
          return '+62'+data; 
        }
      }
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
})
</script>
@endpush
