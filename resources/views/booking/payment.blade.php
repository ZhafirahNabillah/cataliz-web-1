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

<style>
    .btn-warning {
        background-color: #F0B445
    }
</style>

<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-image:url('/assets/images/discussion.jpg');background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="card p-2 col-md-6 p-5 rounded-right" style="background-color: #fffff ">
                <!-- <h3 style="font-size:;"><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3> -->
                @if(session('success'))

                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-check-circle"></i> Your Payment has been saved, Please ceck your email...
                </div>
                @endif
                <!-- <div class="row p-3"> -->
                <!-- <div class="col-md-5 rounded-left" style="height:500px;background-image: url('/assets/images/discussion.jpg');background-repeat: no-repeat;">
                    </div> -->


                <div class="container">
                    <h3 class="text-center font-weight-bolder" style="font-family: Montserrat; color:rgba(239, 185, 85, 1); font-size: 200%">PAYMENT</h3>
                    <p class="text-center font-weight-bolder" style="font-family: Montserrat; color:black; font-size:125%"> {{$dataBooking->name}} </p>
                    <dl class="text-center" style="font-family: Montserrat; color:black; font-size: 105%">
                        <dt class="font-weight-bold">YOUR CODE BOOKING : {{$dataBooking->code}}</dt>
                        <dt>Total : Rp.{{$dataBooking->price}} </dt>
                        <dt>Transfer To : </dt>
                    </dl>
                    <dl class="text-center font-weight-bolder" style="font-family: Montserrat; color:black ;font-size: 125%">
                        <dd> BCA 12189512</dd>
                        <dd> BRI 799567845</dd>
                        <dd> MANDIRI 477890909</dd>
                        <dd> BNI 133896669</dd>
                    </dl>
                    <dt class="text-center " style="font-family: Montserrat; color:black; font-size: 105%"> Your booking
                        has been successfully created.. Please
                        complete the payment with upload your payment slip
                    </dt>
                </div>
                <br>
                <form action="{{ route('booking.update',$dataBooking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row-3">
                        <div class="mt-2 mb-2">
                            <div class="col-12">
                                <th>
                                    <label class="text-center " style="font-family: Montserrat; color:black" for="bank">Pilihan Bank</label>
                                    <select class="form-control @error('bank') is-invalid @enderror" name="bank">
                                        <option value="" disabled>Choise Bank: </option>
                                        <option value="bca" {{(old('bank') == 'bca') ? ' selected' : ''}}>BCA</option>
                                        <option value="bri" {{(old('bank') == 'bri') ? ' selected' : ''}}>BRI</option>
                                        <option value="mandiri" {{(old('bank') == 'mandiri') ? ' selected' : ''}}>
                                            MANDIRI</option>
                                        <option value="bni" {{(old('bank') == 'bni') ? ' selected' : ''}}>BNI</option>
                                    </select>
                                </th>
                            </div>

                            <div class="row-3">
                                <div class="mt-2 mb-2">
                                    <div class="col-12">
                                        <label class="text-center " style="font-family: Montserrat; color:black" for="bank">Pilih File</label>
                                        <input type="file" class="form-control" name="payment" id="" placeholder="Choose File ...">
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="hidden" name="program" value="{{$dataBooking->programs->program_name}}">
                            <div class="row-3">
                                <div class="mt-2 mb-5" style="margin-left: 35%;">
                                    <div class="col-md-6 form-group text-center mb-3">
                                        <div class="row justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-warning">UPLOAD PAYMENT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
            </div>
            <div class="container" style="margin-top:-7%">
                <div class="mt-2 mb-2">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6 p-5 rounded-bottom" style="background-color: #F0B445 ">
                            <div class="container" style="margin-bottom:-5%">
                                <div class="row">
                                    <div class="col-md-6 p2" style="margin-left: 43%;">
                                        <img class="img-fluid mx-auto image-center" style="margin-top: -50%; width:25%;" src="{{asset('assets/images/logo2.png')}}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{asset('assets/images/bank.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
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