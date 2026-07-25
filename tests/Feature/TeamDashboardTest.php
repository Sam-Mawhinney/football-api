<?php

namespace Tests\Feature;

use App\Services\FootballDataService;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class TeamDashboardTest extends TestCase
{
    /**
     *  Ensuring the dashboard displays data for the team and its fixtures.
     */
    public function test_it_displays_the_team_dashboard(): void
    {
        $service = Mockery::mock(FootballDataService::class);

        $service->shouldReceive('getTeam')->once()->andReturn([
            'name' => 'Liverpool FC',
            'crest' => '',
        ]);

        $service->shouldReceive('getUpcomingFixtures')
            ->once()
            ->andReturn([]);

        $service->shouldReceive('getPreviousFixtures')
            ->once()
            ->andReturn([]);

        $this->app->instance(FootballDataService::class, $service);

        $this->get('/')
            ->assertOk()
            ->assertSee('Liverpool FC');
    }

    /**
     * Ensuring a failure on the API displays an error page.
     */
    public function test_it_shows_an_error_page_when_the_api_fails(): void
    {
        Http::fake([
            '*' => Http::response([
                'message' => "Argument 'id' is expected to be an integer in a specified range.",
                'errorCode' => 400,
            ], 400),
        ]);

        $response = $this->get('/');

        $response
            ->assertStatus(503)
            ->assertSee('Fixtures currently unavailable')
            ->assertSee("Argument 'id' is expected to be an integer in a specified range.");
    }
}
