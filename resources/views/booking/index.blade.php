@extends('layouts.layoutVerticalMenu')

@section('title','Booking Demo')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<!-- <link href="assets/dataTables/datatables.min.css" rel="stylesheet"> -->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Booking Demo
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar pengguna yang terdaftar dalam website baik coach maupun coachee." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Booking Demo
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <img class="img-fluid" src=" {{asset('assets\images\icons\user\banner.png')}}" alt="Card image cap" />
    <div class="">
      <button style="margin-top: 10px;margin-bottom: 10px;" type="submit" class="btn btn-primary data-submit mr-1 createNewBooking">Add New</button>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="tab-content">
          <div class="content-body">
            <!-- Basic table -->
            <section id="basic-datatable">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <table class="datatables-basic table-striped table logadmin-datatable" id="datatables">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>NAME</th>
                          <th>E-MAIL</th>
                          <th>NO HANDPHONE</th>
                          <th>STATUS</th>
                          <th>ACTION</th>
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
  <!-- END: Content-->

  <!-- Modal to Add User -->
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
            <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="" placeholder="Full name here..." />
            <div id="name-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-post">Phone</label>
            <div class="input-group input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon5">+62</span>
              </div>
              <input id="phone" name="phone" type="text" onkeypress="return isNumberKey(event)" class="form-control" value="" placeholder="Phone number here...">
            </div>
            <div id="phone-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-email">Email</label>
            <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="Email here..." />
            <small class="form-text text-muted"> You can use letters, numbers & periods</small>
            <div id="email-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-agency">Instansi</label>
            <input id="agency" name="agency" type="text" class="form-control dt-agency" id="basic-icon-default-agency" value="" placeholder="" />
            <div id="agency-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-job">Pekerjaan</label>
            <input id="job" name="job" type="text" class="form-control dt-job" id="basic-icon-default-job" value="" placeholder="" />
            <div id="job-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-address">Alamat</label>
            <input id="address" name="address" type="text" class="form-control dt-address" id="basic-icon-default-address" value="" placeholder="" />
            <div id="address-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-goals">Goal yang ingin dicapai</label>
            <textarea class="form-control dt-goals" name="goals" id="goals" cols="30" rows="5"></textarea>
            <div id="goals-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-program">Pilih Program</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="program" id="permission-check-starco">
              <label class="form-check-label" for="permission-check-starco">
                STARCO (Startup Coaching)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="program" id="permission-check-scmp">
              <label class="form-check-label" for="permission-check-scmp">
                SCMP (Startup Coaching Mentoring Program)
              </label>
            </div>
            <div id="program-error"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-session">Silahkan Piih Sesi</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="session" id="permission-check-coaching">
              <label class="form-check-label" for="permission-check-coaching">
                Coaching 400.000/sesi
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="session" id="permission-check-training">
              <label class="form-check-label" for="permission-check-training">
                Training 300.000/sesi
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="session" id="permission-check-mentoring">
              <label class="form-check-label" for="permission-check-mentoring">
                Mentoring 300.000/sesi
              </label>
            </div>
            <div id="session-error"></div>
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
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

  <script type="text/javascript">
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

      var table_log = $('.logadmin-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('booking.index') }}",
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
            data: 'whatsapp_number',
            name: 'whatsapp_number'
          },
          {
            data: 'status',
            name: 'status'
          },
          {
            data: 'price',
            name: 'price'
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

      $(document).ready(function() {

        moment.updateLocale(moment.locale(), {
          invalidDate: "Invalid Date Example"
        });

        var table = $('#datatables').DataTable({
          columnDefs: [{
            targets: 4,
            render: $.fn.dataTable.render.moment('DD/MM/YYYY')
          }]
        });
      });

    });
  </script>

  @endpush