<?php

namespace App\Http\Controllers;

use App\Services\FootballDataService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TeamController extends Controller
{

    /**
     * Load dashboard with team fixtures.
     */
    public function index(FootballDataService $footballDataService): View|Response
    {
        try {
            $teamId = config('services.football-data.team_id');


            $team = $footballDataService->getTeam($teamId);
            $upcomingFixtures = $footballDataService->getUpcomingFixtures($teamId);
            $previousFixtures = $footballDataService->getPreviousFixtures($teamId);

            return view('team.index', compact('team', 'upcomingFixtures', 'previousFixtures'));
        } catch (ConnectionException|RequestException $exception) {
            return $this->errorResponse($exception);
        }
    }

    /**
     * Create a friendly response for Football Data API failures.
     */
    private function errorResponse(ConnectionException|RequestException $exception): Response
    {
        report($exception);

        return response()->view('team.error', [
            'message' => $this->errorMessage($exception),
        ], 503);
    }

    /**
     * Use the API error message when one is available.
     */
    private function errorMessage(ConnectionException|RequestException $exception): string
    {
        if ($exception instanceof RequestException) {
            $message = $exception->response->json('message');

            if (is_string($message) && $message !== '') {
                return $message;
            }
        }

        return 'We could not retrieve the football data. Please try again shortly.';
    }
}
