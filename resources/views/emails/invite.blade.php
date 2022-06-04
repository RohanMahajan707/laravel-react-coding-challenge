<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
</head>

<body>
    <p><b>{{$data['first_name']}}</b> has been using ContactOut, and thinks it could be of use for you.</p>

    <p>Here's their invitation link for you: <br />
        <a href="{{$data['referral_link']}}">{{$data['referral_link']}}</a>
    </p>

    <p>ContactOut gives you access to contact details for about 75% of the world's professionals.</p>

    <p>Great for recruiting, sales, and marketing outreach.</p>

    <p>It's an extension that works right on top of LinkedIn.</p>

    <p>Here's their invitation link again:<br>
        <a href="{{$data['referral_link']}}">{{$data['referral_link']}}</a>
    </p>
</body>

</html>