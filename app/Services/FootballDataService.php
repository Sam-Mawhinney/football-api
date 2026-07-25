<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class FootballDataService
{
    protected string $baseUrl;
    protected string $apiKey;

    /**
     * Load the API configuration from the application config.
     */
    public function __construct()
    {
        $this->baseUrl = config('services.football-data.base_url');
        $this->apiKey = config('services.football-data.api_key');
    }

    /**
     * Get details for a football team.
     */
    public function getTeam(int $teamId): array
    {
        return $this->client()
            ->get("/teams/{$teamId}")
            ->json();
    }

    /**
     * Get the next five scheduled fixtures for a team.
     */
    public function getUpcomingFixtures(int $teamId): array
    {
        return $this->client()
            ->get("/teams/{$teamId}/matches", [
                'status' => 'SCHEDULED',
                'limit' => 5,
            ])
            ->json('matches', []);
    }

    /**
     * Get the five most recent completed fixtures for a team.
     *
     * @throws ConnectionException
     */
    public function getPreviousFixtures(int $teamId): array
    {
        return collect(
            $this->client()
                ->get("/teams/{$teamId}/matches", [
                    'status' => 'FINISHED',
                    'season' => 2025,
                    'limit' => 5,
                ])
                ->json('matches', [])
        )
            ->sortByDesc('utcDate')
            ->values()
            ->all();
    }

    /**
     * Create the HTTP client used for Football Data API requests.
     */
    private function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'X-Auth-Token' => $this->apiKey,
            ])
            ->acceptJson()
            ->timeout(10)
            ->throw();
    }
}
