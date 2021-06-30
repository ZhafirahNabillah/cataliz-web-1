@extends('layouts.layoutVerticalMenu')

@section('title','Client')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        @role('admin|mentor')
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User
                            @role('coach|admin')
                            <img class="align-text width=" 15px" height="15px"" src="
                                {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
                                data-toggle="popover" data-placement="top"
                                data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />
                            @else
                            <img class="align-text width=" 15px" height="15px"" src="
                                {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
                                data-toggle="popover" data-placement="top"
                                data-content="Halaman ini menampilkan daftar pengguna yang terhubung dengan Anda." />
                            @endrole
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User List
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        <div class="content-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dissmisable">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            @role('admin')
            <div class="">
                <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
                    class="btn btn-success data-submit mr-1 restoreAll">Restore All User</button>
                <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
                    class="btn btn-danger data-submit mr-1 deletePermanently">Delete Permanently</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#admin" aria-controls="profile"
                                role="tab" aria-selected="false">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#coach"
                                aria-controls="coach" role="tab" aria-selected="true">Coach</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee"
                                aria-controls="profile" role="tab" aria-selected="false">Coachee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#trainer"
                                aria-controls="profile" role="tab" aria-selected="false">Trainer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mentor"
                                aria-controls="profile" role="tab" aria-selected="false">Mentor</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Panel Coach -->
                        <div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">
                            <!-- coachlist card -->
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mb-0">
                                    <table class="datatables-basic table-striped table admin-datatable-coach">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Coach Name</th>
                                                <th>Email</th>
                                                <th>Handphone</th>
                                                {{-- <th>Rating</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /coach list admin -->
                        <!-- /panel coach -->


                        <!-- Panel Admin -->
                        <div class="tab-pane" id="admin" aria-labelledby="admin-tab" role="tabpanel">
                            <!-- adminlist card -->
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mb-0">
                                    <table class="datatables-basic table-striped table admin-datatable-admin">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Admin Name</th>
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
                                        {{-- <a href="{{ route('coachee_pdf') }}" class="btn btn-primary">Download
                                        PDF</a> --}}
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

                        <!-- Panel Mentor -->
                        <div class="tab-pane" id="mentor" aria-labelledby="mentor-tab" role="tabpanel">
                            <!-- mentorlist card -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="d-block text-right">
                                        {{-- <a href="{{ route('coachee_pdf') }}" class="btn btn-primary">Download
                                        PDF</a> --}}
                                    </div>
                                    <hr class="mb-0">
                                    <table class="datatables-basic table-striped table admin-datatable-mentor">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mentor Name</th>
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
                        <!-- /mentor list admin -->
                    </div>
                </div>
            </div>
            <!-- /panel coachee -->
            @endrole

            <!-- END: Content-->
            @endsection

            @push('scripts')
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
                id="theme-styles">
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
            <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
            <script>
                $(function() {
          //custom validation method for phone number
          $.validator.addMethod("phoneNumber", function(value, element) {
            return this.optional(element) || /^[1-9][0-9]/.test(value);
          }, 'Please enter a valid phone number.');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          var table_coach = $('.admin-datatable-coach').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_deleted_coach_list') }}",
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
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                  return '+62' + data;
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

          var table_coachee = $('.admin-datatable-coachee').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_deleted_coachee_list') }}",
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
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                  return '+62' + data;
                }
              },
              {
                data: 'program',
                name: 'program',
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

          var table_admin = $('.admin-datatable-admin').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_deleted_admin_list') }}",
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
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                  return '+62' + data;
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
            },
          });

          var table_trainer = $('.admin-datatable-trainer').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_deleted_trainer_list') }}",
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
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                  return '+62' + data;
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
            },
          });

          var table_mentor = $('.admin-datatable-mentor').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_deleted_mentor_list') }}",
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
                data: 'phone',
                name: 'phone',
                render: function(data, type, row) {
                  return '+62' + data;
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
            },
          });

          $('body').on('click', '.restoreUser', function() {
            Swal.fire({
              title: "Are you sure?",
              text: "The user you choose will be restored!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                var user_id = $(this).data('id');
                  $.ajax({
                    type: "GET",
                    url: "" + '/restore_user/' + user_id,
                    success: function(data) {
                      Swal.fire({
                        icon: 'success',
                        title: 'Account restored successfully!',
                      });
                      table_coach.draw();
                      table_admin.draw();
                      table_coachee.draw();
                      table_trainer.draw();
                      table_mentor.draw();                    },
                    error: function(data) {
                      console.log('Error:', data);
                    }
                  });
              }
            })
          });

          $('body').on('click', '.deletePermanently', function() {
            Swal.fire({
              title: "Are you sure?",
              text: "All data will be deleted!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                // var user_id = $(this).data('id');
                  $.ajax({
                    type: "POST",
                    url: "" + '/delete_permanently',
                    success: function(data) {
                      Swal.fire({
                        icon: 'success',
                        title: 'All user deleted permanently!',
                      });
                      table_coach.draw();
                      table_admin.draw();
                      table_coachee.draw();
                      table_trainer.draw();
                      table_mentor.draw();                    },
                    error: function(data) {
                      console.log('Error:', data);
                    }
                  });
              }
            })
          });

          $('body').on('click', '.restoreAll', function() {
            Swal.fire({
              title: "Are you sure?",
              text: "All data will be restored!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                // var user_id = $(this).data('id');
                  $.ajax({
                    type: "GET",
                    url: "" + '/restore_all_user',
                    success: function(data) {
                      Swal.fire({
                        icon: 'success',
                        title: 'All user retored!',
                      });
                      table_coach.draw();
                      table_admin.draw();
                      table_coachee.draw();
                      table_trainer.draw();
                      table_mentor.draw();                    },
                    error: function(data) {
                      console.log('Error:', data);
                    }
                  });
              }
            })
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
          })
        });
            </script>
            @endpush