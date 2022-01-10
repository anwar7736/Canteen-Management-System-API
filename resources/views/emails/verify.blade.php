<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <span><b>Hi</b></span> <span style="color:gray">{{$data['name']}},</span>
    <p>
        Now you can recover your password by using this OTP Code.
        <br/>
        <h2>Your OTP Code is:<span style="color:red">{{$data['otp']}}</span></h2>
        Will be expired this OTP Code within 5 minutes!
        <br/>
        <br/>
        <b style="color:green">Best Regards,</b><br/>
        {{env('APP_NAME')}} Support Team
    </p>
</body>
</html>