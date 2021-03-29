<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400&display=swap');

      *{
        margin: 0;
        font-family: 'Roboto', sans-serif;
      }

      @page{
        margin: 0 0 0 0;
      }

      div.header {
          display: block;
          text-align: center;
          position: running(header);
          background-color: #fcce03;
          border-bottom: 2px solid black;
      }
      div.footer {
          display: block;
          text-align: center;
          position: running(footer);
      }
      @page {
          @top-center { content: element(header) }
      }
      @page {
          @bottom-center { content: element(footer) }
      }
    </style> --}}

    <style>
        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @page {
            margin: 0cm 0cm;
        }

        @font-face {
          font-family: 'Open Sans';
          font-style: normal;
          font-weight: normal;
          src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
            font-family: "Open Sans";
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;

            /** Extra personal styles **/
            background-color: #e6a42c;
            color: white;
            text-align: right;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            background-color: #e6a42c;
            color: white;
            text-align: center;
        }

        h1 {
          font-family: "Open Sans" !important;
          margin-bottom: 0;
        }

        td {
          padding: 0 !important;
        }
    </style>
</head>

<body>

    <!-- Define header and footer blocks before your content -->
    <header>
      <div class="header-content" style="padding: 0.5cm">
        <h1>PT WAHANA INTEGRA NUSANTARA</h1>
        <span>Telp: +62 822-3585-0005 | Email: halo@cataliz.id</span>
      </div>
    </header>

    <footer>
        Copyright &copy; <?php echo date("Y");?>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
      <table class="table table-borderless">
          <thead>
              <tr class="text-center">
                  <th scope="col">
                    <h4 class="mb-0 p-1">Plans Detail</h4>
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <td scope="col">
                  <h5 class="mb-0"><strong>Objective</strong></h5>
                  {!! $plan->objective !!}
                </td>
              </tr>
              <tr>
                <td scope="col">
                  <h5 class="mb-0"><strong>Success Indicator</strong></h5>
                  {!! $plan->success_indicator !!}
                </td>
              </tr>
              <tr>
                <td scope="col">
                  <h5 class="mb-0"><strong>Development Areas</strong></h5>
                  {!! $plan->development_areas !!}
                </td>
              </tr>
              <tr>
                <td scope="col">
                  <h5 class="mb-0"><strong>Support</strong></h5>
                  {!! $plan->support !!}
                </td>
              </tr>
          </tbody>
      </table>
    </main>
</body>
