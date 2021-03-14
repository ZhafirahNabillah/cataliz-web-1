@extends('layouts.layoutVerticalMenu')

@section('title','Class')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Class List</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('class.index')}}">Class List</a>
                </li>
                <li class="breadcrumb-item active">Create New Class
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body">
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dissmisable">
        <h4 class="alert-heading">Success</h4>
        <div class="alert-body">{{ $message }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif

      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Create a New Class</h4>
              </div>
              <div class="card-body">
                <form action="{{route('class.store')}}" method="post">
                  @csrf
                  <div class="row">
                    <div class=" col-md-12 form-group">
                      <label for="fp-default">Class Name</label>
                      <input class="form-control" name="class_name" id="class_name">
                      @error('class_name')
                        <strong class="text-danger">{{ $message }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Coach Name</label>
                      <select class="livesearch form-control @error('livesearch') is-invalid @enderror" name="coach_id" id="livesearch" value="{{ old('livesearch') }}" autocomplete="livesearch">
                      </select>
                      @error('coach_id')
                        <strong class="text-danger">{{ $message }}</strong>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="fp-default" for="basic-icon-default-fullname">Participant</label>
                    <!-- nanti di checklist coachee yang masuk ke kelas ininya -->
                    @foreach($clients as $client)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{$client->id}}" name="clients[]" id="permission-check-{{$client->id}}">
                      <label class="form-check-label" for="permission-check-{{$client->id}}">
                        {{$client->name}}
                      </label>
                    </div>
                    @endforeach
                    @error('clients')
                      <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                  </div>
                  <!-- tambah sweet alert ('Added Successfully') -->
                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
                  <a class="btn btn-light" href="{{ route('class.index') }}">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  </section>
  <!--/ Basic table -->



</div>

<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('.livesearch').select2({
    placeholder: 'Select coachs',
    ajax: {
      url: "{{route('coachs.search')}}",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            console.log(item)
            return {
              text: item.name,
              id: item.id,
            }
          })
        };
      },
      cache: true
    }
  });

  $(".livesearch").on('change', function(e) {
    // Access to full data
    console.log($(this).select2('data'));
    console.log($(this).select2('data')[0].id);
    var dd = $(this).select2('data')[0];
  });
</script>
@endpush
