@extends('layouts.layoutVerticalMenu')

@section('title','Class')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

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
            <h2 class="content-header-title float-left mb-0">Class List</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('class.index')}}">Class List</a>
                </li>
                <li class="breadcrumb-item active">Detail Class
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

      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><b>Detail Class</b></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <dt class="col-sm-3"><b>Class Name</b></dt>
                  <dt class="col-sm-9"><b>{{ $class->class_name }}</b></dt>
                </div>
                <div class="row mt-1">
                  <dt class="col-sm-3"><b>Coach Name</b></dt>
                  <dt class="col-sm-9"><b>{{ $class->coach->name }}</b></dt>
                </div>

                <form action="{{route('class.ubah_status',$class->id)}}" method="post">
                  @csrf
                  @if ($class->status == 'Sedang Berjalan')
                  <div class="row align-items-center mt-1">
                    <dt class="col-sm-3"><b>Status</b></dt>
                    <dt class="col-sm-9 form-group">
                      <select class="form-control" id="media1" aria-label=".form-select-lg example" name="status">
                        <option selected value="Dibatalkan" id="Dibatalkan" @if($class->status == 'Dibatalkan')
                          @endif>Dibatalkan</option>
                        <option selected value="Sedang Berjalan" id="Sedang Berjalan" @if($class->status == 'Sedang
                          Berjalan')
                          @endif>Sedang Berjalan
                        </option>
                      </select>
                    </dt>
                  </div>
                  <div class="row align-items-center media_url1" style="display: none">
                    <dt class="col-sm-3"><b>Notes</b></dt>
                    <dt class="col-sm-9 form-group">
                      <input type="text" class="form-control" name="notes" placeholder="Masukkan notes...">
                    </dt>
                  </div>
                  
                  <div class="row align-items-center mb-2">
                    <dt class="col-sm-3"> </dt>
                    <dt class="col-sm-9">
                      <button type="submit" class="btn btn-primary">Ubah Status</button>
                    </dt>
                  </div>
                  @else
                  <div class="row align-items-center mt-1">
                    <dt class="col-sm-3"><b>Status</b></dt>
                    <dt class="col-sm-9 form-group">
                      <select class="form-control" id="media2" aria-label=".form-select-lg example" name="status"
                        disabled>
                        <option selected value="Sedang Berjalan" id="Sedang Berjalan" @if($class->status == 'Sedang
                          Berjalan')@endif>Sedang Berjalan</option>
                        <option selected value="Dibatalkan" id="Dibatalkan" @if($class->status ==
                          'Dibatalkan')@endif>Dibatalkan</option>
                      </select>
                    </dt>
                  </div>
                  <div class="row align-items-center media_url2">
                    <dt class="col-sm-3"><b>Notes</b></dt>
                    <dt class="col-sm-9 form-group">
                      <input type="text" class="form-control" name="notes" placeholder="Masukkan notes..." disabled
                        value="{{$class->notes}}">
                    </dt>
                  </div>
                  @endif
                </form>
                <hr>

                <!-- Basic table -->
                <section id="basic-datatable">
                  <div class="row">
                    <div class="col-12">
                      <div class="card style=" border-radius: 15px;>
                        <table class="datatables-basic table yajra-datatable-class">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Coachee Name</th>
                              {{-- <th>Session</th> --}}
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

    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
      <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0" id="ClientForm" name="ClientForm">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="modalHeading"></h5>
          </div>
          <input type="hidden" name="Client_id" id="Client_id">
          <div class="modal-body flex-grow-1">
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input id="name" name="name" type="text" class="form-control dt-full-name"
                id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
            </div>
            <label class="form-label" for="basic-icon-default-post">Phone</label>
            <div class="input-group input-group-merge mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon5">+62</span>
              </div>
              <input id="phone" name="phone" type="text" class="form-control" placeholder="81xxxxxxx"
                aria-label="Phone">
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-email">Email</label>
              <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email"
                placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
              <small class="form-text text-muted"> You can use letters, numbers & periods </small>
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Organization</label>
              <input id="organization" name="organization" type="text" class="form-control dt-full-name"
                id="basic-icon-default-fullname" placeholder="Inbis Sample" aria-label="John Doe" />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Company</label>
              <input id="company" name="company" type="text" class="form-control dt-full-name"
                id="basic-icon-default-fullname" placeholder="Startup Name" aria-label="John Doe" />
            </div>
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Occupation</label>
              <input id="occupation" name="occupation" type="text" class="form-control dt-full-name"
                id="basic-icon-default-fullname" placeholder="CEO" aria-label="John Doe" />
            </div>

            <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
          <!-- </form>-->

      </div>
    </div>
    <!-- End Modal -->
    </section>
    <!--/ Basic table -->



  </div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script type="text/javascript">
  $(function() {

  $(document).ready(function () {
    $("#media1").on('change', function () {
        $(".media_url1").toggle(500);
    });
  });

  $(document).ready(function () {
    $("#media2").on('change', function () {
        $(".media_url2").toggle(500);
    });
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var table = $('.yajra-datatable-class').DataTable({
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
});
</script>
@endpush