<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

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

    header {
        padding: 10px 0;
        margin-bottom: 30px;
    }

    #logo {
        text-align: center;
        margin-bottom: 10px;
    }

    #logo img {
        width: 795px;
        height: 91px;
    }

    #footer img {
        width: 795px;
        height: 71px;
    }

    h1 {
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 20px 0 20px 0;
    }

    footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
    }                           
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ url('/assets/images/header_invoice.png') }}">
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

      <!-- <table>
        <thead>
          <tr>
            <th>Program</th>
            <th>Category & Session</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">STARCO</td>
            <td class="desc">Coaching 1 Session</td>
            <td class="unit">dd/mm/yy</td>
          </tr>
          <tr>
            <td colspan="2" class="grand total">Total</td>
            <td class="grand total">Rp.400.000</td>
          </tr>
        </tbody>
      </table> -->
    </main>
    <footer>
    <div id="footer">
        <img src="{{ url('/assets/images/footer_invoice.png') }}">
    </div>
    </footer>
  </body>
</html>