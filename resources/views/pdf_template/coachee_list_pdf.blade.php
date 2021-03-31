<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400&display=swap');


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

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;

            /** Extra personal styles **/
            background-color: #F8E9C6;
            color: #625F6E;
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
            background-color: #F8E9C6;
            color: #625F6E;
            text-align: center;
        }

        td {
            padding: 0 !important;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-content" style="padding: 0.5cm">
            <h2>PT WAHANA INTEGRA NUSANTARA</h2>
            <span>Phone: +62 822-3585-0005 | Email: halo@cataliz.id</span>
        </div>
    </header>

    <footer>
        Copyright &copy; <?php echo date("Y"); ?> Cataliz.id. All Right Reserved
    </footer>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Coachee List</h2>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coachee as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- <script src="{{ asset('js/app.js') }}" type="text/js"></script> --}}
</body>

</html>