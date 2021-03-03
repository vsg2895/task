Hello {{$email_data['name']}} {{$email_data['lastname']}}
<br><br>
Welcome to my website
<br>
Please click the bellow link to verify your email and activate your accounte!
<br><br>
<a href="{{route('register.verify')}}?code={{$email_data['verifycation_code']}}">Click Here</a>
<br><br>
Thank You
