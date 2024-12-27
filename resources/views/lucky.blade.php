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
            display: flex;
            align-items: center;
            border-top: 1px solid lightgray;
            padding: 2em;
        }

        button {
            padding: .3em;
            font-size: 24px;
            letter-spacing: 0.2em;
        }

        span {
            display: inline-block;
            width: 4em;
            margin-left: 2em;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <header>
        <h1>Welcome, {{ $username }}</h1>
    </header>
    <main>
        <section x-data="linkToken">
            <form>
                @csrf

                <button type="button" @click="generate">Generate New</button>
                <button type="button" @click="deactivate">Deactivate</button>
                <span x-text="token"></span>
            </form>
        </section>
        <section>
            <button>History</button>
            <div></div>
        </section>
        <section x-data="lucky">
            <button @click="testLuck">Imfeelinglucky</button>
            <div x-show="showResults">
                <span x-text="number"></span>
                <span x-text="winOrLoose"></span>
                <span x-text="prize" style="text-align: right;"></span>$
            </div>
        </section>
    </main>

    <script>
        let linkToken = document.location.pathname.substring(1)

        document.addEventListener('alpine:init', () => {
            Alpine.data('linkToken', () => ({
                token: linkToken,

                async generate() {
                    const response = await fetch(`/${linkToken}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        },
                    })

                    if (!response.ok) {
                        throw new Error(`Failed to regenerate the link. Status ${response.status}`);
                    }

                    const tokenData = await response.json();
                    linkToken = this.token =  tokenData.link
                },

                async deactivate() {
                    const response = await fetch(`/${linkToken}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        },
                    })

                    if (!response.ok) {
                        throw new Error(`Failed to deactivate the link. Status ${response.status}`);
                    }

                    document.location.pathname = '/register'
                }

            }))

            Alpine.data('lucky', () => ({
                showResults: false,
                winOrLoose: '',
                number: 0,
                prize: 0,

                async testLuck() { console.log(linkToken);
                    const response = await fetch(`/getlucky/${linkToken}`)
                    if (!response.ok) {
                        throw new Error(`Failed. Status ${response.status}`);
                    }

                    const luckyData = await response.json();

                    this.winOrLoose = luckyData.isWin ? 'Win!' : 'Loose...'
                    this.number = luckyData.number
                    this.prize = luckyData.prize

                    this.showResults = true
                },
            }))
        })
    </script>
</body>
</html>
