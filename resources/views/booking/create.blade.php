@extends('layouts.layoutVerticalMenu')

@section('title','Booking')

@push('styles')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
    .form-group {
        width: 250%;
        margin-left: -70%;
    }

    form {
        display: inline-block;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
    }

    button[type="submit"] {
        margin-top: 2.5%;
        width: 100%;
    }

    .content-body {
        margin: -0% 5%;
    }
</style>
@endpush

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content" style="margin-top: -5%; margin-left: -0.5%;background-color:#fbea67">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">

                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card p-2">
                    <h3><img src="{{ url('/assets/images/cataliz.png') }}" style="width:2.5%; float:left;"> Cataliz</h3>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle"></i> Your Data Booking has been created, Please make payment...
                    </div>
                    @endif
                    <div class="card p-3" style="margin: 0% 15%; background-image: url('/assets/images/bg_booking.jpg')">
                        <h2 class="text-center" style="margin-top: 2.5%;">BOOK HERE</h2>
                        <form action="{{ route('booking.store') }}" method="post">
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
                                <input class="form-control @error('whatsapp_number') is-invalid @enderror" type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="Input your Whatsapp Number...">
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
                                <label for="goals">goals</label>
                                <input class="form-control @error('goals') is-invalid @enderror" type="text" name="goals" value="{{ old('goals') }}" placeholder="Input your goals...">
                                @error('goals')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="program">Program</label><br>
                                <input type="radio" name="program" value="starco" {{(old('program') == 'starco') ? ' selected' : ''}}> STARCO <br>
                                <input type="radio" name="program" value="scmp" {{(old('program') == 'scmp') ? ' selected' : ''}}> SCMP
                                @error('progam')
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
                                <input type="checkbox" name="book_demo" value="coaching" id="coaching"> COACHING <br>
                                <input type="checkbox" name="book_demo" value="training" id="training"> TRAINING <br>
                                <input type="checkbox" name="book_demo" value="mentoring" id="mentoring"> MENTORING <br>
                                @error('book_demo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="session_coaching">Coaching Session:</label>
                                <select id="sessionCoaching" name="session_coaching" class="form-control @error('session_coaching') is-invalid @enderror">
                                    <option value="" disabled>Choose a session:</option>
                                    <option value="0" {{(old('session_coaching') == '0') ? ' selected' : ''}}>0 Session</option>
                                    <option value="1" {{(old('session_coaching') == '1') ? ' selected' : ''}}>1 Session</option>
                                    <option value="2" {{(old('session_coaching') == '2') ? ' selected' : ''}}>2 Session</option>
                                    <option value="3" {{(old('session_coaching') == '3') ? ' selected' : ''}}>3 Session</option>
                                </select>
                                @error('session_coaching')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="session_training">Training Session:</label>
                                <select id="sessionTraining" name="session_training" class="form-control @error('session_training') is-invalid @enderror">
                                    <option value="" disabled>Choose a session:</option>
                                    <option value="0">0 Session</option>
                                    <option value="1">1 Session</option>
                                    <option value="2">2 Session</option>
                                    <option value="3">3 Session</option>
                                </select>
                                @error('session_training')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="session_mentoring">Mentoring Session:</label>
                                <select id="sessionMentoring" name="session_mentoring" class="form-control @error('session_mentoring') is-invalid @enderror">
                                    <option value="" disabled>Choose a session:</option>
                                    <option value="0">0 Session</option>
                                    <option value="1">1 Session</option>
                                    <option value="2">2 Session</option>
                                    <option value="3">3 Session</option>
                                </select>
                                @error('session_mentoring')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="priceBooking" value="" placeholder="Choice Book Demo and Session, Than Klik Check Out...">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group text-center mb-0">
                                <Button type="submit" class="btn btn-warning">NEXT</Button>
                            </div>
                        </form><br>
                        <Button class="btn btn-warning" id="cekPrice">CHECK OUT</Button>
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
        $("#priceBooking").prop('disabled', true);
        $("#cekPrice").click(function() {
            var priceCoaching = parseInt("400000");
            var priceTraining = parseInt("300000");
            var priceMentoring = parseInt("300000");

            var timeCoaching = parseInt($("#sessionCoaching").val());
            var timeTraining = parseInt($("#sessionTraining").val());
            var timeMentoring = parseInt($("#sessionMentoring").val());

            if ($('#coaching').is(':checked')) {
                var totalPrice = priceCoaching * timeCoaching;
            } else if ($('#training').is(':checked')) {
                var totalPrice = priceTraining * timeTraining;
            } else if ($('#mentoring').is(':checked')) {
                var totalPrice = priceMentoring * timeMentoring;
            }
            if ($('#coaching').is(':checked') && $('#training').is(':checked')) {
                var totalPrice = (priceCoaching * timeCoaching) + (priceTraining * timeTraining);
            }
            if ($('#coaching').is(':checked') && $('#mentoring').is(':checked')) {
                var totalPrice = (priceCoaching * timeCoaching) + (priceMentoring * timeMentoring);
            }
            if ($('#training').is(':checked') && $('#mentoring').is(':checked')) {
                var totalPrice = (priceTraining * timeTraining) + (priceMentoring * timeMentoring);
            }
            if ($('#coaching').is(':checked') && $('#training').is(':checked') && $('#mentoring').is(':checked')) {
                var totalPrice = (priceCoaching * timeCoaching) + (priceTraining * timeTraining) + (priceMentoring * timeMentoring);
            }

            $("#priceBooking").prop('disabled', false);
            $('#priceBooking').val("Rp. " + totalPrice);
        });
    });
</script>
@endpush