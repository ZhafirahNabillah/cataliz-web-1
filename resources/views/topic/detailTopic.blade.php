@extends('layouts.layoutVerticalMenu')

@section('title','Coaching Plan')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
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
                <p class="text-center">Category : {{ $category }}</p>
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
          <ul class="nav nav-tabs justify-content-center pt-1" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#participant" aria-controls="coach"
                role="tab" aria-selected="true">Participant</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sub-topic" aria-controls="profile"
                role="tab" aria-selected="false">Sub Topic</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="participant" aria-labelledby="participant-tab" role="tabpanel">
              <div class="card-header py-0">
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
            <div class="tab-pane" id="sub-topic" aria-labelledby="sub-topic-tab" role="tabpanel">
              <div class="card-body">
                <div class="row mb-1">
                  <div class="col-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" id="add-sub-topic-btn">
                      New Sub Topic
                    </button>
                  </div>
                </div>
                <div class="card border">
                  <div class="card-body">
                    <div class="collapse-icon">
                      <div class="collapse-default sub-topic-wrapper">
                        @forelse ($sub_topics as $sub_topic)
                        <div class="card">
                          <div class="card-header" data-toggle="collapse" role="button"
                            data-target="#sub-topic-{{ $sub_topic->id }}" aria-expanded="false"
                            aria-controls="collapse1">
                            <span class="lead collapse-title"><b>{{ $sub_topic->sub_topic }}</b></span>
                          </div>
                          <div id="sub-topic-{{ $sub_topic->id }}" role="tabpanel" class="collapse">
                            <div class="card-body">
                              <div class="text-left">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                  data-target="#createMateri">
                                  New Materi
                                </button>
                              </div>
                              <div class="row mb-1 align-items-center">
                                <div class="col-sm-4">
                                  <b>pembukaan</b>
                                </div>
                                <div class="col-sm-4">
                                  <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#createMateri">
                                    Lihat video
                                  </button>
                                  <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#createMateri">
                                    Edit Materi
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @empty
                        <div class="sub-topic-empty">
                          No sub topic available
                        </div>
                        @endforelse
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- modal create sub topic -->
              <div class="modal fade" id="create-sub-topic-modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create Sub Topic</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="create-sub-topic-form">
                        <div class="form-group">
                          <label for="sub_topic">Name</label>
                          <input class="form-control" type="text" name="sub_topic" placeholder="Your Sub Topic Here...">
                          <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="save-sub-topic-btn">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- modal create Materi -->
              <!-- Modal -->
              <div class="modal fade" id="createMateri" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Create Materi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label for="topic">Materi</label>
                        <input class="form-control" type="text" name="topic" value="" placeholder="Tittle ...">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Upload Video</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <button type="button" name="button" class="btn btn-secondary" id="addQuestionBtn">+ Add
                        materi</button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
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

        $('#add-sub-topic-btn').click(function () {
          $('#create-sub-topic-modal').modal('show');
        });

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('#save-sub-topic-btn').click(function () {
          var data = $('.create-sub-topic-form').serialize();
          console.log(data);

          $.ajax({
            data: data,
            url: "{{ route('sub-topic.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
              console.log(data);
              $('#create-sub-topic-modal').modal('hide');
              $('.create-sub-topic-form').trigger("reset");
              $('.sub-topic-empty').empty();
              append_sub_topic(data.id, data.sub_topic);
              Swal.fire({
                icon: 'success',
                title: 'Account updated successfully!',
              });
            },
            error: function(reject) {
              $('#saveBtn').html('Submit');
              // if (reject.status === 422) {
              //   var errors = JSON.parse(reject.responseText);
              //   if (errors.name) {
              //     $('#name-error').html('<strong class="text-danger">' + errors.name[0] + '</strong>'); // and so on
              //   }
              //   if (errors.phone) {
              //     $('#phone-error').html('<strong class="text-danger">' + errors.phone[0] + '</strong>'); // and so on
              //   }
              //   if (errors.email) {
              //     $('#email-error').html('<strong class="text-danger">' + errors.email[0] + '</strong>'); // and so on
              //   }
              //   if (errors.roles) {
              //     $('#roles-error').html('<strong class="text-danger">' + errors.roles[0] + '</strong>'); // and so on
              //   }
              // }
            }
          });
        });

        function append_sub_topic(id, sub_topic) {
          var sub_topic_html = '<div class="card">';
          sub_topic_html+= '<div class="card-header" data-toggle="collapse" role="button" data-target="#sub-topic-'+ id +'" aria-expanded="false" aria-controls="collapse1"><span class="lead collapse-title"><b>'+ sub_topic +'</b></span></div>';
          sub_topic_html+= '<div id="sub-topic-'+ id +'" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">';
          sub_topic_html+= '<div class="card-body">';
          sub_topic_html+= '<div class="text-left"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMateri">New Materi</button></div>';
          sub_topic_html+= '<div class="row mb-1 align-items-center">';
          sub_topic_html+= '<div class="col-sm-4"><b>pembukaan</b></div>';
          sub_topic_html+= '<div class="col-sm-4">';
          sub_topic_html+= '<button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#createMateri">Lihat video</button>';
          sub_topic_html+= '<button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#createMateri">Edit Materi</button>';
          sub_topic_html+= '</div>';
          sub_topic_html+= '</div>';
          sub_topic_html+= '</div>';
          sub_topic_html+= '</div>';
          sub_topic_html+= '</div>';

          $('.sub-topic-wrapper').append(sub_topic_html);
        }
      });
  </script>
  @endpush