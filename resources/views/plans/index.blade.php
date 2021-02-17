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
                            <img class="rounded float-right width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada bagian ini ditampilkan daftar rencana dari coach yang ada dalam sistem." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Coaching Plans
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <a href={{ route('plans.create')}} class="create-new btn btn-primary">Add New</a>
                    @endcan
                </div>
            </div>
            <br>
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Organization</th>
                                        <th>Email</th>
                                        <th>Handphone</th>
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
                                    <input id="name" name="name" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
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
                                    <input id="email" name="email" type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                    <small class="form-text text-muted"> You can use letters, numbers & periods
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Organization</label>
                                    <input id="organization" name="organization" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Inbis Sample" aria-label="John Doe" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Company</label>
                                    <input id="company" name="company" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Startup Name" aria-label="John Doe" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Occupation</label>
                                    <input id="occupation" name="occupation" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="CEO" aria-label="John Doe" />
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
    // popover
    $(function() {
        $('[data-toggle="popover"]').popover()
    })

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
                    data: 'client.name',
                    name: 'client.name'
                },
                {
                    data: 'client.organization',
                    name: 'client.organization'
                },
                {
                    data: 'client.email',
                    name: 'client.email'
                },
                {
                    data: 'client.phone',
                    name: 'client.phone'
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
                        var $phone = full['client']['phone'],
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

        $('body').on('click', '.deletePlan', function(e) {

            var plan_id = $(this).data("id");
            console.log(plan_id);
            if (confirm("Are You sure want to delete !")) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "" + '/plans/' + plan_id,
                    success: function(data) {
                        table.draw();
                        $(".alert-danger").css("display", "block");
                        $(".alert-danger").css("height", "50px");
                        $(".alert-danger").css("padding-left", "12px");
                        $(".alert-danger").css("padding-top", "12px");
                        $(".alert-danger").css("padding-right", "12px");
                        $(".alert-danger").append("<P>Data berhasil dihapus!");
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
</script>

@endpush