<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
    body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #001028;
        background: #FFFFFF; 
        font-size: 14px; 
        font-family: Roboto;
        font-weight:500;
    }

    .header {
      background-color: #7367F0;
      color: #fff;
      height: 90px;
    }

  .header-logo {
    text-align: center;
    font-size: 36px;
    padding: 20px 40px;
  }

  .footer {
    background-color: #7367F0;
    width: 100%;
    height: 90px;
    position: absolute;
    bottom: 0;
    text-align: center;
    color: #fff;
  }   

  .footer-list {
    text-align: center;
    font-size: 36px;
    padding: 30px 40px;
  }

  li {
    list-style: none;
    font-size:10px;
  }

  .footer-list li {
    float: left;
    text-align: center;
  }

    h1 {
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 20px 0 20px 0;
    }                       
    </style>
  </head>
  <body>
      <div class="header">
        <div class="header-logo">
        <img src="{{ url('/assets/images/logo.png') }}" style="width:110px;">
        </div>
      </div>
      <!-- <div id="logo">
        <img src="{{ url('/assets/images/header_invoice.png') }}">
      </div> -->
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
    <main><br>
      <table border="3" bordercolor="#7367F0" style="width:100%; background-color:#FFFFFF; border-collapse: collapse;">
        <thead>
          <tr style="background-color:#D4D0FF;color:#625F6E;">
            <th style="padding: 20px">Program</th>
            <th>Category & Session</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
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
          <!-- <tr>
            <td class="service" style="padding: 30px; text-align: center;">STARCO</td>
            <td class="desc" style="padding: 30px; text-align: center;">Coaching 1 Session</td>
            <td class="unit" style="padding: 30px; text-align: center;">dd/mm/yy</td>
          </tr>
          <tr>
            <td colspan="2" class="grand total" style="padding: 30px; text-align: center;">Total</td>
            <td class="grand total" style="padding: 30px; text-align: center;">Rp.400.000</td>
          </tr> -->
        </tbody>
      </table>
    </main>
    <footer>
    <div class="footer">
      <div class="footer-list">
        <li style="padding: 10px 25px;">PT WAHANA INTEGRA NUSANTARA</li>
        <li style="padding: 10px 25px;"><img src="{{ url('/assets/images/svg/telephone.svg') }}" width="14" height="14">+62 822-3585-0005</li>
        <li style="padding: 10px 25px;"><img src="{{ url('/assets/images/svg/mail.svg') }}" width="14" height="14">halo@cataliz.id</li>
        <li style="text-align:left; padding: 0px 25px;"><img src="{{ url('/assets/images/svg/place.svg') }}" width="14" height="14">Jl. Bend. Palasari No.Kav 5,<br>
        Karangbesuki, Kec. Sukun,<br>Kota Malang, Jawa Timur 65149</li>
      </div>
    </div>
    </footer>
  </body>
</html>
