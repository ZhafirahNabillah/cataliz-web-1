@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Topics
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Topic</a>
                </li>
                <li class="breadcrumb-item active">Detail Topic
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      {{-- content --}}
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><b>Detail Topic</b>
              </h4>
              <a href="#" class="btn btn-primary">Download PDF</a>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="card border">
                  <h5 class="text-center card-title">Special title treatment</h5>
                  <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Phasellus enim ante, accumsan ut eros non, viverra egestas lectus. Proin in metus sollicitudin, rhoncus ipsum ac, auctor dui. Morbi rutrum sem tellus, sed mollis tortor scelerisque a. Vestibulum malesuada consequat consectetur. Proin vitae vestibulum sapien. Curabitur tempus maximus sapien, sit amet cursus diam volutpat viverra. Ut ornare arcu sit amet lectus dignissim, et convallis tellus viverra. In eget cursus diam, posuere hendrerit ex. Mauris sit amet sem lacinia, mattis quam et, blandit orci. Duis in scelerisque odio. Cras convallis, leo sit amet tincidunt dignissim, lorem nibh posuere metus, sit amet convallis diam diam eget magna. Nam auctor sodales nisi, quis euismod nisl aliquam sit amet. Proin sed ipsum convallis mi ultrices lacinia. Integer at arcu id risus imperdiet sagittis id ut erat.</p>

                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare facilisis nulla et consequat. Vivamus vulputate, est vel pulvinar cursus, leo odio vehicula dui, eget consectetur ante velit id orci. Phasellus enim ante, accumsan ut eros non, viverra egestas lectus. Proin in metus sollicitudin, rhoncus ipsum ac, auctor dui. Morbi rutrum sem tellus, sed mollis tortor scelerisque a. Vestibulum malesuada consequat consectetur. Proin vitae vestibulum sapien. Curabitur tempus maximus sapien, sit amet cursus diam volutpat viverra. Ut ornare arcu sit amet lectus dignissim, et convallis tellus viverra. In eget cursus diam, posuere hendrerit ex. Mauris sit amet sem lacinia, mattis quam et, blandit orci. Duis in scelerisque odio. Cras convallis, leo sit amet tincidunt dignissim, lorem nibh posuere metus, sit amet convallis diam diam eget magna. Nam auctor sodales nisi, quis euismod nisl aliquam sit amet. Proin sed ipsum convallis mi ultrices lacinia. Integer at arcu id risus imperdiet sagittis id ut erat.</p>
                  </div>
                </div>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    // popover
    $(function() {
      $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'hover',
        placement: 'top',
        content: function() {
          return '<img src="' + $(this).data('img') + '" />';
        }
      })
    })
  </script>
  @endpush