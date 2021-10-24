@extends('layouts.layoutVerticalMenu')

@section('title','Book Demo')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<style>

</style>
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
                        <h2 class="content-header-title float-left mb-0">User
                            <img class="align-text width=" 15px" height="15px"" src="
                                {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
                                data-toggle="popover" data-placement="top"
                                data-content="Halaman ini menampilkan daftar booking yang terdaftar dalam website" />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('booking.index')}}">User </a>
                                </li>
                                <li class="breadcrumb-item active">Detail User
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-2">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h4 class="card-title"><b>Detail User</b></h4>
                            </div>

                            <div class="card-body">
                                <div class="d-block text-right">
                                    <a href="" class="btn btn-primary mb-2">Download
                                        PDF</a>
                                </div>
                                <div class="d-flex flex-sm-row flex-column p-2">

                                    <div class="col-sm-3 mt-2">
                                        <h6> No </h6>
                                        <h6> </h6>

                                        <h6 class=mt-2> Email </h6>
                                        <h6> </h6>
                                    </div>

                                    <div class="col-sm-3 mt-2">
                                        <h6> Full Name </h6>
                                        <h6> </h6>

                                        <h6 class=mt-2> Phone</h6>
                                        <h6> </h6>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="collapse-icon">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card border">
                                                    <div id="headingCollapse1" class="card-header" id="headingOne"
                                                        data-toggle="collapse" role="button" data-target="#collapse1"
                                                        aria-expanded="false" aria-controls="collapse1">
                                                        <h6>Packages</h6>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel"
                                                        aria-labelledby="headingCollapse1" class="collapse show"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse-icon">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card border">
                                                    <div id="headingCollapse1" class="card-header" id="headingOne"
                                                        data-toggle="collapse" role="button" data-target="#collapse1"
                                                        aria-expanded="false" aria-controls="collapse1">
                                                        <h6>Program</h6>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel"
                                                        aria-labelledby="headingCollapse1" class="collapse show"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse-icon">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card border">
                                                    <div id="headingCollapse1" class="card-header" id="headingOne"
                                                        data-toggle="collapse" role="button" data-target="#collapse1"
                                                        aria-expanded="false" aria-controls="collapse1">
                                                        <h6>Payment Program</h6>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel"
                                                        aria-labelledby="headingCollapse1" class="collapse show"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                #STARCO
                                                                <ul class="list-group list-group-flush">
                                                                    #SCMP
                                                                </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse-icon">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card border">
                                                    <div id="headingCollapse1" class="card-header" id="headingOne"
                                                        data-toggle="collapse" role="button" data-target="#collapse1"
                                                        aria-expanded="false" aria-controls="collapse1">
                                                        <h6>Payment Slip</h6>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel"
                                                        aria-labelledby="headingCollapse1" class="collapse show"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <div class="card border">
                                                                <div id="headingCollapse1" class="card-header">
                                                                    <h6>dd/mm/yyyy</h6>
                                                                </div>
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item"> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2">
                                            <a href="{{ URL::previous() }}" type="button"
                                                class="btn btn-secondary ">BACK</a>
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
                <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
                    id="theme-styles">
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
                <script type="text/javascript" charset="utf8"
                    src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

                <script type="text/javascript">
                    $(function () {
                        $('[data-toggle="popover"]').popover({
                            html: true,
                            trigger: 'hover',
                            placement: 'top',
                            content: function () {
                                return '<img src="' + $(this).data('img') + '" />';
                            }
                        });
                    });
                </script>

                @endpush