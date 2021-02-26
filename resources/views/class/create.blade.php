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
                <li class="breadcrumb-item active">Create New Class
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
                <h4 class="card-title">Create a New Class</h4>
              </div>
              <form action="{{route('class.store')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class=" col-md-12 form-group">
                      <label for="fp-default">Class Name</label>
                      <input class="form-control" name="class_name" id="class_name">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Coach Name</label>
                      <select class="livesearch form-control @error('livesearch') is-invalid @enderror" name="coach_id"
                        id="livesearch" value="{{ old('livesearch') }}" autocomplete="livesearch">
                      </select>
                      @error('livesearch')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="fp-default" for="basic-icon-default-fullname">Partisipant</label>
                    <!-- nanti di checklist coachee yang masuk ke kelas ininya -->
                    @foreach($client as $cl)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{$cl->id}}" name="cl[]"
                        id="permission-check-{{$cl->id}}">
                      <label class="form-check-label" for="permission-check-{{$cl->id}}">
                        {{$cl->name}}
                      </label>
                    </div>
                    @endforeach
                  </div>
                  <!-- tambah sweet alert ('Added Successfully') -->
                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn"
                    value="create">Submit</button>
                  <button type="submit" class="btn btn-light  mr-1" id="cancel" value="">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
  </section>
  <!--/ Basic table -->



</div>

<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('.livesearch').select2({
    placeholder: 'Select coachs',
    ajax: {
        url: "{{route('coachs.search')}}",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
				          console.log(item)
                  return {
                    text: item.name,
                    id: item.id,
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
	});

  $(function() {

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
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [

        {
          text: feather.icons['plus'].toSvg({
            class: 'mr-50 font-small-4'
          }) + 'Add Client',
          className: 'create-new btn btn-primary createNewClient',
          attr: {
            'data-toggle': 'modal'

          },
          init: function(api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
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

    // create
    $('body').on('click', '.createNewClient', function() {
      $('#saveBtn').val("create-Client");
      $('#Customer_id').val('');
      $('#ClientForm').trigger("reset");
      $('#modalHeading').html("Create New Client");
      $('#modals-slide-in').modal('show');
    });

    // edit
    $('body').on('click', '.editClient', function() {
      var Client_id = $(this).data('id');
      $.get("" + '/clients/' + Client_id + '/edit', function(data) {
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
    $('#saveBtn').click(function(e) {
      e.preventDefault();
      $(this).html('Sending..');

      $.ajax({
        data: $('#ClientForm').serialize(),
        url: "",
        type: "POST",
        dataType: 'json',
        success: function(data) {

          $('#ClientForm').trigger("reset");
          $('#saveBtn').html('Submit');
          $('#modals-slide-in').modal('hide');
          table.draw();

        },
        error: function(data) {
          console.log('Error:', data);
          $('#saveBtn').html('Submit');
        }
      });
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

  });


  $(function() {
    $('#datetimepicker11').datetimepicker({
      daysOfWeekDisabled: [0, 6]
    });
  });
</script>
@endpush