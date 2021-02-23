Hello {{$email_data['name']}}
<br><br>
Selamat datang di Cataliz.id!
<br>
Akun anda telah sukses dibuat! Kami merekomendasikan anda untuk segera melakukan reset password pada link dibawah
<br><br>
<a href="{{ url('/reset?code='.$email_data['reset_code']) }}">Reset Password</a>

<br><br>
Terimakasih!
<br>
Cataliz.id - 2021
