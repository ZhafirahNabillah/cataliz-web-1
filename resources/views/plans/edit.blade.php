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
                <input type="hidden" name="id" value="{{ $plan->id }}">
                {{-- <input type="hidden" name="group_id" value="{{ $plan->group_id }}"> --}}
                <div class="form-group">
                  <label class="fp-default" for="basic-icon-default-fullname">Client Name</label>
                  <!-- nanti di checklist coachee yang masuk ke kelas ininya -->
                  {{-- <input id="search" type="text" class="form-control" placeholder="Search client name..." /> --}}


                  {{-- @foreach ($all_clients as $client)
                    <div class="form-check client-list">
                      <input class="form-check-input" type="checkbox" value="{{ $client->id }}" name="client[]"
                  id="client-{{ $client->id }}" @if($clients->contains($client->id)) checked @endif>
                  <label class="form-check-label" for="client-{{ $client->id }}">
                    {{ $client->name }}
                  </label>
                </div>
                @endforeach --}}

                <select id="state" class="livesearch-plans form-control" @error('plan_id') is-invalid @enderror
                  name="client[]" multiple="multiple">
                  @foreach ($all_clients as $client)
                  <option hidden id="client-{{ $client->id }}" value="{{ $client->id }}" @if($clients->
                    contains($client->id)) selected @endif>{{ $client->name }}</option>
                  @endforeach
                </select>
                <div id="client-error"></div>
                {{-- <input type="hidden" name="client_length" id="client_length"> --}}
              </div>

              <div class="row group_wrapper" style="display: none;">
                <div class="col-md-12 form-group">
                  <label for="fp-default">Group Code</label>
                  <input type="text" class="form-control @error('group_code') is-invalid @enderror" name="group_code" id="group_code" value="{{ $plan->group_id }}" placeholder="Fill group code here..">
                  <small><strong>group code can consist of number and character</strong></small>
                  <div id="group_code-error"></div>
                  {{-- @error('group_code')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="fp-default">Date</label>
                  <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                    value="{{ $plan->date }}" placeholder="Select your date...">
                  <div id="date-error"></div>
                  {{-- @error('date')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="fp-default">objective</label>
                  <textarea class="form-control @error('objective') is-invalid @enderror" name="objective"
                    id="objective" autocomplete="objective">{{ $plan->objective }}
                    </textarea>
                  <small id="character_count_objective" class="float-right"></small>
                  {{-- <input type="hidden" name="objective_length" id="objective_length"> --}}
                  <div id="objective-error"></div>
                  {{-- @error('objective')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="fp-default">Success Indicator</label>
                  <textarea class="form-control @error('success_indicator') is-invalid @enderror"
                    name="success_indicator" id="success_indicator"
                    autocomplete="success_indicator">{{ $plan->success_indicator }}</textarea>
                  <small id="character_count_success_indicator" class="float-right"></small>
                  {{-- <input type="hidden" name="success_indicator_length" id="success_indicator_length"> --}}
                  <div id="success_indicator-error"></div>
                  {{-- @error('success_indicator')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="fp-default">Development Areas</label>
                  <textarea class="form-control @error('development_areas') is-invalid @enderror"
                    name="development_areas" id="development_areas"
                    autocomplete="development_areas">{{ $plan->development_areas }}</textarea>
                  <small id="character_count_development_areas" class="float-right"></small>
                  {{-- <input type="hidden" name="development_areas_length" id="development_areas_length"> --}}
                  <div id="development_areas-error"></div>
                  {{-- @error('development_areas')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="fp-default">Support</label>
                  <textarea class="form-control @error('support') is-invalid @enderror" name="support" id="support"
                    autocomplete="support">{{ $plan->support }}</textarea>
                  <small id="character_count_support" class="float-right"></small>
                  {{-- <input type="hidden" name="support_length" id="support_length"> --}}
                  <div id="support-error"></div>
                  {{-- @error('support')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
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
<script src="https://cdn.tiny.cloud/1/8kkevq83lhact90cufh8ibbyf1h4ictwst078y31at7z4903/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<style>
  label.error.fail-alert {
    color: red;
  }
</style>
<script type="text/javascript">
  $("#state").select2({
      tags: true,
      placeholder: 'Select users',
      ajax: {
        url: "{{route('users.search')}}",
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: $.map(data, function(item) {
              console.log(item)
              return {
                text: item.name,
                id: item.id,
                client_id : item.client_id,
              }
            })
          };
        },
        cache: true
      }
    });

    $(document).ready(function() {
      var count = $('#state :selected').length;
      // console.log(count);
      if (count > 1) {
        $('.group_wrapper').show(500);
        $("#group_code").prop('disabled', false);
      } else {
        $('.group_wrapper').hide(500);
        $("#group_code").prop('disabled', true);
        $('#group_code-error').empty();
      }
    });

    $('#state').on('select2:close', function(evt) {
      var count = $(this).select2('data').length;
      if (count > 1) {
        $('.group_wrapper').show(500);
        $("#group_code").prop('disabled', false);
      } else {
        $('.group_wrapper').hide(500);
        $("#group_code").prop('disabled', true);
        $('#group_code-error').empty();
      }
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
          editor.on('init', function () {
            var count = CountCharacters(editor.id);
            $('#character_count_'+editor.id).html("<strong>" + count + "</strong>");
            tinymce.triggerSave();
          });

          editor.on('click', function () {
            tinymce.triggerSave();
          });

          editor.on('keyup', function(e) {
            var original_element = $(tinyMCE.activeEditor.getElement());
            var element_id = original_element.attr('id');
            var count = CountCharacters(element_id);
            $('#character_count_'+element_id).html("<strong>" + count + "</strong>");
            tinymce.triggerSave();
          });
        }
      });

      // $('#saveBtn').click(function(e) {
      //   $('#plan_form').validate({
      //     rules: {
      //       'client_id': {
      //         required: true
      //       },
      //       'date': {
      //         required: true
      //       }
      //     },
      //     messages: {
      //       'client_id': {
      //         required: '<strong class="text-danger">Name is required!</strong>'
      //       },
      //       'date': {
      //         required: '<strong class="text-danger">date is required!</strong>'
      //       }
      //     },
      //     errorPlacement: function(error, element) {
      //       if (element.attr("name") == "date") {
      //         error.appendTo("#date-error");
      //       } else if (element.attr("name") == "client_id") {
      //         error.appendTo("#client_id-error");
      //       }
      //     },
      //     //submit Handler
      //     submitHandler: function(form) {
      //       form.submit();
      //     }
      //   });
      //   console.log('loaded');
      // });

      $("#saveBtn").click(function(e) {
        e.preventDefault();
        // var client_length = parseInt($("#state").val().length);
        // console.log(client_length);
        // $('#client_length').val(client_length);
        $('#saveBtn').html('Sending..');
        $('#client-error').empty();
        $('#group_code-error').empty();
        $('#date-error').empty();
        $('#objective-error').empty();
        $('#success_indicator-error').empty();
        $('#development_areas-error').empty();
        $('#support-error').empty();

        var data = $('#plan_form').serialize();
        console.log(data);

        $.ajax({
          data: data,
          url: "{{ route('plans.store') }}",
          type: "POST",
          dataType: 'json',
          success: function(data) {

            $('#saveBtn').html('Submit');
            window.location = "{{ route('plans.index') }}"
            // if ($('#action_type').val() == 'create-user') {
            //   Swal.fire({
            //     icon: 'success',
            //     title: 'Account created successfully!',
            //   });
            // } else if ($('#action_type').val() == 'edit-user') {
            //   Swal.fire({
            //     icon: 'success',
            //     title: 'Account updated successfully!',
            //   });
            // }
            // table_coach.draw();
            // table_admin.draw();
            // table_coachee.draw();
          },
          error: function(reject) {
            $('#saveBtn').html('Submit');
            if (reject.status === 422) {
              var errors = JSON.parse(reject.responseText);
              if (errors.client) {
                $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
              }
              if (errors.group_code) {
                $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
              }
              if (errors.date) {
                $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
              }
              if (errors.objective) {
                $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
              }
              if (errors.success_indicator) {
                $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
              }
              if (errors.development_areas) {
                $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
              }
              if (errors.support) {
                $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
              }
            }
          }
        });
        /**Ajax code ends**/
      });

      today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      $('#date').datepicker({
        format: 'yyyy-mm-dd',
        minDate: today,
        uiLibrary: 'bootstrap4'
      });
    });

    function CountCharacters(id) {
      var body = tinymce.get(id).getBody();
      var content = tinymce.trim(body.innerText || body.textContent);
      return content.length;
    };

</script>
@endpush
