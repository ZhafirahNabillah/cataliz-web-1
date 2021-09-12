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
                  <table class="datatables-basic table-striped table manager-datatable-manager">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Manager Name</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th style="line-height: 40px;">Action</th>
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
                  <table class="datatables-basic table-striped table admin-datatable-coachee">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Coachee Name</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Program</th>
                        <th style="line-height: 40px;">Action</th>
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
                  <table class="datatables-basic table-striped table admin-datatable-trainer">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Trainer Name</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th style="line-height: 40px;">Action</th>
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
                  <table class="datatables-basic table-striped table manager-datatable-coachmentors">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>CoachMentors Name</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th style="line-height: 40px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="modal modal-slide-in fade" id="modal-user-slide-in" aria-hidden="true">
        <div class="modal-dialog sidebar-sm">
          <form class="add-new-record modal-content pt-0" id="createUserForm" name="createUserForm">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title" id="modalHeading">Add User</h5>
            </div>
            <input type="hidden" name="user_id" id="user_id">
            <div class="modal-body flex-grow-1">
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <input id="name" name="name" type="text" class="form-control dt-full-name"
                  id="basic-icon-default-fullname" value="" placeholder="Full name here..." />
                <div id="name-error"></div>
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-post">Phone</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon5">+62</span>
                  </div>
                  <input id="phone" name="phone" type="text" onkeypress="return isNumberKey(event)" class="form-control"
                    value="" placeholder="Phone number here...">
                </div>
                <div id="phone-error"></div>
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-email">Email</label>
                <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email"
                  placeholder="Email here..." />
                <small class="form-text text-muted"> You can use letters, numbers & periods</small>
                <div id="email-error"></div>
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Role</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-coach" value="coach">
                  <label class="form-check-label" for="permission-check-coach">
                    Coach
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-coachee"
                    value="coachee">
                  <label class="form-check-label" for="permission-check-coachee">
                    Coachee
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-manager" value="manager">
                  <label class="form-check-label" for="permission-check-manager">
                    Manager
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-admin" value="admin">
                  <label class="form-check-label" for="permission-check-admin">
                    Admin
                  </label>
                </div>
                {{-- <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-admin" value="trainer">
                  <label class="form-check-label" for="permission-check-trainer">
                    Trainer
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-admin" value="Mentor">
                  <label class="form-check-label" for="permission-check-mentor">
                    Mentor
                  </label>
                </div> --}}
                {{-- <div class="form-check">
                  <input class="form-check-input" type="radio" name="roles" id="permission-check-coachee" value="coachee">
                  <label class="form-check-label" for="permission-check-coachee">
                    Coachee
                  </label>
                </div> --}}
                <div id="roles-error"></div>
              </div>
              <div class="form-group" id="batch-field-wrapper">
                <label class="form-label" for="">Batch</label>
                <select class="form-control" name="batch" id="batch">
                  <option disabled selected hidden value="0">Select batch</option>
                </select>
                <div id="batch-error"></div>
                <small class="form-text text-muted">Batch must be filled if program was chosen</small>
              </div>
              <input type="hidden" name="action_type" id="action_type">
              <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn">Create</button>
              <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </form>
          <!-- </form>-->
        </div>
      </div>
      <!-- End Modal -->
      @endrole
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
