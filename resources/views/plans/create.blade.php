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
            <h2 class="content-header-title float-left mb-0">Coaching Plans</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Coaching Plans</a>
                </li>
                <li class="breadcrumb-item active">Create Coaching Plans
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Create Plan</h4>
            </div>
            <form action="{{url('/plans')}}" id="plan_form" method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label class="fp-default" for="basic-icon-default-fullname">Client Name</label>
                  <!-- nanti di checklist coachee yang masuk ke kelas ininya -->

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="" id="">
                    <label class="form-check-label" for="">

                    </label>
                  </div>

                  @error('')
                  <strong class="text-danger">{{ $message }}</strong>
                  @enderror
                </div>

                <div class="row">

                  <div class="col-md-12 form-group">
                    <label for="fp-default">Tanggal Kegiatan</label>
                    <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date') }}">
                    <div id="date-error"></div>
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="fp-default">Objektif</label>
                    <textarea class="form-control @error('objective') is-invalid @enderror" name="objective" id="objective" value="{{ old('objective') }}" autocomplete="objective">{{ old('objective') }}
                    </textarea>
                    <small id="character_count_objective" class="float-right"></small>
                    <div id="objective-error"></div>
                    @error('objective')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="fp-default">Sukses Indikator</label>
                    <textarea class="form-control @error('success_indicator') is-invalid @enderror" name="success_indicator" id="success_indicator" autocomplete="success_indicator">{{ old('success_indicator') }}</textarea>
                    <small id="character_count_success_indicator" class="float-right"></small>
                    <div id="success_indicator-error"></div>
                    @error('success_indicator')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="fp-default">Pengembangan Area</label>
                    <textarea class="form-control @error('development_areas') is-invalid @enderror" name="development_areas" id="development_areas" autocomplete="development_areas">{{ old('development_areas') }}</textarea>
                    <small id="character_count_development_areas" class="float-right"></small>
                    <div id="development_areas-error"></div>
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
                    <textarea class="form-control @error('support') is-invalid @enderror" name="support" id="support" autocomplete="support">{{ old('support') }}</textarea>
                    <small id="character_count_support" class="float-right"></small>
                    <div id="support-error"></div>
                    @error('support')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <button type="submit" class="btn btn-primary data-submit mr-1" id="saveBtn" value="create">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Content-->
  @endsection

  @push('scripts')
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <style>
    label.error.fail-alert {
      color: red;
    }
  </style>
  <script type="text/javascript">
    $('.livesearch').select2({
      placeholder: 'Select client',
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
    });

    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      tinymce.init({
        selector: 'textarea',
        setup: function(editor) {
          editor.on('keyup', function(e) {
            var original_element = $(tinyMCE.activeEditor.getElement());
            var element_id = original_element.attr('id');
            var count = CountCharacters();
            if (count > 255) {
              document.getElementById("character_count_" + element_id).innerHTML = "<strong class = 'text-danger'>" + count + "/255</strong>";
            } else {
              document.getElementById("character_count_" + element_id).innerHTML = "<strong>" + count + "/255</strong>";
            }
          });
        }
      });

      $('#saveBtn').click(function(e) {
        $('#plan_form').validate({
          rules: {
            'client_id': {
              required: true
            },
            'date': {
              required: true
            }
          },
          messages: {
            'client_id': {
              required: '<strong class="text-danger">Name is required!</strong>'
            },
            'date': {
              required: '<strong class="text-danger">date is required!</strong>'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "date") {
              error.appendTo("#date-error");
            } else if (element.attr("name") == "client_id") {
              error.appendTo("#client_id-error");
            }
          },
          //submit Handler
          submitHandler: function(form) {
            form.submit();
          }
        });
        console.log('loaded');
      });

      today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#date').datepicker({
        format: 'yyyy-mm-dd',
        minDate: today,
        uiLibrary: 'bootstrap4'
      });
    });

    function CountCharacters() {
      var body = tinymce.activeEditor.getBody();
      var content = tinymce.trim(body.innerText || body.textContent);
      return content.length;
    };
  </script>
  @endpush