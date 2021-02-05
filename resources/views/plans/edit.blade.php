@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

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
            <h2 class="content-header-title float-left mb-0">Coaching Plans</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Coaching Plans</a>
                </li>
                <li class="breadcrumb-item active">Edit Coaching Plans
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
                <h4 class="card-title">Edit Plan</h4>
              </div>
              <form action="{{url('/plans')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Full Name</label>
                      <select class="livesearch form-control" name="client_id" id="client_id" disabled>
                        <option selected hidden value="{{ $client->id }}">{{ $client->name }}</option>
                      </select>
                      <input type="hidden" name="client_id" value="{{ $client->id }}">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="fp-default">Organization</label>
                      <input class="form-control" name="organization" id="organization" disabled
                        value="{{ $client->organization }}">
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="fp-default">Tanggal Kegiatan</label>
                      <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                        value="{{ $plan->date }}" autocomplete="date" autofocus>
                      @error('date')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Objektif</label>
                      <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                        id="objective" autocomplete="objective">{{ $plan->objective }}</textarea>

                      @error('objective')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Sukses Indikator</label>
                      <textarea class="form-control @error('success_indicator') is-invalid @enderror"
                        name="success_indicator" id="success_indicator"
                        autocomplete="success_indicator">{{ $plan->success_indicator }}</textarea>

                      @error('success_indicator')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Pengembangan Area</label>
                      <textarea class="form-control @error('development_areas') is-invalid @enderror"
                        name="development_areas" id="development_areas"
                        autocomplete="development_areas">{{ $plan->development_areas }}</textarea>

                      @error('development_areas')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Support</label>
                      <textarea class="form-control @error('support') is-invalid @enderror" name="support" id="support"
                        autocomplete="support">{{ $plan->support }}</textarea>

                      @error('support')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <input type="hidden" name="id" value="{{$plan->id}}">

                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
                    value="create">Submit</button>
                </div>
              </form>
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
            <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
              placeholder="John Doe" aria-label="John Doe" />
          </div>
          <label class="form-label" for="basic-icon-default-post">Phone</label>
          <div class="input-group input-group-merge mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon5">+62</span>
            </div>
            <input id="phone" name="phone" type="text" class="form-control" placeholder="81xxxxxxx" aria-label="Phone">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('.livesearch').select2({
        placeholder: 'Select clients',
        ajax: {
            url: "{{route('clients.search')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
						console.log(item)
                        return {
                            text: item.name,
                            id: item.id,
							org: item.organization,
							pro: item.program
                        }
                    })
                };
            },
            cache: true
        }
    });

	$(".livesearch").on('change', function(e) {
    // Access to full data
    console.log($(this).select2('data'));
    console.log($(this).select2('data')[0].id);
	var dd = $(this).select2('data')[0];
	$('#organization').val(dd.org);
	$('#program').val(dd.pro);

	});

  $(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'program', name: 'program'},
            {data: 'phone', name: 'phone'},
			{
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ],
		columnDefs: [
        {
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
			render: function (data, type, full, meta) {
				var $phone = full['phone'],
					$output = '<div class="d-flex justify-content-left align-items-center"> +62' + $phone +
							  '</div>';
				return $output;
			}
		}
		],
		order: [[2, 'desc']],
		dom:
        '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		  displayLength: 7,
		  lengthMenu: [7, 10, 25, 50, 75, 100],
		  buttons: [

			{
			  text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add Client',
			  className: 'create-new btn btn-primary createNewClient',
			  attr: {
				'data-toggle': 'modal'

			  },
			  init: function (api, node, config) {
				$(node).removeClass('btn-secondary');
			  }
			}
		  ],
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
				  return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
					? '<tr data-dt-row="' +
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
						'</tr>'
					: '';
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

	// create
	$('body').on('click', '.createNewClient', function () {
		$('#saveBtn').val("create-Client");
        $('#Customer_id').val('');
        $('#ClientForm').trigger("reset");
        $('#modalHeading').html("Create New Client");
		$('#modals-slide-in').modal('show');
	});

	// edit
	$('body').on('click', '.editClient', function () {
      var Client_id = $(this).data('id');
      $.get("" +'/clients/' + Client_id +'/edit', function (data) {
          $('#modalHeading').html("Edit Client");
          $('#saveBtn').val("edit-user");
          $('#modals-slide-in').modal('show');
          $('#Client_id').val(data.id);
          $('#name').val(data.name);
          $('#phone').val(data.phone);
          $('#email').val(data.email);
          $('#company').val(data.company);
          $('#organization').val(data.organization);
          $('#occupation').val(data.occupation);
      })
	});

	// save data
	$('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#ClientForm').serialize(),
          url: "",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#ClientForm').trigger("reset");
			  $('#saveBtn').html('Submit');
              $('#modals-slide-in').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Submit');
          }
      });
    });

	// delete
	$('body').on('click', '.deleteClient', function (e) {

        var Client_id = $(this).data("id");
        if(confirm("Are You sure want to delete !")){

        $.ajax({
            type: "DELETE",
            url: ""+'/clients/'+Client_id,
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

  });


  $(function () {
        $('#datetimepicker11').datetimepicker({
          daysOfWeekDisabled: [0, 6]
        });
  });

</script>
@endpush