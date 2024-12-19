<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <style>
        body {
            font-size: 18px;
        }

        h1 {
            text-align: center;
        }

        main {
            max-width: 1200px;
            margin: auto;
        }

        section {
            border-top: 1px solid lightgray;
            padding: 2em;
        }

        button {
            padding: .3em;
            font-size: 24px;
            letter-spacing: 0.2em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, {{ $username }}</h1>
    </header>
    <main>
        <section>
            <button>Generate New</button>
            <button>Deactivate</button>
        </section>
        <section>
            <button>History</button>
            <div></div>
        </section>
        <section>
            <button>Imfeelinglucky</button>
        </section>
    </main>
</body>
</html>
