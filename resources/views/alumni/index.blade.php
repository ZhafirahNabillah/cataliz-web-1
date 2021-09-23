@extends('layouts.layoutVerticalMenu')

@section('title','Alumni')

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
            <h2 class="content-header-title float-left mb-0">Graduate List
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan daftar role yang dapat mengakses website." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Graduate
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
          @can('create-plan')
         @role('admin')
          <button type="button" name="button" class="btn btn-primary" id="addAlumni" data-id="">+ Add Graduate</button>
          @endrole
          @endcan
        </div>

      </div>
      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card style=" border-radius: 15px;>
              <table class="datatables-basic table datatable-graduates">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Certificate Number</th>
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
                <h5 class="modal-title" id="modalHeading">Add Graduate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="card-body" style="border-radius: 11px">
                      <form id="addGraduateForm">
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group">
                          <label class="fp-default" for="basic-icon-default-fullname">Name</label>
                          <select id="state" class="livesearch-graduates form-control @error('graduates') is-invalid @enderror" name="name"></select>
                          <div id="graduate-error"></div>
                        </div>
                        <input type="hidden" name="batch_id" id="batch_id" value="">
                        {{-- <div class="form-group">
                          <label for="graduate_as">Graduate as</label>
                          <select class="form-control" name="graduate_as" id="graduate_as">
                            <option hidden disabled selected>Select Graduate As</option>
                            <option value="1">SCP</option>
                            <option value="2">SSCP</option>
                          </select>
                          <div id="graduate_as-error"></div>
                        </div> --}}
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

        <!-- Modal to create certificate -->
        <div class="modal fade" id="certificate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHeading">Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="card-body" style="border-radius: 11px">
                      <form id="certificateForm">
                        <input type="hidden" name="graduate_id" id="graduate_id" value="">
                        <div class="form-group">
                          <label for="fp-default">Certificate Number</label>
                          <input class="form-control" type="text" value="" name="certificate_number" id="certificate_number" placeholder="Certificate Number here...">
                          <div id="certificate-number-error"></div>
                        </div>
                        <button id="downloadCertificate" type="button" name="button" class="btn btn-primary">Download</button>
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
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.livesearch-graduates').select2({
      placeholder: 'Select Graduates',
      ajax: {
        url: "{{route('graduates.search_clients')}}",
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              console.log(item)
              return {
                text: item.name +'  ('+ item.batch.program.program_name +' - Batch'+ item.batch.batch_number + ')',
                id: item.id,
                batch_id: item.batch.id
              }
            })
          };
        },
      }
    });

    $(".livesearch-graduates").on('change', function(e) {
      // Access to full data
      var selected_data = $(this).select2('data')[0];
      console.log(selected_data);
      $('#batch_id').val(selected_data.batch_id);
      // if (dd.client_id != null) {
      //   $(".group_id_wrapper").hide();
      //   $.get("" + '/get_client_data/' + dd.client_id, function(data) {
      //     $("#client_name").val(data.name);
      //     $("#client_organization").val(data.organization);
      //     $("#client_company").val(data.company);
      //   });
      //   $(".client_data_wrapper").show();
      // } else if (dd.group_id != null) {
      //   $(".client_data_wrapper").hide();
      //   $(".group_id_wrapper").show();
      //   $("#group_id").val(dd.group_id);
      // }
    });

    var graduates_table = $('.datatable-graduates').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('graduates.load_graduates_data') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'user_data.name',
          name: 'user_data.name'
        },
        {
          data: 'certificate_number',
          name: 'certificate_number',
          render: function (data) {
            if (data == 0) {
              return '-';
            } else {
              return data;
            }
          }
        },
        {
          data: 'program',
          name: 'program',
          // render: function (data, type, row) {
          //   if (row.graduate_as == 1) {
          //     return data + ' SCP';
          //   } else if (row.graduate_as == 2) {
          //     return data + ' SSCP';
          //   }
          // }
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
        // render: '<i data-feather="search"></i>',
        // search: '<i data-feather="search"/>',
        searchPlaceholder: "Search records"
      }
    });

    $('body').on('click', '#addAlumni', function() {
      // console.log('tes');
      // var coach_id = $(this).data('id');
      // $('#saveBtn').val("add-alumni");
      // $("#state").val(null).trigger('change');
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

    $('body').on('click', '#createCertificateBtn', function() {
      // console.log('tes');
      $('#downloadCertificate').html('Download');
      $('#certificate-number-error').empty();
      $('#certificateForm').trigger("reset");
      var graduate_id = $(this).data('id');
      // $('#saveBtn').val("add-alumni");
      // $("#state").val(null).trigger('change');
      $('#certificate-modal').modal('show');
      $('#graduate_id').val(graduate_id)
      $.get('/graduates/' + graduate_id + '/edit', function(data) {
        // console.log(data[0].name);
        if (data.certificate_number != 0) {
          $('#certificate_number').val(data.certificate_number);
        }
      });
    });

    $('#saveBtn').click(function(e) {
      e.preventDefault();
      $('#saveBtn').html('Sending..');
      var data = $('#addGraduateForm').serialize();
      $('#graduate-error').empty();
      // $('#graduate_as-error').empty();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('graduates.store') }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#addGraduateForm').trigger("reset");
          $('#saveBtn').html('Submit');
          $('#add-alumni-modal').modal('hide');
          Swal.fire({
              icon: 'success',
              title: 'Graduates added!',
          });
          graduates_table.draw();
          $('.livesearch-graduates').val('').trigger("change");
        },
        error: function(reject, data) {
          console.log('Error:', data);
          $('#saveBtn').html('Submit');
          if (reject.status === 422) {
            var errors = JSON.parse(reject.responseText);
            if (errors.name) {
              $('#graduate-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
            }
            // if (errors.graduate_as) {
            //   $('#graduate_as-error').html('<strong class="text-danger">' + errors.graduate_as[0] + '</strong>'); // and so on
            // }
          }
        }
      });
      return false;
    });

    $('#downloadCertificate').click(function(e) {
      e.preventDefault();
      $(this).html('Creating..');
      var data = $('#certificateForm').serialize();
      $('#certificate-number-error').empty();
      console.log(data);

      $.ajax({
        data: data,
        url: "{{ route('graduates.store_certificate_data') }}",
        type: "POST",
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#certificateForm').trigger("reset");
          $(this).html('Download');
          $('#cerificate-modal').modal('hide');
          window.open(data, "_blank");
        },
        error: function(reject, data) {
          console.log('Error:', data);
          $(this).html('Download');
          if (reject.status === 422) {
            var errors = JSON.parse(reject.responseText);
            if (errors.certificate_number) {
              $('#certificate-number-error').html('<strong class="text-danger">' + errors.certificate_number[0] + '</strong>'); // and so on
            }
            // if (errors.graduate_as) {
            //   $('#graduate_as-error').html('<strong class="text-danger">' + errors.graduate_as[0] + '</strong>'); // and so on
            // }
          }
        }
      });
      return false;
    });

    $('body').on('click', '#removeGraduateBtn', function(e) {

			var graduate_id = $(this).data("id");
			console.log(graduate_id);

			Swal.fire({
				title: "Are you sure?",
				text: "You'll remove this client from graduates",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Sure",
				cancelButtonText: "Cancel"
			}).then((result) => {
				if (result.isConfirmed) {

					// $.ajaxSetup({
					// 	headers: {
					// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					// 	}
					// });

					// $.ajax({
          //   data: {client_id: client_id},
					// 	type: "POST",
					// 	url: "",
					// 	success: function(data) {
					// 		Swal.fire({
					// 			icon: 'success',
					// 			title: 'Removed Successfully!',
					// 		});
					// 		graduates_table.draw();
					// 	},
					// 	error: function(data) {
					// 		console.log('Error:', data);
					// 	}
					// });

          $.ajax({
            type: "DELETE",
            url: "" + '/graduates/' + graduate_id,
            success: function(data) {
              Swal.fire({
								icon: 'success',
								title: 'Removed Successfully!',
							});
              graduates_table.draw();
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
				}
			});
		});
  });
</script>
@endpush
