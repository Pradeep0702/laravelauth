<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
</head>
<body style="font-family:'Google Sans', Roboto, RobotoDraft, Helvetica, Arial, sans-serif; background-color: #EEEEEE; color: #000000; margin: 0; padding: 0;">
    <div style="box-sizing:border-box;width: 100%; max-width: 600px; margin: auto; padding: 20px; text-align: center;">
        <p style="font-size: 20px;margin-bottom: 10px;">Hello , {{ucwords($username)}} Your One-Time Password (OTP) is:</p>
        <p style="font-size: 24px; font-weight: bold;">{{$otp}}</p>
        <p>Please use this OTP to verify your email address.</p>        
    </div>
</body>
</html>