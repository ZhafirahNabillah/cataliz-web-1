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
                        <h2 class="content-header-title float-left mb-0">Book Demo
                            <img class="align-text width=" 15px" height="15px"" src="
                                {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
                                data-toggle="popover" data-placement="top"
                                data-content="Pada halaman ini ditampilkan detail log activity dari semua pengguna yang mengakses website ini." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('booking.index')}}">Book Demo</a>
                                </li>
                                <li class="breadcrumb-item active">Detail Book demo
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>Detail Book Demo</b></h4>
                        </div>
                        <div class="card-body">
                            </h4>
                            <div class="d-block text-right">
                                <a href="{{route('booking.invoice', $data->id)}}" class="btn btn-primary mb-4">Download PDF</a>
                            </div>

                            <div class="col-sm-12">
                                
                                <div class="tab-content">
                                    <ul class="d-flex justify-content-between">
                                        <li class="list-inline-item">
                                            <h6> Name </h6>
                                            <h6> {{$data->name}} </h6>
        
                                            <h6 class=mt-2> Phone </h6>
                                            <h6> {{$data->whatsapp_number}} </h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <h6> Email </h6>
                                            <h6> {{$data->email}} </h6>
        
                                            <h6 class=mt-2> Instance </h6>
                                            <h6> {{$data->instance}} </h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <h6> Profession </h6>
                                            <h6> {{$data->profession}} </h6>
        
                                            <h6 class=mt-2> Address </h6>
                                            <h6> {{$data->address}} </h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <h6> Code Booking </h6>
                                            <h6> {{$data->code}} </h6>
        
                                            <h6 class=mt-2> Link Zoom </h6>
                                            @if($data->link != null)
                                            <h6> {{$data->link}} </h6>
                                            @else
                                            <h6> - </h6>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>    


                            <div class="card-body">
                                <div class="collapse-icon">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card border">
                                            <div id="headingCollapse1" class="card-header" id="headingOne"
                                                data-toggle="collapse" role="button" data-target="#collapse1"
                                                aria-expanded="false" aria-controls="collapse1">
                                                <h6>Goals</h6>
                                            </div>
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">{{$data->goals}}</li>
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
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            {{$data->programs->program_name}}</li>
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
                                                <h6>Category</h6>
                                            </div>
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach($data->book_demo as $dataDemo=>$value)
                                                        <li class="list-group-item">{{$value}}</li>
                                                        @endforeach
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
                                                <h6>Date</h6>
                                            </div>
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">{{$data->book_date}}</li>
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
                                                <h6>Payment</h6>
                                            </div>
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">{{$data->bank}}</li>
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
                                                <h6>Status</h6>
                                            </div>
                                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                                class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">{{$data->status}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- <div class="card border">
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Goals</li>
                            <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Phasellus enim ante, accumsan ut eros non, viverra egestas lectus. Proin in metus sollicitudin,</li>
                            <li class="list-group-item">Program</li>
                            <li class="list-group-item">Category</li>
                            <li class="list-group-item">Date</li>
                            <li class="list-group-item">Payment</li>
                            <li class="list-group-item">Status :Reservation</li>
                            </ul>
                        </div> -->



                            <div class="form-group mt-2">
                                <a href="{{ URL::previous() }}" type="button" class="btn btn-secondary ">BACK</a>
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