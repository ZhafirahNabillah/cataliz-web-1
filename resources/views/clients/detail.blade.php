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
    @role('admin')
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">User List
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Detail Group
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endrole

    @role('coachee')
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Coach List

              <img class="align-text  width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />

            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
                <li class="breadcrumb-item active">Detail Group</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endrole

    @role('coach')
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Client List
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar client yang terdaftar dalam website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item active">Detail Group
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

      <div class="card">
        <div class="card-body">
          <div class="card-header">
            <h4 class="card-title"><b>Detail Plan</b></h4>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3">
              <b>Group ID</b>
            </div>
            <div class="col-sm-9">
              #
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-3">
              <b>Number of Member</b>
            </div>
            <div class="col-sm-9">
              #
            </div>
          </div>
          <!-- Basic table -->
          <section id="basic-datatable">
            <div class="row">
              <div class="col-12">
                <div class="card">

                  <table class="datatables-basic table default-datatable-plans">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Coachee Name</th>
                        <th>Company</th>
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

      <!-- END: Content-->
      @endsection

      @push('scripts')
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
      <script>
        // function isNumberKey(evt)
        //   {
        //     var charCode = (evt.which) ? evt.which : event.keyCode
        //     if (charCode > 31 && (charCode < 48 || charCode > 57))
        //       return false;
        //
        //     return true;
        //   }

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
          var table = $('.yajra-datatable').DataTable({
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
                render: function(data, type, full, meta) {
                  var $user_img = full['avatar'],
                    $name = full['name'],
                    $post = full['company'];
                  $org = full['organization'];
                  if ($user_img) {
                    // For Avatar image
                    var $output =
                      '<img src="' + assetPath + 'images/avatars/' + $user_img + '" alt="Avatar" width="32" height="32">';
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
                render: function(data, type, full, meta) {
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
              init: function(api, node, config) {
                $(node).removeClass('btn-secondary');
              }
            }],
            @endcan
            responsive: {
              details: {
                display: $.fn.dataTable.Responsive.display.modal({
                  header: function(row) {
                    var data = row.data();
                    return 'Details of ' + data['name'];
                  }
                }),
                type: 'column',
                renderer: function(api, rowIdx, columns) {
                  var data = $.map(columns, function(col, i) {
                    console.log(columns);
                    return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
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
                defaultContent: '<i>-</i>'
              },
              {
                data: 'rating',
                name: 'rating',
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
            },
          });

          // create new user on admin page
          $('body').on('click', '.createNewUser', function() {
            console.log('tes');
            $('#action_type').val("create-user");
            $('#user_id').val('');
            $('#createUserForm').trigger("reset");
            $('#modalHeading').html("Create New User");
            $('#name').prop('readonly', false);
            $('#phone').prop('readonly', false);
            $('#email').prop('readonly', false);
            $('#name-error').empty();
            $('#phone-error').empty();
            $('#email-error').empty();
            $('#roles-error').empty();
            $('#modal-user-slide-in').modal('show');
          });

          // edit user in admin page
          $('body').on('click', '.editUser', function() {
            var user_id = $(this).data('id');
            $.get("" + '/users/' + user_id + '/edit', function(data) {
              $('#modalHeading').html("Edit User");
              $('#action_type').val("edit-user");
              $('#createUserForm').trigger("reset");
              $('#name-error').empty();
              $('#phone-error').empty();
              $('#email-error').empty();
              $('#roles-error').empty();
              $('#user_id').val(data.id);
              $('#name').val(data.name).prop('readonly', true);
              $('#phone').val(data.phone).prop('readonly', true);
              $('#email').val(data.email).prop('readonly', true);
              $.each(data.roles, function(i, item) {
                var role_name = data.roles[i].name;
                $('#permission-check-' + role_name).prop('checked', true);
              });
              $('#modal-user-slide-in').modal('show');
            })
          });

          // show detail coach on coachee page
          $('body').on('click', '.detailCoach', function() {
            var coach_id = $(this).data('id');
            $.get("" + '/users/' + coach_id + '/edit', function(data) {
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

          $("#saveBtn").click(function(e) {
            e.preventDefault();
            $('#saveBtn').html('Sending..');
            $('#name-error').empty();
            $('#phone-error').empty();
            $('#email-error').empty();
            $('#roles-error').empty();

            var data = $('#createUserForm').serialize();
            console.log(data);

            $.ajax({
              data: data,
              url: "{{ route('users.store') }}",
              type: "POST",
              dataType: 'json',
              success: function(data) {

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
              },
              error: function(reject) {
                $('#saveBtn').html('Submit');
                if (reject.status === 422) {
                  var errors = JSON.parse(reject.responseText);
                  if (errors.name) {
                    $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
                  }
                  if (errors.phone) {
                    $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
                  }
                  if (errors.email) {
                    $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
                  }
                  if (errors.roles) {
                    $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
                  }
                }
              }
            });
            /**Ajax code ends**/
          });

          // save user data on admin page
          // $('#saveBtn').click(function() {
          //   $('#createUserForm').validate({
          //     debug: false,
          //     errorClass: "error fail-alert",
          //     validClass: "valid success-alert",
          //     rules: {
          //       name: {
          //         required: true
          //       },
          //       phone: {
          //         required: true,
          //         digits: true,
          //         'phoneNumber': true
          //       },
          //       email: {
          //         required: true,
          //         email: true
          //       },
          //       roles: {
          //         required: true
          //       }
          //     },
          //     messages: {
          //       name: {
          //         required: "Name is required!"
          //       },
          //       phone: {
          //         required: "phone number is required!",
          //         digits: "phone number must be number!"
          //       },
          //       email: {
          //         required: "email is required!",
          //         email: "please provide valid email address!"
          //       },
          //       roles: {
          //         required: "role is required!"
          //       }
          //     },
          //     errorPlacement: function(error, element) {
          //       if (element.attr("name") == "name") {
          //         error.appendTo($("#name-error"));
          //       } else if (element.attr("name") == "phone") {
          //         error.appendTo("#phone-error");
          //       } else if (element.attr("name") == "email") {
          //         error.appendTo("#email-error");
          //       } else if (element.attr("name") == "roles") {
          //         error.appendTo("#roles-error");
          //       }
          //     },
          //
          //     //submit Handler
          //     submitHandler: function(form) {
          //       $('#saveBtn').html('Sending..');
          //       var data = $('#createUserForm').serialize();
          //       console.log(data);
          //
          //       $.ajax({
          //         data: data,
          //         url: "{{ route('users.store') }}",
          //         type: "POST",
          //         dataType: 'json',
          //         success: function(data) {
          //
          //           $('#createUserForm').trigger("reset");
          //           $('#saveBtn').html('Submit');
          //           $('#modal-user-slide-in').modal('hide');
          //           if ($('#saveBtn').val() == 'create-user') {
          //             Swal.fire({
          //               icon: 'success',
          //               title: 'Account created successfully!',
          //             });
          //           } else if ($('#saveBtn').val() == 'edit-user') {
          //             Swal.fire({
          //               icon: 'success',
          //               title: 'Account updated successfully!',
          //             });
          //           }
          //           table_coach.draw();
          //           table_admin.draw();
          //           table_coachee.draw();
          //         },
          //         error: function(data) {
          //           console.log('Error:', data);
          //           $('#saveBtn').html('Submit');
          //         }
          //       });
          //       return false;
          //     }
          //   });
          // });

          // suspend user
          $('body').on('click', '.suspendUser', function(e) {
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
                  success: function(data) {
                    table_admin.draw();
                    table_coach.draw();
                    table_coachee.draw();
                  },
                  error: function(data) {
                    console.log('Error:', data);
                  }
                });
              }
            })
          });

          // unsuspend user
          $('body').on('click', '.unsuspendUser', function(e) {
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
                  success: function(data) {
                    table_admin.draw();
                    table_coach.draw();
                    table_coachee.draw();
                  },
                  error: function(data) {
                    console.log('Error:', data);
                  }
                });
              }
            })
          });

          // delete
          $('body').on('click', '.deleteClient', function(e) {

            var Client_id = $(this).data("id");
            if (confirm("Are You sure want to delete !")) {

              $.ajax({
                type: "DELETE",
                url: "" + '/clients/' + Client_id,
                success: function(data) {
                  table.draw();
                },
                error: function(data) {
                  console.log('Error:', data);
                }
              });
            } else {
              e.preventDefault();
            }
          });

          // popover
          $(function() {
            $('[data-toggle="popover"]').popover()
          })

        });
      </script>
      @endpush