@extends('layouts.layoutVerticalMenu')

@section('title','Agendas')

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

@include('panels.navbar')

@include('panels.sidemenu_admin')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">User Management</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="alert alert-danger alert-dissmisable fade show p-1" style="display:none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dissmisable">
        <h4 class="alert-heading">Success</h4>
        <div class="alert-body">{{ $message }}</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
      </div>
      @endif

      <div class="row mb-1 no-gutters">
        <div class="col-md-12">
          <a href="{{ url('/agendas/create') }}" class="create-new btn btn-primary">Add New</a>
        </div>
      </div>

      <form action="">
        <div class="row">
          <div class="col-md-12 form-group">
            <label for="fp-default">Users</label>
            <select class="livesearch form-control @error('client_id') is-invalid @enderror" name="user_id"></select>
            @error('user_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </form>

      <!-- Basic table -->
      <section id="basic-datatable">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <table class="datatables-basic table yajra-datatable">
                <thead>
                  <tr>
                    <th colspan="2">Access</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Akses1
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                    <td>Akses2
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <table class="datatables-basic table yajra-datatable">
                <thead>
                  <tr>
                    <th colspan="2">Add Permissions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Name</td>
                    <td>
                      <input class="form-control" type="text" value="" id="">
                    </td>
                  </tr>
                </tbody>
              </table>
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

<script type="text/javascript">
  $('.livesearch').select2({
  placeholder: 'Select roles',
  ajax: {
    url: "{{route('users_search.admin')}}",
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results: $.map(data, function (item) {
          console.log(item)
          return {
            text: item.name,
            id: item.id
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