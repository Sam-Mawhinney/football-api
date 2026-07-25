<article class="match-card shadow-sm">
    <div class="match-card__header d-flex justify-content-between align-items-center gap-2 px-3 py-2 small text-muted">
        <time datetime="{{ $fixture['utcDate'] }}">
            {{ \Carbon\Carbon::parse($fixture['utcDate'])->timezone(config('app.timezone'))->format('D j M Y, H:i') }}
        </time>
        <span class="text-truncate" style="max-width: 50%">
            {{ $fixture['competition']['name'] ?? 'Competition' }}
        </span>
    </div>

    <div class="match-card__teams gap-2 p-3">
        <div class="text-center overflow-hidden">
            <img
                src="{{ $fixture['homeTeam']['crest'] }}"
                alt="{{ $fixture['homeTeam']['name'] }} crest"
                class="match-card__crest mb-2"
                loading="lazy"
            >
            <div class="match-card__team-name">
                {{ $fixture['homeTeam']['shortName'] ?? $fixture['homeTeam']['name'] }}
            </div>
        </div>

        <div class="text-center">
            @if ($showScore)
                <div class="match-card__score">
                    {{ $fixture['score']['fullTime']['home'] ?? '-' }} - {{ $fixture['score']['fullTime']['away'] ?? '-' }}
                </div>
            @else
                <div class="match-card__versus">VS</div>
            @endif
        </div>

        <div class="text-center overflow-hidden">
            <img
                src="{{ $fixture['awayTeam']['crest'] }}"
                alt="{{ $fixture['awayTeam']['name'] }} crest"
                class="match-card__crest mb-2"
                loading="lazy"
            >
            <div class="match-card__team-name">
                {{ $fixture['awayTeam']['shortName'] ?? $fixture['awayTeam']['name'] }}
            </div>
        </div>
    </div>
</article>
