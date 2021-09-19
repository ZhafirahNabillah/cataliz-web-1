@extends('layouts.layoutVerticalMenu')

@section('title','Verif')

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
                    <div class="row p-3">
                        <div class="col-md-5 rounded-left" style="height:410px;background-image: url('/assets/images/discussion.jpg');background-repeat:no-repeat;">
                        </div>
                        <div class="col-md-7 p-5 rounded-right" style="background-color: #c4c4c4">
                            <div class="container">
                                <h2 class="text-center" style="font-family: Roboto; color:black; padding-top:20%">Your booking has been successfully created.. Please check your email to complete the payment</h2>
                                
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

</script>
@endpush