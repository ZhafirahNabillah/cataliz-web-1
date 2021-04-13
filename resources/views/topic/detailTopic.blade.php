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
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('topic.index')}}">Topic</a>
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
              <a href="{{ route('topic.download', $topic->id) }}" class="btn btn-primary">Download PDF</a>
            </div>
            <div class="card-body">
                <div class="card border">
                  <h5 class="text-center card-title mt-2"><b>{{ $topic->topic }}</b></h5>
                  <div class="card-body">
                    <div class="collapse-icon">
                      <div class="collapse-default">
                        <div class="card">
                          <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
                            data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            <span class="lead collapse-title"><b>Requirement</b></span>
                          </div>
                          <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                            <div class="card-body">
                              {!!$topic->client_requirement!!}
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button"
                            data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            <span class="lead collapse-title"><b>Description</b></span>
                          </div>
                          <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse">
                            <div class="card-body">
                              {!!$topic->description!!}
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div id="headingCollapse3" class="card-header" data-toggle="collapse" role="button"
                            data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            <span class="lead collapse-title"><b>Who Is This Topic For?</b></span>
                          </div>
                          <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse">
                            <div class="card-body">
                              {!!$topic->client_target!!}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><b>Detail Participant</b>
              </h4>
            </div>
            <div class="card-body">
              <!-- Basic table -->
              <section id="basic-datatable">
                <div class="row">
                  <div class="col-12">
                    <table class="datatables-basic table-striped table topic-participant-datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Program</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </section>
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
      });

      var table_topic_participant = $('.topic-participant-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'email',
            name: 'email',
          },
          {
            data: 'program',
            name: 'program',
          },
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          },
          search: "<i data-feather='search'></i>",
          searchPlaceholder: "Search records"
        }
      });
    });
    </script>
    @endpush
