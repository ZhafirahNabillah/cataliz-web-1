@extends('layouts.layoutVerticalMenu')

@section('title','Payment')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endpush
@section('content')
<!-- <<<<<<< Updated upstream
<p>Search Data Booking :</p>
<form action="{{ route('booking.search') }}" method="GET">
    @csrf
    <input id="valueSearch" class="form-control" type="text" name="searchBooking" placeholder="input your Booking code ..." value="{{ old('searchBooking') }}">
    <input type="submit" id="search" value="Search">
</form><br> -->
=======
<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-color:#fbea67">

    <div class="container">
        <div class="card p-2">
            <h3 style="font-size:;"><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3>
            <div class="row p-3">
                <div class="col-md-5 rounded-left" style="height:500px;background-image: url('/assets/images/discussion.jpg');background-repeat: no-repeat;">
                </div>
                <div class="col-md-7 p-5 rounded-right" style="background-color: #c4c4c4">
                    @foreach($data as $dataBooking)
                    <div class="container">
                        <h5 class="text-center font-weight-bold" style="font-family: Roboto; color:black" style="font-size: 25px"> {{$dataBooking->name}} </h5>
                        <dl class="text-center" style="font-family: Roboto; color:black">
                            <dt class="font-weight-bold">YOUR CODE BOOKING : {{$dataBooking->code}}</dt>
                            <dt>Total : Rp.{{$dataBooking->price}} </dt>
                            <dt>Transfer To : </dt>
                        </dl>
                        <dl class="text-center " style="font-family: Roboto; color:black">
                            <dd>- BCA 12189512</dd>
                            <dd>- BRI 799567845</dd>
                            <dd>- MANDIRI 477890909k</dd>
                            <dd>- BNI 133896669</dd>
                        </dl>
                        <dt class="text-center " style="font-family: Roboto; color:black"> Your booking has been successfully created.. Please
                            complete the payment with upload your payment slip
                        </dt>

                    </div>
                    <br>
                    {{$dataBooking->id}}
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row-3">
                            <div class="col-md-5">
                                <label for="bank">Option Bank</label>
                                <select class="form-control @error('bank') is-invalid @enderror">
                                    <option value="" disabled>Choise Bank: </option>
                                    <option value="bca" {{(old('bank') == 'bca') ? ' selected' : ''}}>BCA</option>
                                    <option value="bri" {{(old('bank') == 'bri') ? ' selected' : ''}}>BRI</option>
                                    <option value="mandiri" {{(old('bank') == 'mandiri') ? ' selected' : ''}}>MANDIRI</option>
                                    <option value="bni" {{(old('bank') == 'bni') ? ' selected' : ''}}>BNI</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="payment" id="" placeholder="Choose File ...">
                            </div>
                            <div class="" style="width: 300px;">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn btn-warning btn-blog">UPLOAD PAYMENT</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
                </br>
                </br>
            </div>
        </div>
    </div>

    <!-- <div class="">
        <div class="d-none d-lg-flex col-lg-12 align-items-center p-5">
                <div class="w-80 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ url('/assets/images/discussion.jpg') }}" alt="Cataliz" /></div>
            </div>
        </div>
        </div> -->
    <!-- <div class="content" style="position:relative;">
        <div class="row">
            <div class="col-12">
                <div class="card p-2">
                    <h3 style="font-size:;"><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3>
                    <div class="row p-3" style="width: 100%;">
                                        <div class="col-md-6" style="height:500px;background-image: url('https://thumbs.dreamstime.com/b/attractive-asian-businesswoman-meeting-beautiful-asian-women-standing-table-making-presentation-business-meeting-vertical-167552630.jpg');background-repeat: no-repeat;">
        
                                        </div>
                                        <div class="col-md-6 p-5" style="background-color: #c4c4c4">
    </div> -->
    <!-- <div class="card p-3" style="background-image: url('/assets/images/discussion.jpg')">
                        <div class="card p-4" style="background-color:#C4C4C4; width : 1000 px ;position:relative; margin-left: 40%; left:7%; margin-top: -6% ">
                        <h2 class="text-center" style="font-family: Roboto; color:black; size : 35 px">PAYMENT</h2>
                        <div class="row g-4">
                        <div class="col-auto">
                            <h4 class="text-center" style="font-family: Roboto; color:black; size : 35 px">Your Code Booking</h4>
                            </div>
                        </div>
                    <form class="row g-3" action="{{ route('booking.search') }}" method="GET">  
                            <div class="col-12">
                            <input id="valueSearch" class="form-control" type="text" name="searchBooking" placeholder="input your Code Booking here ..." value="{{ old('searchBooking') }}"> 
                            </div>
                            <div class="col-8">
                            <Button class="btn btn-warning" id="dataSearch">Search</Button>
                            </div>
                        </form>
                        
                            <input type="submit" id="search" value="" class="btn btn-warning>
                            <div id="buttonCheck">
                                -->
    <!-- </div> -->
    <!-- <div class="card p-4" style="background-color:#C4C4C4; position:relative; margin-left: 40%; left:5.4%; margin-top: -5.5% "> -->

    <!-- @if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i> Your file has been succesfully uploaded!
    </div>
    @endif -->
    <!-- </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- </div> -->
    <!-- END: Content-->


    <!-- <div class="app-content content">
    <div class="content-body" id="dataSearch">
        @foreach($data as $dataBooking)
        <p>Code Booking: {{$dataBooking->code}}</p>
        <p>Name: {{$dataBooking->name}}</p>
        <p>Session Coaching: {{$dataBooking->session_coaching}}</p>
        <p>Session Training: {{$dataBooking->session_training}}</p>
        <p>Session Mentoring: {{$dataBooking->session_mentoring}}</p>
        <p>Price: {{$dataBooking->price}}</p>
        <form action="{{ route('booking.update', $dataBooking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="payment">Payment</label>
                <input class="form-control @error('payment') is-invalid @enderror" type="file" name="payment" value="{{ $dataBooking->payment }}">
                @error('payment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="bank">Choise bank:</label>
                <select class="form-control @error('bank') is-invalid @enderror">
                    <option value="bca" {{(old('bank') == 'bca') ? ' selected' : ''}}>BCA</option>
                    <option value="bri" {{(old('bank') == 'bri') ? ' selected' : ''}}>BRI</option>
                    <option value="mandiri" {{(old('bank') == 'mandiri') ? ' selected' : ''}}>MANDIRI</option>
                    <option value="bni" {{(old('bank') == 'bni') ? ' selected' : ''}}>BNI</option>
                </select>
                <input type="hidden" class="sum" name="session_mentoring" id="inputMentoring">
                @error('session_mentoring')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-0">
                <Button type="submit" class="btn btn-primary">SUBMIT</Button>
            </div>
        </form>
        @endforeach
    </div>
</div> -->
    @endsection

    @push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

    </script>
    @endpush