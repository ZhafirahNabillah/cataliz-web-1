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
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Edit Book Demo
                            <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada halaman ini ditampilkan detail log activity dari semua pengguna yang mengakses website ini." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('booking.index')}}">Book Demo</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Book Demo
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
                        <form action="{{ route('booking.update_admin',$data->id) }}" method="post" id="BookingForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label" for="name">Full Name</label>
                                <input class="form-control" type="text" name="name" value="{{$data->name}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="basic-icon-default-post">Phone</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input class="form-control" type="text" name="whatsapp_number" value="{{$data->whatsapp_number}}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="instance">Instance</label>
                                <input class="form-control" type="text" name="instance" value="{{$data->instance}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="profession">Profession</label>
                                <input class="form-control" type="text" name="profession" value="{{$data->profession}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <input class="form-control" type="text" name="address" value="{{$data->address}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="zoom">Link Zoom</label>
                                <input class="form-control" type="text" name="link" value="{{$data->link}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="goals">Goals</label>
                                <textarea class="form-control dt-goals" name="goals" id="goals" cols="30" rows="3">{{$data->goals}}</textarea>
                            </div>
                            <div style="display:inline-table;">
                                <div style="display:table-cell;">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Program</label>
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$data->programs->program_name}}</div>
                                    </div>
                                </div>
                            </div><br>
                            <div style="display:inline-table;">
                                <div style="display:table-cell; padding-right:20px;">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Category</label>
                                        @foreach($data->book_demo as $dataDemo=>$value)
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$value}}</div><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div style="display:table-cell;">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Session</label>
                                        @if($data->session_coaching != 0)
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$data->session_coaching}} Session</div><br>
                                        @elseif($data->session_training != 0)
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$data->session_training}} Session</div><br>
                                        @elseif($data->session_mentoring != 0)
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$data->session_mentoring}} Session</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="date">Date</label>
                                <input class="form-control" type="text" id="book_date" name="book_date" value="{{$data->book_date}}" placeholder="">
                            </div>
                            <div style="display:inline-table;">
                                <div style="display:table-cell;">
                                    <div class="form-group">
                                        <label class="form-label" for="category">Payment Method</label>
                                        <div style="border:1px #625F6E double; padding: 10px;background-color:#CFCFCF; border-radius:5px; text-align:center; width:100%">{{$data->bank}}</div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status" value="reservation"> Reservation<br>
                            </div>
                            <div class="form-group">
                                <Button id="submit" type="submit" class="btn btn-primary" style="margin-top:5px; margin-right:5px;">SAVE</Button>
                                <Button id="submit" type="submit" class="btn btn-secondary" style="margin-top:5px">BACK</Button>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
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

        $(function() {
            $("#book_date").datepicker({
                beforeShowDay: function(date) {
                    return [date.getDay() == 5 || date.getDay() == 6 || date.getDay() == 0, ""]
                }
            });
        });
    </script>

    @endpush