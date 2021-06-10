@extends('layouts.layoutVerticalMenu')

@section('title','Alumni')

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
            <h2 class="content-header-title float-left mb-0">Alumni List
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar role yang dapat mengakses website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Alumni
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
      <div class="row">

        <div class="col-12 mb-1">
          <button type="button" name="button" class="btn btn-primary" id="addAlumni" data-id="">+ Add Alumni</button>
        </div>

      </div>
      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card style=" border-radius: 15px;>
              <table class="datatables-basic table ">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Alumni Name</th>
                    <th>Program</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Modal to add new record -->
        <div class="modal fade" id="add-alumni-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHeading">Add Alumni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="card-body" style="border-radius: 11px">
                      <form id="addClientForm">
                        <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                        <div class="form-group">
                          <label class="fp-default" for="basic-icon-default-fullname">Alumni Name</label>
                          <select id="state" class="livesearch-plans form-control @error('client') is-invalid @enderror" name="client[]" multiple></select>
                          @error('')
                          <strong class="text-danger">{{ $message }}</strong>
                          @enderror
                        </div>
                        <button id="saveBtn" type="button" name="button" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<style>
  label.error.fail-alert {
    color: red;
  }
</style>
<script type="text/javascript">
  $(function() {
    // popover
    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'hover',
      placement: 'top',
      content: function() {
        return '<img src="' + $(this).data('img') + '" />';
      }
    })

    $('body').on('click', '#addClient', function() {
      console.log('tes');
      var coach_id = $(this).data('id');
      $('#saveBtn').val("add-alumni");
      $("#state").val(null).trigger('change');
      $('#add-alumni-modal').modal('show');
      // $.get("" + '/class/' + coach_id + '/edit', function(data) {
      //   // console.log(data[0].name);
      //   $('#coach_id').val(coach_id);
      // 	$.each(data, function(i, item) {
      // 		var client_id = data[i].id;
      // 		$('#client-' + client_id).prop('selected', true);
      // 	});
      // });
    });

  });
</script>
@endpush