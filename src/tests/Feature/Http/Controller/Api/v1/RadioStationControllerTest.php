<?php

namespace Tests\Feature\Http\Controller\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\{ User , RadioStation };

class RadioStationControllerTest extends TestCase
{
    use withFaker, RefreshDatabase;

    private $apiBaseUrl = "/api/v1/";

    /**
     * Test for unauthenticated user.
     *
     * @return void
     */
    public function test_radio_stations_as_guest()
    {
        $this->json('GET', $this->apiBaseUrl."radiostations")->assertStatus(401);
        $this->json('POST', $this->apiBaseUrl."radiostations")->assertStatus(401);
        $this->json('GET', $this->apiBaseUrl."radiostations/1")->assertStatus(401);
        $this->json('PUT', $this->apiBaseUrl."radiostations/1")->assertStatus(401);
        $this->json('DELETE', $this->apiBaseUrl."radiostations/1")->assertStatus(401);
    }
}
