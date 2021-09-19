@extends('layouts.layoutVerticalMenu')

@section('title','Booking')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
@endpush

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-color:#fbea67">
    <!-- <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">

                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="card p-2">
            <h3 style="font-size:;"><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle"></i> Your Data Booking has been created, Please make payment...
                    </div>
                    @endif
                    <div class="row p-3">
                        <div class="col-md-5 rounded-left" style="height:1265px;background-image: url('/assets/images/discussion.jpg');background-repeat:repeat;">
                        </div>
                        <div class="col-md-7 p-5 rounded-right" style="background-color: #c4c4c4">
                            <div class="container">
                                <h2 class="text-center" style="font-family: Roboto; color:black;">BOOK HERE</h2>
                                <form action="{{ route('booking.store') }}" method="post" id="BookingForm" name="BookingForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Input your name...">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Input your email...">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp_number">Whatsapp Number</label>
                                        <input class="form-control @error('whatsapp_number') is-invalid @enderror" type="tel" name="whatsapp_number" value="{{ old('whatsapp_number') }}" maxlength="12" minlength="11" placeholder="ex. 085232982982">
                                        @error('whatsapp_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="instance">Instance</label>
                                        <input class="form-control @error('instance') is-invalid @enderror" type="text" name="instance" value="{{ old('instance') }}" placeholder="Input your instance...">
                                        @error('instance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="profession">Profession</label>
                                        <input class="form-control @error('profession') is-invalid @enderror" type="text" name="profession" value="{{ old('profession') }}" placeholder="Input your profession...">
                                        @error('profession')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ old('address') }}" placeholder="Input your address...">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="goals">Goals</label>
                                        <input class="form-control @error('goals') is-invalid @enderror" type="text" name="goals" value="{{ old('goals') }}" placeholder="Input your goals...">
                                        @error('goals')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="program">Program</label><br>
                                        @error('program_id')
                                        Program is Empty, Please request program to Admin...
                                        @enderror
                                        @foreach($programs as $listProgram)
                                        <input type="radio" name="program_id" value="{{$listProgram->id}}"> {{$listProgram->program_name}}
                                        @endforeach
                                        @error('progam_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="book_date">Date</label>
                                        <input type="text" id="book_date" name="book_date" class="form-control @error('book_date') is-invalid @enderror" value="{{ old('book_date') }}" placeholder="Click to choice date...">
                                        @error('book_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="book_demo">Book Demo</label><br>
                                        <input type="checkbox" name="book_demo[]" value="coaching" id="coaching"> COACHING <br>
                                        <input type="checkbox" name="book_demo[]" value="training" id="training"> TRAINING <br>
                                        <input type="checkbox" name="book_demo[]" value="mentoring" id="mentoring"> MENTORING <br>
                                        @error('book_demo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" id="fieldCoaching">
                                        <label for="session_coaching">Coaching Session:</label>
                                        <select id="choiceCoaching" class="form-control @error('session_coaching') is-invalid @enderror">
                                            <option value="0" {{(old('session_coaching') == '0') ? ' selected' : ''}}>0 Session</option>
                                            <option value="1" {{(old('session_coaching') == '1') ? ' selected' : ''}}>1 Session</option>
                                            <option value="2" {{(old('session_coaching') == '2') ? ' selected' : ''}}>2 Session</option>
                                            <option value="3" {{(old('session_coaching') == '3') ? ' selected' : ''}}>3 Session</option>
                                        </select>
                                        <input type="hidden" class="sum" name="session_coaching" id="inputCoaching">
                                        @error('session_coaching')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="fieldTraining">
                                        <label for="session_training">Training Session:</label>
                                        <select id="choiceTraining" class="form-control @error('session_training') is-invalid @enderror">
                                            <option value="0" {{(old('session_training') == '0') ? ' selected' : ''}}>0 Session</option>
                                            <option value="1" {{(old('session_training') == '1') ? ' selected' : ''}}>1 Session</option>
                                            <option value="2" {{(old('session_training') == '2') ? ' selected' : ''}}>2 Session</option>
                                            <option value="3" {{(old('session_training') == '3') ? ' selected' : ''}}>3 Session</option>
                                        </select>
                                        <input type="hidden" class="sum" name="session_training" id="inputTraining">
                                        @error('session_training')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="fieldMentoring">
                                        <label for="session_mentoring">Mentoring Session:</label>
                                        <select id="choiceMentoring" class="form-control @error('session_mentoring') is-invalid @enderror">
                                            <option value="0" {{(old('session_mentoring') == '0') ? ' selected' : ''}}>0 Session</option>
                                            <option value="1" {{(old('session_mentoring') == '1') ? ' selected' : ''}}>1 Session</option>
                                            <option value="2" {{(old('session_mentoring') == '2') ? ' selected' : ''}}>2 Session</option>
                                            <option value="3" {{(old('session_mentoring') == '3') ? ' selected' : ''}}>3 Session</option>
                                        </select>
                                        <input type="hidden" class="sum" name="session_mentoring" id="inputMentoring">
                                        @error('session_mentoring')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input class="form-control" type="hidden" name="code" value="{{$code_booking}}">
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
                                        <Button id="submit" type="submit" class="btn btn-warning">BOOK NOW</Button>
                                    </div>
                                </form><br>
                                <!-- <div id="buttonCheck">
                                    <Button class="btn btn-warning" id="checkOut" style="width: 55%; margin-left: 45%; margin-top:-1%;">CHECK OUT</Button>
                                </div> -->
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
    $(function() {
        $("#book_date").datepicker({
            beforeShowDay: function(date) {
                return [date.getDay() == 5 || date.getDay() == 6 || date.getDay() == 0, ""]
            }
        });
    });

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

        $("#submit").click(function() {
            var timeCoaching = parseInt($("#choiceCoaching").val());
            var timeTraining = parseInt($("#choiceTraining").val());
            var timeMentoring = parseInt($("#choiceMentoring").val());

            $('#inputCoaching').val(timeCoaching);
            $('#inputTraining').val(timeTraining);
            $('#inputMentoring').val(timeMentoring);

        });

        //     $("#priceBooking").hide();
        //     $("#submit").hide();
        //     $("#buttonCheck").show();

        //     $("#fieldCoaching").hide();
        //     $("#coaching").change(function() {
        //         if ($('#coaching').is(':checked')) {
        //             $("#fieldCoaching").show();

        //         } else {
        //             $("#fieldCoaching").hide();
        //         }
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });
        //     $("#fieldTraining").hide();
        //     $("#training").change(function() {
        //         if ($('#training').is(':checked')) {
        //             $("#fieldTraining").show();
        //         } else {
        //             $("#fieldTraining").hide();
        //         }
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });
        //     $("#fieldMentoring").hide();
        //     $("#mentoring").change(function() {
        //         if ($('#mentoring').is(':checked')) {
        //             $("#fieldMentoring").show();
        //         } else {
        //             $("#fieldMentoring").hide();
        //         }
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });

        //     $("#sessionCoaching").change(function() {
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });
        //     $("#sessionTraining").change(function() {
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });
        //     $("#sessionMentoring").change(function() {
        //         $("#submit").hide();
        //         $("#buttonCheck").show();
        //     });

        //     $("#sessionCoaching").change(function() {
        //         if ($('#coaching').is(':checked')) {
        //             var timeCoaching = parseInt($("#sessionCoaching").val());
        //             var totalPrice = priceCoaching * timeCoaching;
        //         }
        //         $('#informationPrice').text("Rp. " + totalPrice);
        //     });
        //     $("#sessionTraining").change(function() {
        //         if ($('#training').is(':checked')) {
        //             var timeTraining = parseInt($("#sessionTraining").val());
        //             var totalPrice = priceTraining * timeTraining;
        //         }
        //         $('#informationPrice').text("Rp. " + totalPrice);
        //     });
        //     $("#sessionMentoring").change(function() {
        //         if ($('#mentoring').is(':checked')) {
        //             var timeMentoring = parseInt($("#sessionMentoring").val());
        //             var totalPrice = priceMentoring * timeMentoring;
        //         }
        //         $('#informationPrice').text("Rp. " + totalPrice);
        //     });


        //     $("#checkOut").click(function() {
        //         var priceCoaching = parseInt("400000");
        //         var priceTraining = parseInt("300000");
        //         var priceMentoring = parseInt("300000");

        //         var timeCoaching = parseInt($("#sessionCoaching").val());
        //         var timeTraining = parseInt($("#sessionTraining").val());
        //         var timeMentoring = parseInt($("#sessionMentoring").val());

        //         if ($('#coaching').is(':checked')) {
        //             var totalPrice = priceCoaching * timeCoaching;
        //         } else if ($('#training').is(':checked')) {
        //             var totalPrice = priceTraining * timeTraining;
        //         } else if ($('#mentoring').is(':checked')) {
        //             var totalPrice = priceMentoring * timeMentoring;
        //         }
        //         if ($('#coaching').is(':checked') && $('#training').is(':checked')) {
        //             var totalPrice = (priceCoaching * timeCoaching) + (priceTraining * timeTraining);
        //         }
        //         if ($('#coaching').is(':checked') && $('#mentoring').is(':checked')) {
        //             var totalPrice = (priceCoaching * timeCoaching) + (priceMentoring * timeMentoring);
        //         }
        //         if ($('#training').is(':checked') && $('#mentoring').is(':checked')) {
        //             var totalPrice = (priceTraining * timeTraining) + (priceMentoring * timeMentoring);
        //         }
        //         if ($('#coaching').is(':checked') && $('#training').is(':checked') && $('#mentoring').is(':checked')) {
        //             var totalPrice = (priceCoaching * timeCoaching) + (priceTraining * timeTraining) + (priceMentoring * timeMentoring);
        //         }

        //         $('#priceBooking').val("Rp. " + totalPrice);
        //         $('#informationPrice').text("Rp. " + totalPrice);
        //         $("#submit").show();
        //         $("#buttonCheck").hide();
        //     });
    });

</script>
@endpush