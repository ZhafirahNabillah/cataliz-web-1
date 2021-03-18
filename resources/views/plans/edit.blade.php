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
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Coaching Plans</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Coaching Plans</a>
                </li>
                <li class="breadcrumb-item active">Edit Coaching Plan
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
                <h4 class="card-title">Edit Plan</h4>
              </div>
              <form action="{{url('/plans')}}" method="post">
                @csrf
                <div class="card-body">
                  <!-- individu -->
                  {{-- <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Full Name</label>
                      <select class="livesearch form-control" name="client_id" id="client_id" disabled>
                        <option selected hidden value="{{ $client->id }}">{{ $client->name }}</option>
                  </select>
                  <input type="hidden" name="client_id" value="{{ $client->id }}">
                </div>
            </div> --}}
            <!-- grup -->
            <div class="form-group">
              <label class="fp-default" for="basic-icon-default-fullname">Client Name</label>
              <!-- nanti di checklist coachee yang masuk ke kelas ininya -->

              <div class="row">
                @foreach ($all_clients as $client)
                <div class="col-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $client->id }}" name="client[]"
                      id="client-{{ $client->id }}" @if($clients->contains($client->id)) checked @endif>
                    <label class="form-check-label" for="client-{{ $client->id }}">
                      {{ $client->name }}
                    </label>
                  </div>
                </div>
                @endforeach
              </div>

              @error('')
              <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>

            <div class="row">
              <!-- kalo grup gausa organitation -->
              {{-- <div class="col-md-6 form-group">
                      <label for="fp-default">Organization</label>
                      <input class="form-control" name="organization" id="organization" disabled value="{{ $client->organization }}">
            </div> --}}

            <div class="col-md-12 form-group">
              <label for="fp-default">Date</label>
              <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                value="{{ $plan->date }}">
              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <!-- Tanggal kalo grup -->
            <div class="col-md-12 form-group">
              <label for="fp-default">Date</label>
              <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                value="{{ $plan->date }}">
              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="fp-default">Objective</label>
              <textarea class="form-control @error('objective') is-invalid @enderror" name="objective" id="objective"
                autocomplete="objective">{{ $plan->objective }}</textarea>

              @error('objective')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="fp-default">Success Indicator</label>
              <textarea class="form-control @error('success_indicator') is-invalid @enderror" name="success_indicator"
                id="success_indicator" autocomplete="success_indicator">{{ $plan->success_indicator }}</textarea>

              @error('success_indicator')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="fp-default">Development Areas</label>
              <textarea class="form-control @error('development_areas') is-invalid @enderror" name="development_areas"
                id="development_areas" autocomplete="development_areas">{{ $plan->development_areas }}</textarea>

              @error('development_areas')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="fp-default">Support</label>
              <textarea class="form-control @error('support') is-invalid @enderror" name="support" id="support"
                autocomplete="support">{{ $plan->support }}</textarea>

              @error('support')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <input type="hidden" name="id" value="{{$plan->id}}">

          <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
        </div>
        </form>
    </div>
  </div>
</div>
</div>
</div>
</section>
<!--/ Basic table -->



</div>
</div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  $('.livesearch').select2({
    placeholder: 'Select clients',
    ajax: {
      url: "{{route('clients.search')}}",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            console.log(item)
            return {
              text: item.name,
              id: item.id,
              org: item.organization,
              pro: item.program
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
    $('#organization').val(dd.org);
    $('#program').val(dd.pro);

  });

  $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#date').datepicker({
      format: 'yyyy-mm-dd',
      minDate: today,
      uiLibrary: 'bootstrap4'
    });

    var clients = {{$plan}};
		console.log(clients);
		var role_id = $(this).data('id');
		$.get("" + '/roles/' + role_id + '/edit', function(data) {
			$('#role_id').val(data[0].id);
			$.each(data[0].permissions, function(i, item) {
				var permission_id = data[0].permissions[i].id;
				$('#permission-check-' + permission_id).prop('checked', true);
			});
		});

  });
</script>
@endpush