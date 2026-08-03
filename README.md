# Football API

A small Laravel application using the [Football-Data.org API](https://www.football-data.org/) to display information about Liverpool FC, their next five fixtures and their five most recent results.

I chose this API because I have an interest in football and follow the Premier League most weeks when I can. Building something related to a hobby made it easier to stay focused and decide what information would be useful to show.

I've included the IDs for the other Big Six teams below. You can change `FOOTBALL_DATA_TEAM_ID` in `.env` if my choice of team causes too much controversy 😄

- Manchester City FC - `65`
- Manchester United FC - `66`
- Chelsea FC - `61`
- Arsenal FC - `57`
- Tottenham Hotspur FC - `73`

## Approach

The application has a single route handled by `TeamController`. The controller gathers the data needed by the page and returns either the dashboard or a friendly error view.

API-specific logic is kept in `FootballDataService`. It uses Laravel's HTTP client to configure authentication, make the requests and turn the responses into simple arrays for the views. Both fixture methods return a list of matches, which keeps the views simple.

The main focus was building the API integration, so I used Blade, Bootstrap and some basic CSS to put the dashboard together at a good pace.

Connection failures and unsuccessful API responses are caught by the controller and logged through Laravel. The error page shows the message returned by the API when one is available, or a general message if the service cannot be reached.

I added some basic feature tests to cover the dashboard loading successfully and the error page being returned when the API fails.

## Trade-offs

- Keeping the dashboard focused on one team reduced the need for team selection, validation and navigation, but means the application cannot switch teams through the interface.
- Fetching fresh data on every page load kept the implementation simple, but the three requests per load could reach the free API limit of 10 requests per minute.
- Blade and Bootstrap allowed me to build the dashboard quickly without adding unnecessary frontend complexity.

## Improvements

- Add a dropdown for selecting another Premier League team, with validation for the selected team ID.
- Move the dashboard into Vue components so changing teams or seasons could update the fixtures without a full page reload and allow for more interaction.
- Cache team details and fixtures for a short period to reduce repeated API requests and improve page load times.
- Add more tests around the API service, including request filters, fixture ordering, empty results and different error responses. The current tests cover the main dashboard and error page.

## Running locally

- Requires PHP 8.3 or later, Composer, Node.js and npm.
- Copy `.env.example` to `.env` and add the provided key to `FOOTBALL_DATA_API_KEY`.
- Install the Composer and npm dependencies.
- Generate the application key, run the migrations and build the frontend assets.
- I personally used Laragon to run the application locally due to familiarity and speed but the project is basic enough for any alternative.
