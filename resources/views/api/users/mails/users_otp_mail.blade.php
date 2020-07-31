<!DOCTYPE html>
<html>
<head>
    <title>Trouver</title>
</head>
<body>
    <p>Here, we are sending you <b>{{ $data['type'] }}</b>. Please, do not share this otp with anyone. This may cause security compromisation. Your OTP is <b>{{ $data['otp'] }}</b> here. This OTP will expire in 5 Minutes.</p>
    {{-- <h1>{{ $details['title'] }}</h1> --}}
    {{-- <p>{{ $details['body'] }}</p> --}}
    <br><br>
    <p>Regards From,</p>
    <p><b>Trouver App Team</b></p>
</body>
</html>
