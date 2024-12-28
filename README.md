# Lucky App

Sample of a Test-you-luck game, for demonstration purposes.

## What's inside

#### Front-end

For so-called _Page A_ (main page with the game and statistics)

* [Alpine.js](https://alpinejs.dev/) for templating
* Bare [Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API) for AJAX communication

#### Back-end
* Middlewares `CheckLink`/`CheckLinkJson` - to detect link validity early
* `SaveAttempt` job - to save an attempt asynchronously
* `LuckyService` does all the "lucky check" job (this one has Unit tests since it's a perfect candidate)
* Just two models (User, Attempt)
* `AttemptDto` to transfer data, used by `Formatter` service
* The DB has one "expired" user (when seeded) for simple redirect test

## Installation

The project runs on local facilities, with database from Docker container (sqlite).
So it assumes you have PHP 8.3 at least, `composer` and `artisan` installed locally, as well as Docker with it's Compose tool.

_Makefile_ contains commands to install, start and stop the application (but `make` utility should be installed then).

Run `make install` and then `make start` - and you're good to go, with local development server, queue process and DB started.

To stop:

* `Ctrl + C` in the terminal where queue worker is,
* `make stop` - to stop the container and the server.

#### State of the repo

Might be:

- dockerised app, to fix PHP version. Or _sail_ usage. (Dockerfile doesn't work, sadly)
