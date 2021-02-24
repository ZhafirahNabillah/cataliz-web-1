@extends('layouts.layoutVerticalMenu')

@section('title','Agendas')

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
            <h2 class="content-header-title float-left mb-0">Agenda</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Agenda</a>
                </li>
                <li class="breadcrumb-item active">Create Agenda
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
      <div class="row">



      </div>
      <!-- Basic table -->
      <section id="basic-datatable">
        <form action="{{ url('/agendas') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Create Agenda</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Plans</label>
                      <select class="livesearch-plans form-control @error('plan_id') is-invalid @enderror" name="plan_id"></select>
                      @error('plan_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Full Name</label>
                      <select class="livesearch form-control @error('client_id') is-invalid @enderror" name="client_id"></select>
                      @error('client_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label for="fp-default">Organization</label>
                      <input class="form-control" type="text" value="" id="organization" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="fp-default">Company</label>
                      <input class="form-control" type="text" value="" id="company" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Pilih Sesi</label>
                      <select class="form-control @error('session') is-invalid @enderror" aria-label=".form-select-lg example" name="session">
                        <option selected value hidden>Pilih Sesi</option>
                        <option value="1">Sesi 1</option>
                        <option value="2">Sesi 2</option>
                        <option value="3">Sesi 3</option>
                        <option value="4">Sesi 4</option>
                        <option value="5">Sesi 5</option>
                        <option value="6">Sesi 6</option>
                      </select>
                      @error('session')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Tipe Sesi</label>
                      <select class="form-control @error('type_session') is-invalid @enderror" aria-label=".form-select-lg example" name="type_session">
                        <option selected value hidden>Pilih Tipe Sesi</option>
                        <option value="Free">Free</option>
                        <option value="Paid">Paid</option>
                      </select>
                      @error('type_session')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
      <!--/ Basic table -->
    </div>
  </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
              co: item.company
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
    $('#company').val(dd.co);
  });

  $('.livesearch-plans').select2({
    placeholder: 'Select plans',
    ajax: {
      url: "{{route('plans.search')}}",
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            console.log(item)
            return {
              text: item.objective,
              id: item.id,
            }
          })
        };
      },
      cache: true
    }
  });

  $(".livesearch-plans").on('change', function(e) {
    // Access to full data
    console.log($(this).select2('data'));
    console.log($(this).select2('data')[0].id);
    var dd = $(this).select2('data')[0];
  });

  $(".")

  $(function() {
    $('#datepicker').datetimepicker({
      daysOfWeekDisabled: [0, 6]
    });
  });
</script>
@endpush