<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cataliz.id - Class Created</title>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:400);

    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    .img-rounded {
      border-radius: 50%;
    }

    .button {
      background-color: #7367F0;
      /* Green */
      border: none;
      color: white;
      padding: 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 15px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 5px;
      outline: none;
      width: 180px;
      height: 40px;
    }

    .iconatas {
      padding-top: 25px;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td,
    h1,
    h2,
    h3 {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }

    table {
      border-collapse: collapse !important;
    }


    h1,
    h2,
    h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }

    h3 {
      color: #21c5ba;
      font-size: 24px;
    }

    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }

    .hide {
      display: none !important;
    }

    .force-full-width {
      width: 100% !important;
    }
  </style>

  <style type="text/css" media="screen">
    @media screen {

      /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
      td,
      h1,
      h2,
      h3 {
        font-family: 'Lato', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }

      table[class="w300"] {
        width: 300px !important;
      }

      table[class="w290"] {
        width: 290px !important;
      }

      td[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"] {
        text-align: center !important;
      }

      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-border"] {
        border: 0 !important;
      }

      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>

<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" bgcolor="#ffffff" width="100%">

        <table cellspacing="0" cellpadding="0" width="100%">
          <center>

            <table cellspacing="0" cellpadding="0" width="600" class="w320">
              <tr>
                <td align="center" valign="top" style="background-color: white;">


                  <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
                    <tr style="padding-left: 20px;">
                      <td style="text-align: center;">
                        <div class="iconatas">
                          <img style="width: 30px;" src="{{ $message->embed(public_path().'/assets/images/icons/email/catalizlogo.png') }}">
                          <img style="width: 70px;padding-bottom: 4px;" src="{{ $message->embed(public_path().'/assets/images/icons/email/cataliz.png') }}">
                        </div>
                      </td>



                    <tr>
                      <td style="text-align: center;background-color: #FCE7B0;">
                        <h1 style="color: black;margin-top: 20px;margin-left: 15px;font-weight: bold;">Removed
                          Successfully</h1>
                        <span style="margin-left: 15px;color: #656565;">You have been successfully removed a client from
                          a coach!</span>
                        <br>
                        <span>&nbsp;</span>
                      </td>
                    </tr>
                    <tr style="height: 10px;">
                      <td style="text-align: left;">

                      </td>
                    </tr>
              </tr>
            </table>

            <table cellspacing="0" cellpadding="15px" class="force-full-width" style="background-color:#3bcdb0;border: 1px solid #9B93EF;margin-top: -51px;">
              <tr>
                <td style="background-color:white;text-align: center;">

                  <table cellspacing="0" cellpadding="0" class="force-full-width">
                    <tr>
                    <tr>
                      <td colspan="3">
                        <!-- Nama user coach -->
                        <h3 style="color: black;">Hai, {{ $email_data['admin_name'] }}</h3>
                        <p style="color: black;">You have been successfully removed :
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td>

                        <img style="text-align: center;width:200px; height:200px;" class="img-rounded" src="{{ $message->embed(public_path().'/assets/images/avatars/1.png') }}" alt="">
                      </td>
                      <td>
                        <p>and</p>
                      </td>
                      <td>

                        <img style="text-align: center;width:200px; height:200px;" class="img-rounded" src="{{ $message->embed(public_path().'/assets/images/avatars/4.png') }}" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td><b style="padding-top: 10px;">{{ $email_data['coach_name'] }}</b></td>
                      <td><br></td>
                      <td>
                        <b style="padding-top: 10px;">{{ $email_data['client_name'] }}</b>
                        <br>
                        <span style="font-size: 12px;">{{ $email_data['client_company'] ?? 'Data not available' }}</span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3">
                        <p>Email notification will be sent to the party concerned. If you don't think you've paired it,
                          please cancel it by accessing the Class menu or clicking on the button below.</p>
                        <div style="padding-top: 10px;">
                          <a href="{{ route('clients.index') }}">
                            <button class="button button1">Go To My Class</button>
                          </a>
                        </div>
                      </td>
                    </tr>
              </tr>
            </table>
            <br>


      </td>
    </tr>
  </table>

  <table cellspacing="0" cellpadding="0px" class="force-full-width" width="100%">
    <tbody>
      <tr style="text-align: center;">
        <br>
      </tr>

    </tbody>
  </table>

  <tr style="background-color: #726F6F;">
    <td valign="top">

      <center>
        <table cellspacing="0" cellpadding="0" width="500" class="w320">
          <tr>
            <td valign="top" style="border-bottom:1px solid #a1a1a1;border-top:1px solid #a1a1a1">


              <table cellspacing="0" cellpadding="0" width="100%">

                <tr>
                  <td style="padding: 30px;" class="mobile-padding">

                    <table class="force-full-width" cellspacing="0" cellpadding="0">
                      <tr>

                        <td style="text-align: center; vertical-align:top;">
                          <span style="color: white;">
                            For further information, please contact email <a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJZdjtXMLCzXZJhvLlxSMhgZZgkCdPTltDMhFmjLSmzsjxLwncvlSPTzgnCJlmhpvrtCcvq">halo@cataliz.id</a>
                            or +62 822-3585-0005
                            on Monday - Friday 09:00 - 18:00 WIB.
                          </span>
                        </td>
                      </tr>
                    </table>

                  </td>
                </tr>

              </table>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td style="background-color:#726F6F;">
      <center>
        <table cellspacing="0" cellpadding="0" width="500" class="w320">
          <tr>
            <td>
              <table cellspacing="0" cellpadding="30" width="100%">
                <tr style="text-align: center;">
                  <td style="">
                    <a href="https://www.instagram.com/cataliz.id/">
                      <img src="{{{{ $message->embed(public_path().'/assets/images/icons/email/white_instagram.png') }}">
                    </a>
                    <a href="https://cataliz.id/">
                      <img src="{{ $message->embed(public_path().'/assets/images/icons/email/white_link.png') }}">
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <center>
                <table style="margin:0 auto;" cellspacing="0" cellpadding="5" width="100%">
                  <tr style="font-size: 10px;">
                    <td style="text-align:center; margin:0 auto;color: white;" width="100%">
                      <p>COPYRIGHT &copy; {{ Carbon\Carbon::now()->year }}
                        Cataliz.id. All Right Reserved
                      </p>

                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
</body>

</html>
