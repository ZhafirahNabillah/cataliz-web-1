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

<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-color:#fbea67">

    <div class="container">
        <div class="card p-2">
            <h3 style="font-size:;"><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check-circle"></i> Your Payment has been saved, Please ceck your email...
            </div>
            @endif
            <div class="row p-3">
                <div class="col-md-5 rounded-left" style="height:500px;background-image: url('/assets/images/discussion.jpg');background-repeat: no-repeat;">
                </div>
                <div class="col-md-7 p-5 rounded-right" style="background-color: #c4c4c4">

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
                    <form action="{{ route('booking.update',$dataBooking->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row-3">
                            <div class="col-md-5">
                                <label for="bank">Option Bank</label>
                                <select class="form-control @error('bank') is-invalid @enderror" name="bank">
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
                </div>
                </br>
                </br>
            </div>
        </div>
    </div>


    @endsection

    @push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

    </script>
    @endpush