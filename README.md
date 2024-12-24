# Lucky App

## Installation

The project runs on local facilities, with database from Docker container (sqlite)
So it assumes you have PHP 8.3 at least, `composer` and `artisan` installed locally, as well as Docker with it's Compose tool.

_Makefile_ contains commands to install, start and stop the application (but `make` utility should be installed then).

Run `make install` and then `make start` - and you're good to go, with local development server and DB started.
`make stop` - to stop the container and the server.

## State of the repo

- Page to get link - ready
- Page A - just HTML, non-functional
- `LuckyService` - contains all the win/loose logic, with Unit tests provided.
    
