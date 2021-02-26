<img class="img-fluid" src=" {{asset('assets\images\icons\email\icon.png')}}" alt="Card image cap" />
Hello {{$email_data['name']}}
<br><br>
Your Account has been succesfully created
<br>
<br>
Please reset your password to keep your account protected
<br><br>
<a href="{{ url('/reset?code='.$email_data['reset_code']) }}">Reset Password</a>

<br><br>
Terimakasih!
<br>
Cataliz.id - 2021
