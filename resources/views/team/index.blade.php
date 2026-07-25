<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $team['name'] }} Fixtures</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="container py-4">
        <header class="team-card card shadow-sm mb-4">
            <div class="card-body d-flex flex-column flex-sm-row align-items-center gap-4 p-4 text-center text-sm-start">
                <img
                    src="{{ $team['crest'] }}"
                    alt="{{ $team['name'] }} crest"
                    class="team-card__crest"
                >

                <div class="flex-grow-1">
                    <h1 class="h2 mb-2">{{ $team['name'] }}</h1>
                    <div class="team-card__details d-flex flex-wrap justify-content-center justify-content-sm-start gap-3 small">
                        @if (! empty($team['venue']))
                            <span>Stadium: {{ $team['venue'] }}</span>
                        @endif
                        @if (! empty($team['founded']))
                            <span>Founded: {{ $team['founded'] }}</span>
                        @endif
                    </div>
                </div>

                @if (! empty($team['website']))
                    <a href="{{ $team['website'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm">
                        Club website
                    </a>
                @endif
            </div>
        </header>

        <div class="row g-4">
            <section class="col-12 col-lg-6" aria-labelledby="upcoming-heading">
                <h2 id="upcoming-heading" class="h4 mb-3">Upcoming matches</h2>

                <div class="fixture-list d-grid gap-3">
                    @forelse ($upcomingFixtures as $fixture)
                        @include('partials.fixture', ['fixture' => $fixture, 'showScore' => false])
                    @empty
                        <p class="fixture-list__empty text-muted p-4">No upcoming matches found.</p>
                    @endforelse
                </div>
            </section>

            <section class="col-12 col-lg-6" aria-labelledby="results-heading">
                <h2 id="results-heading" class="h4 mb-3">Previous results</h2>

                <div class="fixture-list d-grid gap-3">
                    @forelse ($previousFixtures as $fixture)
                        @include('partials.fixture', ['fixture' => $fixture, 'showScore' => true])
                    @empty
                        <p class="fixture-list__empty text-muted p-4">No previous results found.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</body>
</html>
