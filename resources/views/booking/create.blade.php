@extends('layouts.layoutVerticalMenu')

@section('title','Booking')

@push('styles')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Create Booking</h2>
                        <div class="breadcrumb-wrapper">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card p-2">
                        <form action="" method="post">
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
                                <input type="radio" name="program" value="starco"> STARCO <br>
                                <input type="radio" name="program" value="scmp"> SCMP
                                @error('progam')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="book_demo">Book Demo</label><br>
                                <input type="checkbox" name="book_demo" value="coaching"> COACHING <br>
                                <input type="checkbox" name="book_demo" value="training"> TRAINING <br>
                                <input type="checkbox" name="book_demo" value="mentoring"> MENTORING <br>
                                @error('book_demo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="book_date">Date</label>
                                <input id="book_date" class="form-control @error('book_date') is-invalid @enderror" type="text" name="book_date" value="{{ old('book_date') }}">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="session">Choose a session:</label>
                                <select id="session" name="session">
                                    <option value="1">1 Session</option>
                                    <option value="2">2 Session</option>
                                    <option value="3">3 Session</option>
                                    <option value="4">4 Session</option>
                                </select>
                                @error('session')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <!-- <div class="form-group">
                                <label for="description">Documentation Content</label>
                                <textarea name="description" id="description" cols="20" rows="20" placeholder="Your documentation content here...">{{ old('description') }}</textarea>
                                @error('description')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div> -->

                            <div class="form-group text-right mb-0">
                                <Button type="submit" class="btn btn-primary">Submit</Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="//cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $('#book_date').datepicker({
            autoclose: true,
            daysOfWeekDisabled: [1, 2, 3, 4]
        });
    });
</script>
@endpush