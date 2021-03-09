<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="card">
      <h4>Plan Detail</h4>
      <div class="row mb-2">
        <div class="col-sm-3">
          <b>Client Name</b>
        </div>
        <div class="col-sm-9">
          {{$coachee->name}}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-3">
          <b>Coach Name</b>
        </div>
        <div class="col-sm-9">
          {{$coach->name}}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-3">
          <b>Organization</b>
        </div>
        <div class="col-sm-9">
          {{$coachee->organization}}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-3">
          <b>Date</b>
        </div>
        <div class="col-sm-9">
          {{$plan->date}}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-12">
          <b>Objective</b>
        </div>
        <div class="col-sm-12">
          {!!$plan->objective!!}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-12">
          <b>Succes Indicator</b>
        </div>
        <div class="col-sm-12">
          {!!$plan->success_indicator!!}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-12">
          <b>Development Areas</b>
        </div>
        <div class="col-sm-12">
          {!!$plan->development_areas!!}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-sm-12">
          <b>Support</b>
        </div>
        <div class="col-sm-12">
          {!!$plan->support!!}
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
