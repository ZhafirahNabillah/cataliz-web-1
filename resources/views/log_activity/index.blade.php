@extends('layouts.layoutVerticalMenu')

@section('title','Log Activity')

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
                        <h2 class="content-header-title float-left mb-0">Log Activity
                            <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada halaman ini ditampilkan detail log activity dari semua pengguna yang mengakses website ini." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Log Activity
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <!-- @role('admin') -->
                                        <table class="datatables-basic table-striped table logadmin-datatable" id="datatables">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>DATE TIME</th>
                                                    <!-- <th>ROLE</th> -->
                                                    <th>E-MAIL</th>
                                                    <th>DESCRIPTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- @foreach($data as $e=>$dtActivity)
                                                <tr>
                                                    <td>{{ $dtActivity->id }}</td>
                                                    <td>{{ $dtActivity->created_at }}</td>
                                                    <td>{{ $dtActivity->causer->name }}</td>
                                                    <td>{{ $dtActivity->causer->email }}</td>
                                                    <td>{{ $dtActivity->description }}</td>
                                                </tr>
                                                @endforeach -->
                                            </tbody>
                                        </table>
                                        <!-- @endrole
                                        @role('coach')
                                        <table class="datatables-basic table-striped table logcoach-datatable" id="datatables">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>DATE TIME</th>
                                                    <th>E-MAIL</th>
                                                    <th>DESCRIPTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $e=>$dtActivity)
                                                <tr>
                                                    <td>{{ $dtActivity->id }}</td>
                                                    <td>{{ $dtActivity->created_at }}</td>
                                                    <td>{{ $dtActivity->causer->email }}</td>
                                                    <td>{{ $dtActivity->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endrole -->

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
    <!-- <script src="assets/dataTables/datatables.min.js"></script> -->
    <script type="text/javascript">
        // $(document).ready( function () {
        //     $('#myTable').DataTable();
        // } );
        // popover
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
                        data: 'causer_id',
                        name: 'causer_id'
                    },
                    {
                        data: 'email',
                        name: 'email'
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

            $('body').on('click', '.deleteTopic', function(e) {

                var topic_id = $(this).data("id");
                console.log(topic_id);
                // ganti sweetalert
                Swal.fire({
                    title: "Are you sure?",
                    text: "You'll delete your topic",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Sure",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "" + '/topic/' + topic_id,
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted Successfully!',
                                });
                                table_topic.draw();
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