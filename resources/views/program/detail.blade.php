@extends('layouts.layoutVerticalMenu')

@section('title','Class')

@push('styles')

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <h2 class="content-header-title float-left mb-0">Program List</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('program.index')}}">Program List</a>
                </li>
                <li class="breadcrumb-item active">Detail Program
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
                <h4 class="card-title"><b>Detail Program</b></h4>
              </div>
              <div class="card-body">
                {{-- <div class="row">
                  <dt class="col-sm-3"><b>Class Name</b></dt>
                  <dt class="col-sm-9"><b>{{ $class->class_name }}</b></dt>
              </div> --}}
              <div class="row mt-1">
                <dt class="col-sm-3"><b>Program Name</b></dt>
                {{-- <dt class="col-sm-9"><b>{{ $class->coach->name }}</b></dt> --}}
                <dt class="col-sm-9"><b>{{ $program->program_name }}</b></dt>
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
                  <input type="text" class="form-control @error('notes') is-invalid @enderror" name="notes"
                    placeholder="Masukkan notes...">
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
                    <option selected value="Finished" id="Finished" @if($class->status == 'Finished')@endif>Finished
                    </option>
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
                  <input type="text" class="form-control" name="notes" placeholder="Write note here..." disabled
                    value="{{$class->notes}}">
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
                    <option selected value="Finished" id="Finished" @if($class->status == 'Finished')@endif>Finished
                    </option>
                  </select>
                </dt>
              </div>
              <div class="row align-items-center media_url3">
                <dt class="col-sm-3"><b>Notes</b></dt>
                <dt class="col-sm-9 form-group">
                  <input type="text" class="form-control" name="notes" placeholder="Write note here..." disabled
                    value="{{$class->notes}}">
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
                      <button type="button" name="button" class="btn btn-primary" id="addBatchBtn"
                        data-id="{{ $program->id }}">+ Add Batch</button>
                    </div>
                    <hr>
                    <div class="card style=" border-radius: 15px;>
                      <table class="datatables-basic table yajra-datatable-batch">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Batch Number</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
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

  <div class="modal fade" id="add-batch-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalHeading">Add Batch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="card-body" style="border-radius: 11px">
                <form id="addBatchForm">
                  <input type="hidden" name="program_id" value="{{ $program->id }}">
                  <input type="hidden" name="batch_id" value="" id="batch_id">
                  <div class="form-group">
                    <label for="fp-default">Batch Number</label>
                    <input type="text" class="form-control" name="batch_number" value="" id="batch_number" readonly>
                  </div>
                  <div class="form-group">
                    <label for="fp-default">Start Date</label>
                    <input type="date" id="start_date" class="form-control" name="start_date" value="">
                  </div>
                  <div class="form-group">
                    <label for="fp-default">End Date</label>
                    <input type="date" id="end_date" class="form-control" name="end_date" value="">
                  </div>
                  <button id="saveBatchBtn" type="button" name="button" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
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
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table = $('.yajra-datatable-batch').DataTable({
      processing: true,
      serverSide: true,
      ajax: "",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'batch_number',
          name: 'batch_number'
        },
        {
          data: 'start_date',
          name: 'start_date'
        },
        {
          data: 'end_date',
          name: 'end_date'
        },
        {
          data: 'action',
          name: 'action'
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


    $('body').on('click', '#addBatchBtn', function() {
      $('#addBatchForm').trigger("reset");
      $('#batch_id').val('');
      //get maximum batch number
      program_id = {{ $program->id }};
      console.log(program_id);
      $.get("/"+ program_id +"/batch_max" , function( data ) {
        $('#batch_number').val(data + 1);
        console.log(data);
      });

      $('#saveBatchBtn').val("add-batch");
      $('#add-batch-modal').modal('show');
			// $.get("" + '/class/' + coach_id + '/edit', function(data) {
      //   // console.log(data[0].name);
      //   $('#coach_id').val(coach_id);
			// 	$.each(data, function(i, item) {
			// 		var client_id = data[i].id;
			// 		$('#client-' + client_id).prop('selected', true);
			// 	});
			// });
		});

    $('body').on('click', '#updateBatchBtn', function() {

      //get maximum batch number
      // $.get("/batch_max" , function( data ) {
      //   $('#batch_number').val(data + 1);
      // });

      $('#saveBatchBtn').val("update-batch");
      $('#add-batch-modal').modal('show');
      batch_id = $(this).data('id');
			$.get('/batch/' + batch_id, function(data) {
        $('#batch_id').val(data.id);
        $('#batch_number').val(data.batch_number);
        $('#start_date').val(data.start_date);
        $('#end_date').val(data.end_date);
			});
		});

    // $("#state").select2({
    //     // tags: true,
    //     placeholder: 'Select users',
    //     ajax: {
    //       url: "{{route('coachee.search')}}",
    //       dataType: 'json',
    //       delay: 250,
    //       data: function (params) {
    //           return {
    //               q: $.trim(params.term),
    //               coach_id : $('#addClient').data('id')
    //           };
    //       },
    //       processResults: function(data) {
    //         return {
    //           results: $.map(data, function(item) {
    //             console.log(item)
    //             return {
    //               id: item.id,
    //               text: item.name,
    //             }
    //           })
    //         };
    //       },
    //       cache: true
    //     }
    //   });

    $('#saveBatchBtn').click(function(e) {
      e.preventDefault();
      $('#saveBatchBtn').html('Sending..');
      var data = $('#addBatchForm').serialize();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('batch.store') }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#addBatchForm').trigger("reset");
          $('#saveBatchBtn').html('Submit');
          $('#add-batch-modal').modal('hide');

          if ($('#saveBatchBtn').val() == 'add-batch') {
            Swal.fire({
              icon: 'success',
              title: 'Batch created successfully!',
            });
          } else if ($('#saveBatchBtn').val() == 'update-batch') {
            Swal.fire({
              icon: 'success',
              title: 'Batch updated successfully!',
            });
          }

          table.draw();
        },
        error: function(data) {
          console.log('Error:', data);
          $('#saveBatchBtn').html('Submit');
        }
      });
      return false;
    });

    // $('#removeBtn').click(function(e) {
    //   var client_id = $(this).data("id");
		// 	console.log(client_id);
    // });

    $('body').on('click', '#deleteBatchBtn', function(e) {

			var batch_id = $(this).data("id");

			Swal.fire({
				title: "Are you sure?",
				text: "You'll remove this batch!",
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
						url: "/batch/"+batch_id,
						success: function(data) {
							Swal.fire({
								icon: 'success',
								title: 'Removed Successfully!',
							});
							table.draw();
						},
						error: function(data) {
							console.log('Error:', data);
						}
					});
				}
			})
		});

    // $('#search').keyup(function(){
    //   var search_value = new RegExp($(this).val(), 'i');
    //   $(".client-list label").each(function() {
    //     if(!search_value.test($(this).text())) {
    //       $(this).parent().hide();
    //     } else {
    //       $(this).parent().show();
    //     }
    //   });
	  // });
  });
</script>
@endpush
