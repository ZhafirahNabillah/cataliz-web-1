@extends('layouts.layoutVerticalMenu')

@section('title','Documentations')

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
            <h2 class="content-header-title float-left mb-0">Documentations
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada bagian ini ditampilkan daftar rencana dari coach yang ada dalam sistem." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Documentations
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dissmisable">
          <h4 class="alert-heading">Success</h4>
          <div class="alert-body">{{ $message }}</div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        @endif
        @role('admin')
        <ul class="nav nav-tabs justify-content-center" role="tablist">
          @foreach ($roles as $role)
          <li class="nav-item">
            <a class="nav-link @if ($loop->first) active @endif" id="{{ $role->name }}-tab" data-toggle="tab" href="#{{ $role->name }}" role="tab">{{ ucfirst($role->name) }}</a>
          </li>
          @endforeach
        </ul>
        <div class="tab-content">
          @foreach ($roles as $role)
          <div class="tab-pane @if ($loop->first) active @endif" id="{{ $role->name }}" aria-labelledby="coach-tab" role="tabpanel">
            <div class="row">
              <div class="col-12">
                <a href={{ url('/docs/create?role='.$role->name) }} class="create-new btn btn-primary">Add New</a>
              </div>
            </div>
            <br>
            <section id="basic-datatable">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <table class="datatables-basic table-striped table docs-datatable-{{ $role->name }}">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Category</th>
                          <th>Title</th>
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
          </div>
          @endforeach
        </div>
        @endrole
        @role('manager')
      <div class="">
        <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
          class="btn btn-primary data-submit mr-1 createNewUser">Add User</button>
      </div>
      <div class="card">
        <div class="card-body"> 
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#manager" aria-controls="profile" role="tab"
                aria-selected="true">Manager</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee" aria-controls="profile" role="tab"
                aria-selected="false">Coachee</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#trainer" aria-controls="profile" role="tab"
                aria-selected="false">Trainer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachmentors" aria-controls="profile" role="tab"
                aria-selected="false">Coachmentors</a>
            </li>
          </ul>
        <div class="tab-content">

            <!-- Panel manager -->
            <div class="tab-pane active" id="manager" aria-labelledby="manager-tab" role="tabpanel">
              <!-- adminlist card -->
              <div class="row">
                <div class="col-12">
                <hr class="mb-0">
                  <table class="datatables-basic table-striped table docs-datatable-manager">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Category</th>
                          <th>Title</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /admin list admin -->

            <!-- Panel Coachee -->
            <div class="tab-pane" id="coachee" aria-labelledby="coachee-tab" role="tabpanel">
              <!-- coacheelist card -->

              <div class="row">
                <div class="col-12">
                  <hr class="mb-0">
                  <table class="datatables-basic table-striped table docs-datatable-coachee">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Category</th>
                          <th>Title</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /coachee list admin -->

            <!-- Panel Trainer -->
            <div class="tab-pane" id="trainer" aria-labelledby="trainer-tab" role="tabpanel">
              <!-- trainerlist card -->

              <div class="row">
                <div class="col-12">
                  <div class="d-block text-right">
                    {{-- <a href="{{ route('coachee_pdf') }}" class="btn btn-primary">Download PDF</a> --}}
                  </div>
                  <hr class="mb-0">
                  <table class="datatables-basic table-striped table docs-datatable-trainer">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Category</th>
                          <th>Title</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /trainer list admin -->

            <!-- Panel coachmentors -->
            <div class="tab-pane" id="coachmentors" aria-labelledby="coachmentors-tab" role="tabpanel">
              <!-- mentorlist card -->

              <div class="row">
                <div class="col-12">
                  <div class="d-block text-right">
                    {{-- <a href="{{ route('coachee_pdf') }}" class="btn btn-primary">Download PDF</a> --}}
                  </div>
                  <hr class="mb-0">
                  <table class="datatables-basic table-striped table docs-datatable-coachmentors">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Category</th>
                          <th>Title</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
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
  });

  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var documentation_table = $('.docs-datatable-admin').DataTable({
      processing: true,
      serverSide: true,
      ajax: "",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-coach').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.coach_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-coachee').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.coachee_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-trainer').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.trainer_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-coachmentors').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.coachmentors_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-manager').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.manager_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    var documentation_table = $('.docs-datatable-mentor').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('docs.mentor_docs') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'title',
          name: 'title'
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

    $('body').on('click', '.deleteDocs', function(e) {

      var docs_id = $(this).data("id");
      console.log(docs_id);
      // ganti sweetalert

      Swal.fire({
        title: "Are you sure?",
        text: "You'll delete your documentation",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Sure",
        cancelButtonText: "Cancel"
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            type: "DELETE",
            url: "" + '/docs/' + docs_id,
            success: function(data) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted Successfully!',
              });
              documentation_table.draw();
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
        }
      })
    });
  });
</script>

@endpush
