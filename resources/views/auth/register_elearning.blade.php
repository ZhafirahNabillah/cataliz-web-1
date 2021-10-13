@extends('layouts.layoutVerticalMenu')

@section('title','Register Elearning')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<style>
    @media screen and (max-width: 2560px) {
        .col-md-11 {
            padding-top: 30px;
            border-radius: 6px 6px 6px 6px;
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        h3 {
            padding-top: 30px;
            padding-left: 30px;
        }

        .container-fluid {
            margin-top: -5px;
        }

        .card {
            width:600px;
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        .row {
            padding-top: 20px;
            padding-right: 40px;
            padding-left: 40px;
            padding-bottom: 15px;
        }

        .button {
            background-color: #7A6FF1; /* Green */
            border: none;
            color: white;
            padding: 10px 27px;
            text-align: center;
            border-radius: 6px 6px 6px 6px;
            font-size: 14px;
            cursor: pointer;
    }

    }

    @media screen and (max-width: 768px) {

        .col-md-7 {
            padding-top: 30px;
            margin-right: -130px;
            border-radius: 0px 6px 6px 0px;
        }

        .container-fluid {
            margin-top: -40px;
        }

        .row {
            padding-top: 10px;
            padding-bottom: 15px;
        }
    }

    @media screen and (max-width: 767px) {
        .col-md-4 {
            visibility: hidden;
            display: none;
        }

        .col-md-7 {
            padding-top: 30px;
            margin-right: -130px;
        }
    }

    @media screen and (max-width: 425px) {
        .col-md-7 {
            padding-top: 30px;
            border-radius: 0px 0px 6px 6px;
        }

        .container-fluid {
            margin-top: -50px;
        }

        .row {
            padding-top: 15px;
            padding-right: 14px;
            padding-left: 14px;
            padding-bottom: 0px;
        }
    }
</style>
@endpush

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-image:url('/assets/images/bg_registerelearning.png')">
    <!-- <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">

                </div>
            </div>
        </div>
    </div> -->

    <div class="container-fluid">
        <div class="card">
            <h3><img src="{{ url('/assets/images/logo.png') }}" style="width:100px; float:left;"> </h3>
            <!-- @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle"></i> Your Data Booking has been created, Please make payment...
                    </div>
                    @endif -->
            <div class="row">
                <div class="col-md-11" style="background-color: #F1DDAC; margin-right">
                    <div class="container">
                        <h2 class="text-center" style="font-family: montserrat; color:black;">Register as New Member</h2>
                        <form action="{{ route('booking.store') }}" method="post" id="BookingForm" name="BookingForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="" placeholder="Input your name...">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" value="" maxlength="13" minlength="11" placeholder="ex. 085232982982">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="" placeholder="Input your email...">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" value="" placeholder="Input your password...">
                            </div>

                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <input class="form-control @error('confirmpassword') is-invalid @enderror" type="text" name="confirmpassword" value="" placeholder="Confirm your password...">
                            </div>

                            <div class="form-group">
                                <label for="program">Choose Program or Package</label><br>

                                <input type="radio" name="program_id" value=""> Program
                                <input type="radio" name="program_id" value=""> Package
                                <span class="invalid-feedback" role="alert">
                                    <strong>2</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="price">Total Price</label>
                                <h2>
                                    Rp. <span id="informationPrice">0</span>
                                </h2>
                                <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="priceBooking" value="">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group text-center mb-0">
                                <Button id="submit" type="submit" class="button">JOIN NOW</Button>
                            </div>
                        </form><br>
                        <p class="text-center mt-2"><span>Already have an account?</span><a href="{{route('login')}}"><span>&nbsp;Login</span></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    $(document).ready(function() {
        let price, pcoach, ptrain, pmentor;

        $('#fieldCoaching, #fieldTraining, #fieldMentoring, #priceBooking').hide();

        $('input[type="checkbox"]').change(function() {
            if (this.checked) {
                switch (this.value) {
                    case 'coaching':
                        $('#fieldCoaching').show();
                        break;
                    case 'mentoring':
                        $('#fieldMentoring').show();
                        break;
                    default:
                        $('#fieldTraining').show();
                }
            } else {

                switch (this.value) {
                    case 'coaching':
                        $('#fieldCoaching').hide();
                        $('#fieldCoaching option:first').prop('selected', true);
                        $('#inputCoaching').val("");
                        subtotal();
                        break;
                    case 'mentoring':
                        $('#fieldMentoring').hide();
                        $('#fieldMentoring option:first').prop('selected', true);
                        $('#inputMentoring').val("");

                        subtotal();
                        break;
                    default:
                        $('#fieldTraining option:first').prop('selected', true);
                        $('#fieldTraining').hide();
                        $('#inputTraining').val("");
                        subtotal();
                }
            }

            $("#fieldCoaching").change(function() {
                var pcoach = $("#fieldCoaching :selected").val() * parseInt(400000);
                $('#inputCoaching').val(pcoach);
                subtotal();
                preventDefault();
            });

            $("#fieldTraining").change(function() {
                var ptrain = $("#fieldTraining :selected").val() * parseInt(300000);
                $('#inputTraining').val(ptrain);
                subtotal();
                preventDefault();
            });

            $("#fieldMentoring").change(function() {
                var pmentor = $("#fieldMentoring :selected").val() * parseInt(300000);
                $('#inputMentoring').val(pmentor);
                subtotal();
                preventDefault();
            });

            function subtotal() {
                var total = 0;
                $(".sum").each(function(idx, element) {
                    $this = $(this);
                    var cost = parseFloat($this.val());
                    if (cost)
                        total += cost;
                });
                //alert(total);
                $('#informationPrice').html(total.toLocaleString());
                $('#priceBooking').val(total.toLocaleString());

            }
        });

    });
</script>
@endpush