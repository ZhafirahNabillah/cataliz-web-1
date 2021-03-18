<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Example 2</title>
  <style type="text/css">
    @font-face {
      font-family: SourceSansPro;
      src: url(SourceSansPro-Regular.ttf);
    }

    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #0087C3;
      text-decoration: none;
    }

    body {
      position: relative;
      width: 21cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #555555;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 14px;
      font-family: SourceSansPro;
    }

    header {
      padding: 10px 0;
      margin-bottom: 20px;
      border-bottom: 1px solid #AAAAAA;
    }

    #logo {
      float: left;
      margin-top: 8px;
    }

    #logo img {
      height: 70px;
    }

    #company {
      float: right;
      text-align: right;
    }


    #details {
      margin-bottom: 10px;
    }

    #client {
      padding-left: 6px;

      text-align: center;
    }

    #client .to {
      color: #777777;
    }

    h2.name {
      font-size: 1.4em;
      font-weight: normal;
      margin: 0;
    }

    #invoice {
      float: right;
      text-align: right;
    }

    #invoice h1 {
      color: #0087C3;
      font-size: 2.4em;
      line-height: 1em;
      font-weight: normal;
      margin: 0 0 10px 0;
    }

    #invoice .date {
      font-size: 1.1em;
      color: #777777;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table th,
    table td {
      padding: 20px;
      background: white;
      text-align: center;
      border-bottom: 1px solid #FFFFFF;
    }

    table th {
      white-space: nowrap;
      font-weight: normal;
    }

    table td {
      text-align: right;
    }

    table td h3 {
      color: #57B223;
      font-size: 1.2em;
      font-weight: normal;
      margin: 0 0 0.2em 0;
    }

    table .no {
      color: #FFFFFF;
      font-size: 1.6em;
      background: #57B223;
    }

    table .desc {
      text-align: left;
    }

    table .unit {
      background: #DDDDDD;
    }

    table .qty {}

    table .total {
      background: #57B223;
      color: #FFFFFF;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table tbody tr:last-child td {
      border: none;
    }

    table tfoot td {
      padding: 10px 20px;
      background: #FFFFFF;
      border-bottom: none;
      font-size: 1.2em;
      white-space: nowrap;
      border-top: 1px solid #AAAAAA;
    }

    table tfoot tr:first-child td {
      border-top: none;
    }

    table tfoot tr:last-child td {
      color: #57B223;
      font-size: 1.4em;
      border-top: 1px solid #57B223;

    }

    table tfoot tr td:first-child {
      border: none;
    }

    #thanks {
      font-size: 2em;
      margin-bottom: 50px;
    }

    #notices {
      padding-left: 6px;
      border-left: 6px solid #0087C3;
    }

    #notices .notice {
      font-size: 1.2em;
    }

    footer {
      color: #777777;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #AAAAAA;
      padding: 8px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <header class="clearfix" style="background-color: #F9ECC0;">
    <div id="logo" style="padding-left:10px ;">
      <img src="">
    </div>
    <div id="company">
      <div style="padding-right: 10px;">
        <h2 class="name">PT WAHANA INTEGRA <br> NUSANTARA</h2>
        <span> +62 822-3585-0005</span> <img src="icon/telpon.png" alt=""><br>
        <span> halo@cataliz.id</span> <img src="icon/mail.png" alt="">
      </div>
    </div>
  </header>
  <main>
    <div id="details" class="clearfix">
      <div id="client">
        <div class="to">
          <h1 style="color: #C58407;">Tittle</h1>
        </div>
      </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
      <td style="text-align: left;">
        <p style="color: #C58407;font-size:20px ;">Objektif</p>
        <p style="text-align: justify;">{!!$plan->objective!!}
        </p>
        <p style="color: #C58407;font-size:20px ;">Sukses Indikator</p>
        <p style="text-align: justify;">{!!$plan->success_indicator!!}
        </p>
        <p style="color: #C58407;font-size:20px ;">Pengembangan Area</p>
        <p style="text-align: justify;">{!!$plan->development_areas!!}
        </p>
        <p style="color: #C58407;font-size:20px ;">Support</p>
        <p style="text-align: justify;">{!!$plan->support!!}
        </p>
      </td>
    </table>

  </main>
  <footer style="background-color: #F9ECC0;">
    Thanks for using <a href="app.cataliz.id">cataliz.id</a>
  </footer>
</body>

</html>