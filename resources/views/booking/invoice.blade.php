<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Booking Invoice</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 17cm;  
      height: 29.7cm; 
      margin: 0 auto; 
      color: #001028;
      background: #FFFFFF; 
      font-family: Arial, sans-serif; 
      font-size: 12px; 
      font-family: Arial;
    }

    header {
      padding: 10px 0;
      margin-bottom: 30px;
    }

    #logo {
      text-align: center;
      background-color:#7367F0;
      height: 70px;
    }

    #logo img {
      width: 90px;
      padding: 10px 0;
    }

    h1 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: url(dimension.png);
    }

    #project {
      float: left;
    }

    #project span {
      color: #5D6975;
      text-align: right;
      width: 52px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.8em;
    }

    #company {
      float: right;
      text-align: right;
    }

    #project div,
    #company div {
      white-space: nowrap;        
    }

    #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
    }

    footer {
        background-color:#7367F0;
        height: 90px;
        position: absolute;
        bottom: 0;
        text-align: center;
        color: #fff;
      }

      li {
        list-style: none;
        font-size:10px;
      }
      .footer-list li {
        float: left;
        text-align: center;
      }

    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <!-- <img src="logo.png"> -->
        <img src="{{ url('/assets/images/logo.png') }}" style="width:100px;">
      </div>
      <h1>BOOKING DEMO</h1>
      <div id="detail">
        <table border="0">
          <tbody>
            <tr><td>Code Booking </td><td>:</td><td>{{$code}}</td></tr>
            <tr><td>Name</td><td>:</td><td>{{$name}}</td></tr>
            <tr><td>Email</td><td>:</td><td>{{$email}}</td></tr>
            <tr><td>Phone</td><td>:</td><td>{{$whatsapp_number}}</td></tr>
            <tr><td>Address</td><td>:</td><td>{{$address}}</td></tr>
            <tr><td>Instance</td><td>:</td><td>{{$instance}}</td></tr>
            <tr><td>Status</td><td>:</td><td>{{$status}}</td></tr>
          </tbody>
      </table>
      </div>
    </header>
    <main>
    <table border="3" bordercolor="#7367F0" style="width:100%; background-color:#FFFFFF; border-collapse: collapse;">
      <tr style="background-color:#D4D0FF;color:#625F6E;">
      <th style="padding: 20px">Program</th><th>Category & Session</th><th>Date</th>
      </tr>
      <tr>

        <td style="padding: 30px; text-align: center;">  
        @foreach ($book_demo as $dataDemo=>$program)
        {{$program}}
        @endforeach</td>
      
        @if($session_coaching != 0)
        <td style="padding: 30px; text-align: center;">
        {{$session_coaching}}</td>
        @elseif($session_training != 0)
        <td style="padding: 30px; text-align: center;">
        {{$session_training}}</td>
        @elseif($session_mentoring != 0)
        <td style="padding: 30px; text-align: center;">
        {{$session_mentoring}}</td>
        @endif
  
        <td style="padding: 30px; text-align: center;">{{$book_date}}</td>
      </tr>
      <tr>
        <td colspan="2" style="border-left: 0px;"></td>
        <td style="padding: 10px; background-color:#7367F0; color:#FFFFFF">Total : {{$price}}</td>
      </tr>
    </table>
    </main>
    <footer>
      <div class="footer-list" style="padding-left:20px">
        <li style="padding: 35px 15px;">PT WAHANA INTEGRA NUSANTARA</li>
        <li style="padding: 35px 15px;"><img src="{{ url('/assets/images/svg/telephone.svg') }}" width="14" height="14">+62 822-3585-0005</li>
        <li style="padding: 35px 15px;"><img src="{{ url('/assets/images/svg/mail.svg') }}" width="14" height="14">halo@cataliz.id</li>
        <li style="text-align:left; padding: 25px 15px;"><img src="{{ url('/assets/images/svg/place.svg') }}" width="14" height="14">Jl. Bend. Palasari No.Kav 5,<br>
        Karangbesuki, Kec. Sukun,<br>Kota Malang, Jawa Timur 65149</li>
      </div>
    </footer>
  </body>
</html>