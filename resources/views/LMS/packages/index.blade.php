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
    
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Packages
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="/">Packages</a>
                </li>
                <li class="breadcrumb-item active">Add New Packages
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

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

      <img class="img-fluid" src=" {{asset('assets\images\icons\user\banner.png')}}" alt="Card image cap" />
      <div class="">
        <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
          class="btn btn-primary data-submit mr-1 createNewUser">Add New Packages</button>
      </div>
      <div class="card">
        <div class="card-body">

          <div class="tab-content">
            <!-- Panel Individu -->
            <div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card style=" border-radius: 15px;>
                      <table class="datatables-basic table-striped table yajra-datatable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Packages Name</th>
                            <th>What's In It?</th>
                            <th>Actions</th>
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
      <!-- /panel  -->

      <!-- Modal Detail Trainer -->
      <div class="modal modal-slide-in fade" id="modal-trainer-detail" role="dialog" aria-hidden="true">
        <div class="modal-dialog sidebar-sm" role="document">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-header">
              <h5 class="modal-title" id="modalHeadingTrainer"></h5>
            </div>

            <div class="modal-body flex-grow-1">
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-6">Full Name</dt>
                </dl>
                <dl class="row">
                  <small class="col-sm-12 name"></small>
                </dl>
                <dl class="row">
                  <dt class="col-sm-6">Program Name</dt>
                </dl>
              </div>
              <!-- </Card modal>-->
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
      <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
      <script>
        $(function () {
          //custom validation method for phone number
          $.validator.addMethod("phoneNumber", function (value, element) {
            return this.optional(element) || /^[1-9][0-9]/.test(value);
          }, 'Please enter a valid phone number.');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var table_client_individual = $('.yajra-datatable').DataTable({
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
                name: 'email'
              },
              {
                data: 'program',
                name: 'program'
              },
              {
                data: 'phone',
                name: 'phone'
              },
              {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
              },
            ],
            columnDefs: [{
                // Avatar image/badge, Name and post
                targets: 1,
                responsivePriority: 4,
                render: function (data, type, full, meta) {
                  var $user_img = full['avatar'],
                    $name = full['name'],
                    $post = full['company'];
                  $org = full['organization'];
                  if ($user_img) {
                    // For Avatar image
                    var $output =
                      '<img src="' + assetPath + 'images/avatars/' + $user_img +
                      '" alt="Avatar" width="32" height="32">';
                  } else {
                    // For Avatar badge
                    var stateNum = full['status'];
                    var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                    var $state = states[stateNum],
                      $name = full['name'],
                      $initials = $name.match(/\b\w/g) || [];
                    $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                    $output = '<span class="avatar-content">' + $initials + '</span>';
                  }

                  var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                  // Creates full output for row
                  var $row_output =
                    '<div class="d-flex justify-content-left align-items-center">' +
                    '<div class="avatar ' +
                    colorClass +
                    ' mr-1">' +
                    $output +
                    '</div>' +
                    '<div class="d-flex flex-column">' +
                    '<span class="emp_name text-truncate font-weight-bold">' +
                    $name +
                    '</span>' +
                    '<small class="emp_post text-truncate text-muted">' +
                    $post + ' - ' + $org +
                    '</small>' +
                    '</div>' +
                    '</div>';
                  return $row_output;
                }
              },
              {
                targets: 4,
                render: function (data, type, full, meta) {
                  var $phone = full['phone'],
                    $output = '<div class="d-flex justify-content-left align-items-center"> +62' + $phone +
                    '</div>';
                  return $output;
                }
              }
            ],
            order: [
              [2, 'desc']
            ],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            @can('create-client')
            buttons: [{
              text: feather.icons['plus'].toSvg({
                class: 'mr-50 font-small-4'
              }) + 'Add Client',
              className: 'create-new btn btn-primary createNewClient ',
              attr: {
                'data-toggle': 'modal'

              },
              init: function (api, node, config) {
                $(node).removeClass('btn-secondary');
              }
            }],
            @endcan
            responsive: {
              details: {
                display: $.fn.dataTable.Responsive.display.modal({
                  header: function (row) {
                    var data = row.data();
                    return 'Details of ' + data['name'];
                  }
                }),
                type: 'column',
                renderer: function (api, rowIdx, columns) {
                  var data = $.map(columns, function (col, i) {
                    console.log(columns);
                    return col.title !==
                      '' // ? Do not show row in modal popup if title is blank (for check box)
                      ?
                      '<tr data-dt-row="' +
                      col.rowIndex +
                      '" data-dt-column="' +
                      col.columnIndex +
                      '">' +
                      '<td>' +
                      col.title +
                      ':' +
                      '</td> ' +
                      '<td>' +
                      col.data +
                      '</td>' +
                      '</tr>' :
                      '';
                  }).join('');

                  return data ? $('<table class="table"/>').append(data) : false;
                }
              }
            },
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

          var table_client_group = $('.client-datatable-group').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('group.index') }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
              },
              {
                data: 'group_code',
                name: 'group_code'
              },
              {
                data: 'participant',
                name: 'participant',
                defaultContent: '<i>-</i>'
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
          var table_mentor = $('.manager-datatable-coachmentors').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_coachmentors_list') }}",
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
                render: function (data, type, row) {
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

          var table_trainer = $('.manager-datatable-manager').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_manager_list') }}",
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
                render: function (data, type, row) {
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

          var table_trainer = $('.coach-datatable-trainer').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_trainer_list') }}",
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
                render: function (data, type, row) {
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

          var table_mentor = $('.coach-datatable-mentor').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_mentor_list') }}",
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
                render: function (data, type, row) {
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

          var table = $('.coachee-datatable-coach').DataTable({
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
                data: 'phone',
                name: 'phone',
                defaultContent: '<i>-</i>'
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

          var table_coach = $('.admin-datatable-coach').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('show_coach_list') }}",
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
                render: function (data, type, row) {
                  return '+62' + data;
                }
              },
              // {
              //   data: 'rating',
              //   name: 'rating',
              //   defaultContent: '<i>-</i>'
              // },
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
            ajax: "{{ route('show_coachee_list') }}",
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
                render: function (data, type, row) {
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
            ajax: "{{ route('show_admin_list') }}",
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
                render: function (data, type, row) {
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
            ajax: "{{ route('show_trainer_list') }}",
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
                render: function (data, type, row) {
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
            ajax: "{{ route('show_mentor_list') }}",
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
                render: function (data, type, row) {
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

          // create new user on admin page
          $('body').on('click', '.createNewUser', function () {
            console.log('tes');
            $('#action_type').val("create-user");
            $('#user_id').val('');
            $('#createUserForm').trigger("reset");
            $('#modalHeading').html("Create New User");
            $('#program-field-wrapper').hide();
            $('#batch-field-wrapper').hide();
            $('#name').prop('readonly', false);
            $('#phone').prop('readonly', false);
            $('#email').prop('readonly', false);
            $('#name-error').empty();
            $('#phone-error').empty();
            $('#email-error').empty();
            $('#roles-error').empty();
            $('#program-error').empty();
            $('#batch-error').empty();
            $('#modal-user-slide-in').modal('show');
          });

          //Show program option when role coachee is selected
          $('input[name="roles"]').click(function () {
            var selectedRole = $(this).val();

            if (selectedRole == 'coachee') {
              console.log(selectedRole);
              $('#program-field-wrapper').show(500);
              $('#batch-field-wrapper').show(500);
            } else {
              console.log(selectedRole);
              $('#program-field-wrapper').hide(500);
              $('#batch-field-wrapper').hide(500);
            }
          });

          // edit user in admin page
          $('body').on('click', '.editUser', function () {
            var user_id = $(this).data('id');
            $('#program-field-wrapper').hide();
            $('#batch-field-wrapper').hide();
            $.get("" + '/users/' + user_id + '/edit', function (data) {
              $('#modalHeading').html("Edit User");
              $('#action_type').val("edit-user");
              $('#createUserForm').trigger("reset");
              $('#name-error').empty();
              $('#phone-error').empty();
              $('#email-error').empty();
              $('#roles-error').empty();
              $('#program-error').empty();
              $('#batch-error').empty();
              $('#user_id').val(data.user.id);
              $('#name').val(data.user.name).prop('readonly', true);
              $('#phone').val(data.user.phone).prop('readonly', true);
              $('#email').val(data.user.email).prop('readonly', true);
              $('#permission-check-' + data.role).prop('checked', true);
              $("#batch-field-wrapper select").val(0).change();
              // $.each(data.role, function(i, item) {
              //   var role_name = data.roles[i].name;
              // });
              if (data.program != null) {
                $('#program-' + data.program.id).prop('checked', true).trigger('change')

                //need to be resctrutured
                setTimeout(function () {
                  $("#batch").val(data.batch.id).change();
                }, 500);
              }

              if (data.role == 'coachee') {
                $('#program-field-wrapper').show();
                $('#batch-field-wrapper').show();
              }
              $('#modal-user-slide-in').modal('show');
            })
          });

          $('body').on('click', '.deleteUser', function () {
            Swal.fire({
              title: "Are you sure?",
              text: "The user you choose will be deleted!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                var user_id = $(this).data('id');
                $.ajax({
                  type: "DELETE",
                  url: "" + '/users/' + user_id,
                  success: function (data) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Account deleted successfully!',
                    });
                    table_coach.draw();
                    table_admin.draw();
                    table_coachee.draw();
                    table_trainer.draw();
                    table_mentor.draw();
                  },
                  error: function (data) {
                    console.log('Error:', data);
                  }
                });
              }
            })
          });

          // show detail coach on coachee page
          $('body').on('click', '.detailCoach', function () {
            var coach_id = $(this).data('id');
            $.get("" + '/users/' + coach_id + '/edit', function (data) {
              console.log(data);
              $('#modalHeading').html("Detail Coach");
              $('#saveBtn').val("edit-user");
              $('#modals-slide-in-coach').modal('show');
              $('#coach_id').val(data.id);
              $('.name').html(data.user.name);
              $('.phone').html(data.user.phone);
              $('.email').html(data.user.email);
              $('.total_coaching').html(data.total_coaching);
              $('.total_client').html(data.total_client);
            })
          });

          $('body').on('click', '.detailTrainer', function () {
            var trainer_id = $(this).data('id');
            $.get("" + '/users/' + trainer_id + '/edit', function (data) {
              console.log(data);
              $('#modal-trainer-detail').modal('show');
              $('#modalHeadingTrainer').html("Detail Trainer");
              $('.name').html(data.user.name);
              $('.phone').html('+62' + data.user.phone);
              $('.email').html(data.user.email);
              $('.skills').html(data.skills);
            })
          });

          $('body').on('click', '.detailMentor', function () {
            var mentor_id = $(this).data('id');
            $.get("" + '/users/' + mentor_id + '/edit', function (data) {
              console.log(data);
              $('#modal-mentor-detail').modal('show');
              $('#modalHeadingMentor').html("Detail Mentor");
              $('.name').html(data.user.name);
              $('.phone').html('+62' + data.user.phone);
              $('.email').html(data.user.email);
              $('.skills').html(data.skills);
            })
          });

          $('body').on('click', '.detailCoachee', function () {
            var coachee_id = $(this).data('id');
            $.get("" + '/users/' + coachee_id + '/edit', function (data) {
              console.log(data);
              $('#modal-coachee-detail').modal('show');
              $('#modalHeadingCoachee').html("Detail Coachee");
              $('.name').html(data.user.name);
              $('.phone').html('+62' + data.user.phone);
              $('.email').html(data.user.email);
            })
          });

          $('.program-choice').change(function () {
            $('#batch').empty();
            $('#batch').append('<option disabled selected hidden>Select batch</option>');
            var program_id = $(this).data('id')
            $.get("/" + program_id + "/get_batch", function (data) {
              if (data.length == 0) {
                $('#batch').append('<option disabled>No batch available</option>');
              } else {
                for (var i = 0; i < data.length; i++) {
                  if (data[i].status == 0) {
                    $('#batch').append('<option value="' + data[i].id + '" disabled>Batch ' + data[i]
                      .batch_number + ' (closed)</option>');
                  } else {
                    $('#batch').append('<option value="' + data[i].id + '">Batch ' + data[i].batch_number +
                      '</option>');
                  }
                }
              }
            });
          })

          $("#saveBtn").click(function (e) {
            e.preventDefault();
            $('#saveBtn').html('Sending..');
            $('#name-error').empty();
            $('#phone-error').empty();
            $('#email-error').empty();
            $('#roles-error').empty();
            $('#program-error').empty();
            $('#batch-error').empty();

            var data = $('#createUserForm').serialize();
            console.log(data);

            $.ajax({
              data: data,
              url: "{{ route('users.store') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {

                $('#createUserForm').trigger("reset");
                $('#saveBtn').html('Submit');
                $('#modal-user-slide-in').modal('hide');
                if ($('#action_type').val() == 'create-user') {
                  Swal.fire({
                    icon: 'success',
                    title: 'Account created successfully!',
                  });
                } else if ($('#action_type').val() == 'edit-user') {
                  Swal.fire({
                    icon: 'success',
                    title: 'Account updated successfully!',
                  });
                }
                table_coach.draw();
                table_admin.draw();
                table_coachee.draw();
                table_trainer.draw();
                table_mentor.draw();
              },
              error: function (reject) {
                $('#saveBtn').html('Submit');
                if (reject.status === 422) {
                  var errors = JSON.parse(reject.responseText);
                  if (errors.name) {
                    $('#name-error').html('<strong class="text-danger">' + errors.name[0] +
                    '</strong>'); // and so on
                  }
                  if (errors.phone) {
                    $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] +
                    '</strong>'); // and so on
                  }
                  if (errors.email) {
                    $('#email-error').html('<strong class="text-danger">' + errors.email[0] +
                    '</strong>'); // and so on
                  }
                  if (errors.roles) {
                    $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] +
                    '</strong>'); // and so on
                  }
                  if (errors.program) {
                    $('#program-error').html('<strong class="text-danger">' + errors.program[0] +
                      '</strong>'); // and so on
                  }
                  if (errors.batch) {
                    $('#batch-error').html('<strong class="text-danger">' + errors.batch[0] +
                    '</strong>'); // and so on
                  }
                }
              }
            });
            /**Ajax code ends**/
          });

          // suspend user
          $('body').on('click', '.suspendUser', function (e) {
            console.log('tes');

            let user_id = $(this).attr('data-id');

            Swal.fire({
              title: "Are you sure?",
              text: "The user you choose will be suspended!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                var data = {
                  id: user_id
                };
                console.log(data);

                $.ajax({
                  data: data,
                  type: "POST",
                  url: "{{ route('suspend_user') }}",
                  success: function (data) {
                    table_admin.draw();
                    table_coach.draw();
                    table_coachee.draw();
                    table_trainer.draw();
                    table_mentor.draw();
                  },
                  error: function (data) {
                    console.log('Error:', data);
                  }
                });
              }
            })
          });

          // unsuspend user
          $('body').on('click', '.unsuspendUser', function (e) {
            console.log('tes');

            let user_id = $(this).attr('data-id');

            Swal.fire({
              title: "Are you sure?",
              text: "The user you choose will be activated",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Sure",
              cancelButtonText: "Cancel"
            }).then((result) => {
              if (result.isConfirmed) {
                var data = {
                  id: user_id
                };
                console.log(data);

                $.ajax({
                  data: data,
                  type: "POST",
                  url: "{{ route('unsuspend_user') }}",
                  success: function (data) {
                    table_admin.draw();
                    table_coach.draw();
                    table_coachee.draw();
                    table_trainer.draw();
                    table_mentor.draw();
                  },
                  error: function (data) {
                    console.log('Error:', data);
                  }
                });
              }
            })
          });

          // delete
          $('body').on('click', '.deleteClient', function (e) {

            var Client_id = $(this).data("id");
            if (confirm("Are You sure want to delete !")) {

              $.ajax({
                type: "DELETE",
                url: "" + '/clients/' + Client_id,
                success: function (data) {
                  table.draw();
                },
                error: function (data) {
                  console.log('Error:', data);
                }
              });
            } else {
              e.preventDefault();
            }
          });

          // popover
          $(function () {
            $('[data-toggle="popover"]').popover({
              html: true,
              trigger: 'hover',
              placement: 'top',
              content: function () {
                return '<img src="' + $(this).data('img') + '" />';
              }
            })
          })

          // modal detail
          $('body').on('click', '#detailTrainer', function () {
            $('#modalHeading').html("Edit Client");
            $('#modals-slide-in').modal('show');
          })
        });
      </script>
      @endpush