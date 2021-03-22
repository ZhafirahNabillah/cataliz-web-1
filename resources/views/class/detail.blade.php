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
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
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
                {{-- <div class="row">
                  <dt class="col-sm-3"><b>Class Name</b></dt>
                  <dt class="col-sm-9"><b>{{ $class->class_name }}</b></dt>
                </div> --}}
                <div class="row mt-1">
                  <dt class="col-sm-3"><b>Coach Name</b></dt>
                  {{-- <dt class="col-sm-9"><b>{{ $class->coach->name }}</b></dt> --}}
                  <dt class="col-sm-9"><b>{{ $coach->user->name }}</b></dt>
                </div>

                {{-- <form action="{{route('class.ubah_status',$class->id)}}" method="post">
                  @csrf
                  @if ($class->status == 'On-Going')
                  <div class="row align-items-center mt-1">
                    <dt class="col-sm-3"><b>Status</b></dt>
                    <dt class="col-sm-9 form-group">
                      @role('admin')
                      <select class="form-control" id="media1" aria-label=".form-select-lg example" name="status">
                        <option value="Cancelled" id="Cancelled" @if($class->status == 'Cancelled')
                          @endif>Cancelled</option>
                          <option value="Finished" id="Finished" @if($class->status == 'Finished')
                            @endif>Finished
                          </option>
                        <option selected disabled value="On-Going" id="On-Going" @if($class->status == 'On-Going')
                          @endif>On-Going
                        </option>
                      </select>
                      @else
                      <b>{{ $class->status }}</b>
                      @endrole
                    </dt>
                  </div>
                  @role('admin')
                  <div class="row align-items-center media_url1" style="display: none">
                    <dt class="col-sm-3"><b>Notes</b></dt>
                    <dt class="col-sm-9 form-group">
                      <input type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" placeholder="Masukkan notes...">
                      @error('notes')
                        <strong class="text-danger">{{ $message }}</strong>
                      @enderror
                    </dt>
                  </div>
                  <div class="row align-items-center">
                    <dt class="col-sm-3"></dt>
                    <dt class="col-sm-9">
                      <p>*<i>You cannot restore the status if you have changed it</i></p>
                    </dt>
                  </div>
                  <div class="row align-items-center mb-2">
                    <dt class="col-sm-3"> </dt>
                    <dt class="col-sm-9">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </dt>
                  </div>
                  @endrole
                  @elseif($class->status == 'Cancelled')
                  <div class="row align-items-center mt-1">
                    <dt class="col-sm-3"><b>Status</b></dt>
                    <dt class="col-sm-9 form-group">
                      <select class="form-control" id="media2" aria-label=".form-select-lg example" name="status" disabled>
                        <option selected value="Finished" id="Finished" @if($class->status == 'Finished')@endif>Finished</option>
                        <option selected value="On-Going" id="On-Going" @if($class->status == 'On-Going')@endif>On-Going
                        </option>
                        <option selected value="Cancelled" id="Cancelled" @if($class->status ==
                          'Cancelled')@endif>Cancelled</option>
                      </select>
                    </dt>
                  </div>
                  <div class="row align-items-center media_url2">
                    <dt class="col-sm-3"><b>Notes</b></dt>
                    <dt class="col-sm-9 form-group">
                      <input type="text" class="form-control" name="notes" placeholder="Write note here..." disabled value="{{$class->notes}}">
                    </dt>
                  </div>
                  @else
                  <div class="row align-items-center mt-1">
                    <dt class="col-sm-3"><b>Status</b></dt>
                    <dt class="col-sm-9 form-group">
                      <select class="form-control" id="media3" aria-label=".form-select-lg example" name="status" disabled>
                        <option selected value="On-Going" id="On-Going" @if($class->status == 'On-Going')@endif>On-Going
                        </option>
                        <option selected value="Cancelled" id="Cancelled" @if($class->status ==
                          'Cancelled')@endif>Cancelled</option>
                        <option selected value="Finished" id="Finished" @if($class->status == 'Finished')@endif>Finished</option>
                      </select>
                    </dt>
                  </div>
                  <div class="row align-items-center media_url3">
                    <dt class="col-sm-3"><b>Notes</b></dt>
                    <dt class="col-sm-9 form-group">
                      <input type="text" class="form-control" name="notes" placeholder="Write note here..." disabled value="{{$class->notes}}">
                    </dt>
                  </div>
                  @endif
                </form> --}}
                <hr>

                <!-- Basic table -->
                <section id="basic-datatable">
                  <div class="row">
                    <div class="col-12">
                      <div class="d-block text-right">
                        <button type="button" name="button" class="btn btn-primary" id="addClient" data-id="{{ $coach->id }}">+ Add Client</button>
                      </div>
                      <hr>
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
    </section>
    <!--/ Basic table -->

    <div class="modal modal-slide-in fade" id="modals-slide-in" aria-hidden="true">
      <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0" id="addClientForm" name="addClientForm">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="modalHeading"></h5>
          </div>
          <input type="hidden" name="coach_id" id="coach_id">
          <div class="modal-body flex-grow-1">
            {{-- <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
              <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
              <div id="name-error"></div>
            </div> --}}
            <div class="form-group">
              <label class="form-label" for="basic-icon-default-fullname">Client list</label>
              <input id="search" type="text" class="form-control" placeholder="Search client name..."/>
              @foreach($clients as $client)
              <div class="form-check client-list">
                <input class="form-check-input" type="checkbox" value="{{$client->id}}" name="client[]" id="client-check-{{$client->id}}">
                <label class="form-check-label" for="client-check-{{$client->id}}">{{$client->name}}</label>
              </div>
              @endforeach
              <div id="permissions-error"></div>
            </div>
            <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
          <!-- </form>-->
      </div>
    </div>


  </div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(function() {
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

    $('body').on('click', '#addClient', function() {
			console.log('tes');
			var coach_id = $(this).data('id');
			$.get("" + '/class/' + coach_id + '/edit', function(data) {
        // console.log(data[0].name);
				$('#modalHeading').html("Edit Class Client");
				$('#saveBtn').val("edit-class");
				$('#addClientForm').trigger("reset");
				$('#modals-slide-in').modal('show');
        $('#coach_id').val(coach_id);
				$.each(data, function(i, item) {
					var client_id = data[i].id;
					$('#client-check-' + client_id).prop('checked', true);
				});
			});
		});

    $('#saveBtn').click(function(e) {
      e.preventDefault();
      $('#saveBtn').html('Sending..');
      var data = $('#addClientForm').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('class.store') }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {

          $('#addClientForm').trigger("reset");
          $('#saveBtn').html('Submit');
          $('#modals-slide-in').modal('hide');
          Swal.fire({
              icon: 'success',
              title: 'Client added!',
          });
          table.draw();
        },
        error: function(data) {
          console.log('Error:', data);
          $('#saveBtn').html('Submit');
        }
      });
      return false;
    });

    $('#search').keyup(function(){
      var search_value = new RegExp($(this).val(), 'i');
      $(".client-list label").each(function() {
        if(!search_value.test($(this).text())) {
          $(this).parent().hide();
        } else {
          $(this).parent().show();
        }
      });
	  });
  });
</script>
@endpush
