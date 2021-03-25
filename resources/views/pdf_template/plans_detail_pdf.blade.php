<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Plans</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style type="text/css" media="all">
    body {
      height: 842px;
      width: 595px;
      /* to centre page on screen*/
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>

<body>
  <main role="main" class="container tex">
    <!-- head -->
    <div class="container">
      <tr>
        <td>
          <div class="container" style="margin-top: 20px;margin-left: 10px;">
            <div style="margin-bottom: 15px;" class="float-right text-right">
              <h2 class="name">PT WAHANA INTEGRA <br> NUSANTARA</h2>
              <span> +62 822-3585-0005
                <img src="{{ public_path().'/assets/images/icons/pdf/telpon.png' }}" alt="">
              </span>
              <br>
              <span> halo@cataliz.id
                <img src="{{ public_path().'/assets/images/icons/pdf/mail.png' }}" alt="">
              </span>
            </div>

            <h1 class="text-left"><img style="width:170px;margin-top: 10px;margin-left: 15px; " src="">
            </h1>
        </td>
      </tr>
    </div>
    <hr color="#C58407" />

    <div class="container">
      <!-- objective -->
      <div class="row">
        <div class="col-12">
          <div class="card bg-faded">
            <div class="card-header">
              <b>Objective</b>
            </div>
            <br>
            <div class="card-body">
              <p>{!!$plan->objective!!}</p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- success indicator -->
      <div class="row">
        <div class="col-12">
          <div class="card bg-faded">
            <div class="card-header">
              <b>Success Indicator</b>
            </div>
            <br>
            <div class="card-body">
              <p>{!!$plan->success_indicator!!}</p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Development areas -->
      <div class="row">
        <div class="col-12">
          <div class="card bg-faded">
            <div class="card-header">
              <b>Development Areas</b>
            </div>
            <br>
            <div class="card-body">
              <p>{!!$plan->development_areas!!}</p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Support -->
      <div class="row">
        <div class="col-12">
          <div class="card bg-faded">
            <div class="card-header">
              <b>Support</b>
            </div>
            <br>
            <div class="card-body">
              <p>{!!$plan->support!!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <footer>
      <table align="center" style="width: 100%;background-color: #656565;">
        <tr style="text-align: center;height: 100px;">
          <td style="">
            <a href="https://www.instagram.com/cataliz.id/">
              <img style="padding-right: 10px;" src="{{ public_path().'/assets/images/icons/email/blackinstagram.png' }}">
            </a>
            <a href="https://cataliz.id/">
              <img style="padding-left: 10px;" src="{{ public_path().'/assets/images/icons/email/blacklink.png' }}">
            </a>
          </td>
        </tr>
      </table>
    </footer>
  </main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>