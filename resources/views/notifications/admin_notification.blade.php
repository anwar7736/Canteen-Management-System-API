<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification From Admin</title>
</head>
<body>
    <span><b>Hi</b></span> <span style="color:gray">{{$data['name']}},</span>
    <p>
        <p>{{$data['body']}}</p>
        <br/>
        <br/>
        <b style="color:green">Best Regards,</b><br/>
        {{env('APP_NAME')}} Support Team
    </p>
</body>
</html>