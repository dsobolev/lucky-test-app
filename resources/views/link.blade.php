<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link</title>
    <style>
        body {
            font-size: 18px;
            text-align: center;
        }

        p {
            margin-top: 5em;
        }

        a {
            text-decoration: none;
            color: darkred;
        }
    </style>
</head>
<body>
    <div>
        <p>Hi <em>{{ $username }}</em>! Use this one:</p>
        <a href="{{ $link }}" target="_blank">{{ $link }}</a>
    </div>
</body>
</html>
