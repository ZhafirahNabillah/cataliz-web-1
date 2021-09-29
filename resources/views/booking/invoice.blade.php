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

    a {
        color: #5D6975;
        text-decoration: underline;
    }

    body {
        position: relative;
        width: 21cm;  
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

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: center;
    }

    table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
    }

    table .service,
    table .desc {
        text-align: left;
    }

    table td {
        padding: 20px;
        text-align: right;
    }

    table td.service,
    table td.desc {
        vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table td.grand {
        border-top: 1px solid #5D6975;;
    }

    #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
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
      <div id="project">
        <div>Code Booking</div>
        <div>Name</div>
        <div>Email</div>
        <div>Phone</div>
        <div>Address</div>
        <div>Instance</div>
        <div>Status</div>
      </div>
    </header>
    <main>
      <table>
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
      </table>
    </main>
    <footer>
    <div id="footer">
        <img src="{{ url('/assets/images/footer_invoice.png') }}">
    </div>
    </footer>
  </body>
</html>