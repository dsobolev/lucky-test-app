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

        .alert {
            color: red;
        }

        .alert ul {
            list-style: none;
        }

        .alert li + li {
            margin-top: .5em;
        }
    </style>
</head>
<body>
    <form action="/register" method="POST">
        @csrf

        <input type="text" name="username" placeholder="User name" value="{{ old('username') }}" />
        <input type="tel" name="phone" placeholder="7753462453" value="{{ old('phone') }}" />

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit">Register</button>
    </form>
</body>
</html>
