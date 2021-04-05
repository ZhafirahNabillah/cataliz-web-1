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
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('agendas.index')}}">Agenda</a>
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
                  <h4 class="card-title">Create Agenda
                    <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Isilah kolom di bawah ini untuk membuat agenda baru untuk client Anda!" />
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Plan</label>
                      <select class="livesearch-plans form-control @error('plan_id') is-invalid @enderror" name="plan_id"></select>
                      @error('plan_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <!-- Kalo grup -->
                  <div class="row group_id_wrapper" style="display: none">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Group ID</label>
                      <input type="text" id="group_id" name="group_id" class="form-control" disabled>
                    </div>
                  </div>

                  <div class="row client_data_wrapper" style="display: none">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Full Name</label>
                      <input type="text" id="client_name" name="group_id" class="form-control" disabled>
                    </div>
                  </div>

                  <!-- Kalo grup gausa Organitation sama Company -->
                  <div class="row client_data_wrapper" style="display: none">
                    <div class="col-md-6 form-group">
                      <label for="fp-default">Organization</label>
                      <input class="form-control" type="text" value="" id="client_organization" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="fp-default">Company</label>
                      <input class="form-control" type="text" value="" id="client_company" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="fp-default">Number of Session</label>
                      <select class="form-control @error('session') is-invalid @enderror" aria-label=".form-select-lg example" name="session">
                        <option selected value hidden>Select number of session</option>
                        <option value="1" @if (old('session')=='1' ) selected="selected" @endif>Sesi 1</option>
                        <option value="2" @if (old('session')=='2' ) selected="selected" @endif>Sesi 2</option>
                        <option value="3" @if (old('session')=='3' ) selected="selected" @endif>Sesi 3</option>
                        <option value="4" @if (old('session')=='4' ) selected="selected" @endif>Sesi 4</option>
                        <option value="5" @if (old('session')=='5' ) selected="selected" @endif>Sesi 5</option>
                        <option value="6" @if (old('session')=='6' ) selected="selected" @endif>Sesi 6</option>
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
                      <label for="fp-default">Session Type</label>
                      <select class="form-control @error('type_session') is-invalid @enderror" aria-label=".form-select-lg example" name="type_session">
                        <option selected value hidden>Select session type</option>
                        <option value="Free" @if (old('type_session')=='Free' ) selected="selected" @endif>Free</option>
                        <option value="Paid" @if (old('type_session')=='Paid' ) selected="selected" @endif>Paid</option>
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

  <!-- END: Content-->
  @endsection

  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    // popover
    $(function() {
      $('[data-toggle="popover"]').popover()
    })

    // $('.livesearch').select2({
    //   placeholder: 'Select client',
    //   ajax: {
    //     url: "{{route('clients.search')}}",
    //     dataType: 'json',
    //     delay: 250,
    //     processResults: function(data) {
    //       return {
    //         results: $.map(data, function(item) {
    //           console.log(item)
    //           return {
    //             text: item.name,
    //             id: item.id,
    //             org: item.organization,
    //             co: item.company
    //           }
    //         })
    //       };
    //     },
    //     cache: true
    //   }
    // });
    //
    // $(".livesearch").on('change', function(e) {
    //   // Access to full data
    //   console.log($(this).select2('data'));
    //   console.log($(this).select2('data')[0].id);
    //   var dd = $(this).select2('data')[0];
    //   $('#organization').val(dd.org);
    //   $('#company').val(dd.co);
    // });

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
                text: $(item.objective).text() ,
                id: item.id,
                client_id: item.client_id,
                group_id: item.group_id
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
      console.log($(this).select2('data')[0].text);
      var dd = $(this).select2('data')[0];
      if (dd.client_id != null) {
        $(".group_id_wrapper").hide();
        $.get("" + '/get_client_data/' + dd.client_id, function(data) {
          $("#client_name").val(data.name);
          $("#client_organization").val(data.organization);
          $("#client_company").val(data.company);
        });
        $(".client_data_wrapper").show();
      } else if (dd.group_id != null) {
        $(".client_data_wrapper").hide();
        $(".group_id_wrapper").show();
        $("#group_id").val(dd.group_id);
      }
    });
  </script>
  @endpush
