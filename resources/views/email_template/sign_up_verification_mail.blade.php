Hello {{$email_data['name']}}
<br><br>
Selamat datang di Sepangan.com!
<br>
Untuk melakukan aktivasi pada akun anda silahkan klik link dibawah ini!
<br><br>
<a href="{{ url('/verify?code='.$email_data['verification_code']) }}">Verifikasi Disini</a>

<br><br>
Terimakasih!
<br>
Sepangan.com - 2020
