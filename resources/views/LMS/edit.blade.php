@extends('layouts.layoutVerticalMenu')

@section('title','Edit Book Demo')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- <link href="assets/dataTables/datatables.min.css" rel="stylesheet"> -->
<style>
    .tabs {
        display: flex;
        position: relative;
        background-color: #7367F0;
        padding: 0.5rem;
        border-radius: 99px;
    }

    .tabs * {
        z-index: 2;
    }

    input[type="radio"] {
        display: none;
    }

    .tab {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 21px;
        width: 50px;
        font-size: 1.1rem;
        border-radius: 99px;
        cursor: pointer;
        transition: color 0.15s ease-in;
    }

    input[type="radio"]:checked+label {
        color: white;
    }

    input[id="radio-1"]:checked~.glider {
        transform: translateX(0);
    }

    input[id="radio-2"]:checked~.glider {
        transform: translateX(100%);
    }

    input[id="radio-3"]:checked~.glider {
        transform: translateX(200%);
    }

    .glider {
        position: absolute;
        display: flex;
        height: 21px;
        width: 50px;
        background-color: #ECC373;
        color: white;
        z-index: 1;
        border-radius: 99px;
        transition: 0.25 ease-out;
    }
</style>
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
                                <li class="breadcrumb-item active">Edit User
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
                        <form action="" method="post" id="BookingForm">
                            <div class="form-group">
                                <label class="form-label" for="name">No</label>
                                <input class="form-control" type="text" name="name" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" type="text" name="name" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name">Email</label>
                                <input class="form-control" type="text" name="name" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="name">Phone</label>
                                <input class="form-control" type="text" name="name" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="instance">Packages</label>
                                <input class="form-control" type="text" name="instance" value="" placeholder="">
                            </div>
                            <div style="display:inline-table;">
                                <div style="display:table-cell;">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Program</label>
                                        <div
                                            style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">
                                        </div>

                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label for="status">Payment Program</label><br>
                                <input type="checkbox" name="status" value="reservation"> STARCO<br>
                                <input type="checkbox" name="status" value="reservation"> SCMP<br>
                                <input type="checkbox" name="status" value="reservation"> XXXX<br>
                                <input type="checkbox" name="status" value="reservation"> XXXX<br>
                            </div>
                            
                            <label class="form-label" for="name">Payment Slip</label>
                            <div class="card border">
                                <div id="headingCollapse1" class="card-header">
                                    <h6>dd/mm/yyyy</h6>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <Button id="submit" type="submit" class="btn btn-primary"
                                    style="margin-top:5px; margin-right:5px;">UPDATE</Button>
                                <a href="{{ URL::previous() }}" type="button" class="btn btn-secondary"
                                    style="margin-top: 0.5%;">BACK</a>
                            </div>
                        </form><br>
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
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        // $(function() {
        //     $('[data-toggle="popover"]').popover({
        //         html: true,
        //         trigger: 'hover',
        //         placement: 'top',
        //         content: function() {
        //             return '<img src="' + $(this).data('img') + '" />';
        //         }
        //     });
        // });

        $(function () {
            $("#book_date").datepicker({
                beforeShowDay: function (date) {
                    return [date.getDay() == 5 || date.getDay() == 6 || date.getDay() == 0, ""]
                }
            });
        });
    </script>

    @endpush