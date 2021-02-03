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
                                    <li class="breadcrumb-item active">Edit Agenda
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
                  <form action="{{ url('/agendas')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              <div class="card-header">
									              <h4 class="card-title">Edit Agenda</h4>
								            </div>
								            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label for="fp-default">Full Name</label>
                                  <select class="livesearch form-control" name="client_id"></select>
                                  <input type="hidden" name="id" value="{{$agenda->id}}">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label for="fp-default">Pilih Sesi</label>
                                  <select class="form-control" aria-label=".form-select-lg example" name="session">
                                    <option selected>Pilih Sesi</option>
                                    <option value="1" @if($agenda->session == 1) selected @endif>Sesi 1</option>
                                    <option value="2" @if($agenda->session == 2) selected @endif>Sesi 2</option>
                                    <option value="3" @if($agenda->session == 3) selected @endif>Sesi 3</option>
                                    <option value="4" @if($agenda->session == 4) selected @endif>Sesi 4</option>
                                    <option value="5" @if($agenda->session == 5) selected @endif>Sesi 5</option>
                                    <option value="6" @if($agenda->session == 6) selected @endif>Sesi 6</option>
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 form-group">
                                  <label for="fp-default">Tipe Sesi</label>
                                  <select class="form-control" aria-label=".form-select-lg example" name="type_session">
                                    <option selected>Pilih Tipe Sesi</option>
                                    <option value="Free" @if($agenda->type_session == 'Free') selected @endif>Free</option>
                                    <option value="Paid" @if($agenda->type_session == 'Paid') selected @endif>Paid</option>
                                  </select>
                                </div>
                                <div class="col-md-6 form-group">
                                  <label for="fp-default">Tanggal Kegiatan</label>
                                  <input type="date" id="datepicker" class="form-control" name="date" value="{{ $agenda->date }}"></input>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label class="form-label" for="basic-icon-default-fullname">Durasi</label>
                                  <input name="duration" type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Masukkan Lama Durasi Sesinya" value="{{ $agenda->duration }}"/>
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
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
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

  $(".")

  $(function () {
        $('#datepicker').datetimepicker({
          daysOfWeekDisabled: [0, 6]
        });
  });

 </script>
 @endpush
