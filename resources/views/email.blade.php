<img class="img-fluid" src=" {{asset('assets\images\icons\email\icon.png')}}" alt="Card image cap" />
Hello {{$email_data['name']}}
<br><br>
FORGOT
<br>
YOUR PASSWORD?
<br>
Not to worry, we got you! Let’s create a new password!
<br><br>
<a href="{{ url('/reset?code='.$email_data['reset_code']) }}">Reset Password</a>

<br><br>
Terimakasih!
<br>
Cataliz.id - 2021