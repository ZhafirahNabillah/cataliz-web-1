@extends('layouts.layoutVerticalMenu')

@section('title','Payment')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endpush

@section('content')
<p>Search Data Booking :</p>
<form action="{{ route('booking.search') }}" method="GET">
    <input id="valueSearch" class="form-control" type="text" name="searchBooking" placeholder="input your Booking code ..." value="{{ old('searchBooking') }}">
    <input type="submit" id="search" value="Search">
</form><br>

<div class="app-content content">
    <div class="content-body" id="dataSearch">
        @foreach($data as $dataBooking)
        <p>Code Booking: {{$dataBooking->code}}</p>
        <p>Name: {{$dataBooking->name}}</p>
        <p>Session Coaching: {{$dataBooking->session_coaching}}</p>
        <p>Session Training: {{$dataBooking->session_training}}</p>
        <p>Session Mentoring: {{$dataBooking->session_mentoring}}</p>
        <p>Price: {{$dataBooking->price}}</p>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

</script>
@endpush