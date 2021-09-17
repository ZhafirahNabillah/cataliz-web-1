@extends('layouts.layoutVerticalMenu')

@section('title','Payment')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endpush

@section('content')
<p>Search Data Booking :</p>
<form action="{{ route('booking.search') }}" method="GET">
    @csrf
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
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

</script>
@endpush