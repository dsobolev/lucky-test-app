<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register here</title>
    <style>
        body {
            font-size: 18px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 2em;
            width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 2em;
            border: 3px solid lightgray;
            border-radius: 10px;
        }

        form input {
            padding: 0.3em 1em;
            border-radius: 5px;
            font-size: 18px;
        }

        button {
            padding: .3em;
            font-size: 24px;
            letter-spacing: 0.2em;
        }
    </style>
</head>
<body>
    <form action="/register" method="POST">
        @csrf

        <input type="text" name="name" placeholder="User name" />
        <input type="tel" name="phone" placeholder="7753462453" pattern="\d{10,15}" />
        <button>Register</button>
    </form>
</body>
</html>
