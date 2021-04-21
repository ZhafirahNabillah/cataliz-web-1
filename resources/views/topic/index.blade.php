@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')
<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Topics
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Halaman ini menampilkan topik-topik yang anda miliki untuk klien Anda." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">Topic
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">

        {{-- Alert for success message --}}
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dissmisable">
          <h4 class="alert-heading">Success</h4>
          <div class="alert-body">{{ $message }}</div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        @endif

        {{-- create topic button --}}
        @can('create-topic')
        <div class="row">
          <div class="col-12">
            <a href={{ route('topic.create')}} class="create-new btn btn-primary">New Topic</a>
          </div>
        </div>
        @endcan
        <br>

        {{-- topic datatable  --}}
        <section id="basic-datatable">
          <div class="row">
            <div class="col-12">
              <table class="datatables-basic table-striped table topic-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Topic</th>
                    <th>Category</th>
                    <th>Sub Topic</th>
                    <th>Participant</th>
                    <th>Action</th>
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
  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
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
    });

    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var table_topic = $('.topic-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
          },
          {
            data: 'topic',
            name: 'topic'
          },
          {
            data: 'category.category',
            name: 'category.category'
          },
          {
            data: 'sub_topic',
            name: 'sub_topic',
            defaultContent: '0'
          },
          {
            data: 'participant',
            name: 'participant',
            defaultContent: '0'
          },
          {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
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

      $('body').on('click', '.deleteTopic', function(e) {

        var topic_id = $(this).data("id");
        console.log(topic_id);
        // ganti sweetalert

        $.ajax({
          type: "DELETE",
          url: "" + '/topic/' + topic_id,
          success: function(data) {
            Swal.fire({
              icon: 'success',
              title: 'Deleted Successfully!',
            });
            table_topic.draw();
          },
          error: function(data) {
            console.log('Error:', data);
          }
        });
      });
    });
  </script>

  @endpush
