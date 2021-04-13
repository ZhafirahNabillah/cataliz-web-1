@extends('layouts.layoutVerticalMenu')

@section('title','Topic')

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
            <h2 class="content-header-title float-left mb-0">Exercise
              <img class="align-text width=" 15px" height="15px"" src=" {{asset('assets\images\icons\popovers.png')}}"
                alt="Card image cap" data-toggle="popover" data-placement="top"
                data-content="Halaman ini menampilkan Exercise yang anda miliki untuk klien ini." />
            </h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Exercise</a>
                </li>
                <li class="breadcrumb-item active">Create Exercise
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Input jumlah Soal</h4>
        <p class="card-text"></p>
        <form>
          <div class="form-row">
            <div class="form-group col-md-8">
              <input type="number" name="" class="input form-control" id="form_numbers"
                placeholder="Enter number of forms" required>
            </div>
            <div class="form-group col-md-4">
              <div class="text-center">
                <button class="btn btn-sm btn-primary generate" type="submit">Generate</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <div class="card ">
      <div class="card-body">
        <form>
          <div class="forms">
          </div>
          <div class="text-left">
            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>



  </div>




  <!-- END: Content-->
  @endsection

  @push('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>


  <script type="text/javascript">
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });

    $(document).ready(function() {
      $('.generate').click(function(e) {
        e.preventDefault();
        let input = $('#form_numbers').val();
        // console.log(input);
        let temp_html = '';
        for (i = 0; i < input; i++) {
          temp_html += '<div class="card "><div class="card-body"><div class="form-group"><label for="">Topic</label><input type="text" class="form-control col-sm-6" id="" aria-describedby="emailHelp" placeholder="Choose your topic"></div><div class="form-group"><label for="">Soal</label><input type="text" class="form-control col-sm-12" id="" placeholder="Input your question..."></div><div class="form-group"><label for="">Answer A</label><input type="text" class="form-control col-sm-6" id="" placeholder="Input your Answer..."></div><div class="form-group"><label for="">Answer B</label><input type="text" class="form-control col-sm-6" id="" placeholder="Input your Answer..."></div><div class="form-group"><label for="">Answer C</label><input type="text" class="form-control col-sm-6" id="" placeholder="Input your Answer..."></div><div class="form-group"><label for="">Answer D</label><input type="text" class="form-control col-sm-6" id="" placeholder="Input your Answer..."></div><div class="form-group"><label for="">Answer E</label><input type="text" class="form-control col-sm-6" id="" placeholder="Input your Answer..."></div></div></div>';
        }
        $('.forms').append(temp_html);
      });
    });


    // popover
    $(function() {
      $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'hover',
        placement: 'top',
        content: function() {
          return '<img src="' + $(this).data('img') + '" />';
        }
      })
    });
  </script>

  @endpush