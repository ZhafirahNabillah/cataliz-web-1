<h1>BOOKING INVOICE</h1><br>

<p>Code Booking: {{$code}}</p>
<p>Nama: {{$name}}</p>
<p>Email: {{$email}}</p>
<p>Profession: {{$profession}}</p>
<p>Phone: {{$whatsapp_number}}</p>
<p>Instance: {{$instance}}</p>
<p>Address: {{$address}}</p>
<p>Goals: {{$goals}}</p>
<p>Date: {{$book_date}}</p>
<p>Program: {{$program}}</p>

@foreach($book_demo as $dataDemo=>$value)
<p>Category: {{$value}}</p>
@endforeach

@if($session_coaching != 0)
<p>Session Coaching: {{$session_coaching}} Session</p>
@elseif($session_training != 0)
<p>Session Training: {{$session_training}} Session</p>
@elseif($session_mentoring != 0)
<p>Session Mentoring: {{$session_mentoring}} Session</p>
@endif

<p>Price: {{$price}}</p>