@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

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
                        <h2 class="content-header-title float-left mb-0">Coaching Plans
                            <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada bagian ini ditampilkan daftar rencana dari coach yang ada dalam sistem." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Coaching Plans
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#coach" aria-controls="coach" role="tab" aria-selected="true">Individual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee" aria-controls="profile" role="tab" aria-selected="false">Group</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Panel Individu -->
                    <div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">
                        <div class="content-body">
                            <div class="alert alert-danger alert-dissmisable fade show" style="display:none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
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
                                <div class="col-12">
                                    @can('create-plan')
                                    @role('coach')
                                    <a href={{ route('plans.create')}} class="create-new btn btn-primary">Add New</a>
                                    @endrole
                                    @endcan
                                </div>
                            </div>
                            <br>
                            <!-- Basic table -->
                            <section id="basic-datatable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            @hasanyrole('coach|admin')
                                            <table class="datatables-basic table-striped table plan-datatable-individual">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Objective</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            @else
                                            <table class="datatables-basic table-striped table plan-datatable-individual">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Objective</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            @endhasanyrole
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--/ Basic table -->
                        </div>
                    </div>
                    <!-- /panel individu -->


                    <!-- Panel Grup -->
                    <div class="tab-pane" id="coachee" aria-labelledby="coachee-tab" role="tabpanel">
                        <div class="content-body">
                            <div class="alert alert-danger alert-dissmisable fade show" style="display:none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
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
                                <div class="col-12">
                                    @can('create-plan')
                                    @role('coach')
                                    <a href={{ route('plans.create')}} class="create-new btn btn-primary">Add New</a>
                                    @endrole
                                    @endcan
                                </div>
                            </div>
                            <br>
                            <!-- Basic table -->
                            <section id="basic-datatable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            @hasanyrole('coach|admin')
                                            <table class="datatables-basic table-striped table plan-datatable-group">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Grup</th>
                                                        <th>Objective</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            @else
                                            <table class="datatables-basic table-striped table plan-datatable-group">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Grup</th>
                                                        <th>Objective</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            @endhasanyrole
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--/ Basic table -->
                        </div>
                    </div>
                    <!-- /coachee list admin -->
                </div>
            </div>
        </div>
        <!-- /panel coachee -->



        <!-- END: Content-->
        @endsection

        @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
        <script type="text/javascript">
            // popover
            $(function() {
                $('[data-toggle="popover"]').popover({
                    html: true,
                    trigger: 'hover',
                    placement: 'top',
                    content: function() {
                        return '<img src="' + $(this).data('img') + '" />';
                    }
                })
            })

            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                @role('coach|admin')
                var table_plans_individual = $('.plan-datatable-individual').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'client.name',
                            name: 'client.name'
                        },
                        {
                            data: 'objective',
                            name: 'objective'
                        },
                        {
                            data: 'date',
                            name: 'date'
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
                                    $name = full['client']['name'],
                                    $post = full['client']['company'];
                                $org = full['client']['organization'];
                                if ($user_img) {
                                    // For Avatar image
                                    var $output =
                                        '<img src="' + assetPath + 'images/avatars/' + $user_img + '" alt="Avatar" width="32" height="32">';
                                } else {
                                    // For Avatar badge
                                    var stateNum = full['status'];
                                    var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                    var $state = states[stateNum],
                                        $name = full['client']['name'],
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
                                    $name;
                                return $row_output;
                            }
                        },
                        // {
                        //     targets: 4,
                        //     render: function(data, type, full, meta) {
                        //         var $phone = full['phone'],
                        //             $output = '<div class="d-flex justify-content-left align-items-center"> +62' + $phone +
                        //             '</div>';
                        //         return $output;
                        //     }
                        // }
                    ],

                    order: [
                        [2, 'desc']
                    ],
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['client']['name'];
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
                @endrole

                @role('coachee')
                var table_plans_individual = $('.plan-datatable-individual').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'coach_name',
                            name: 'coach_name'
                        },
                        {
                            data: 'objective',
                            name: 'objective'
                        },
                        {
                            data: 'date',
                            name: 'date',
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
                @endrole

                var table_plans_group = $('.plan-datatable-group').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('plans.show_group')}}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'group_id',
                            name: 'group_id'
                        },
                        {
                            data: 'objective',
                            name: 'objective'
                        },
                        {
                            data: 'date',
                            name: 'date',
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


                $('body').on('click', '.deletePlan', function(e) {

                    var plan_id = $(this).data("id");
                    console.log(plan_id);
                    // ganti sweetalert

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You'll delete your plan",
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
                                url: "" + '/plans/' + plan_id,
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted Successfully!',
                                    });
                                    table_plans_individual.draw();
                                    table_plans.group.draw();
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                }
                            });
                        }
                    })
                });
            });
        </script>

        @endpush