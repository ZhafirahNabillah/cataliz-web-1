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
                            <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top"
                            data-content="Halaman ini menampilkan daftar pengguna yang terdaftar dalam website baik coach maupun coachee." />
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
          <button style="margin-top: 10px;margin-bottom: 10px;" type="submit"
            class="btn btn-primary data-submit mr-1 createNewUser">Add User</button>
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
                ajax: "{{ route('activity.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'causer.name',
                        name: 'causer.name'
                    },
                    {
                        data: 'causer.email',
                        name: 'causer.email'
                    },
                    {
                        data: 'description',
                        name: 'description'
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