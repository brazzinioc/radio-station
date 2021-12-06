<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{User, RadioStation};

class UserTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * Test table columns
     *
     * @return void
     */
    public function test_radio_station_table_has_expected_columns()
    {
        $this
            ->assertTrue(
                Schema::hasColumns('users', [
                    'id',
                    'name',
                    'last_name',
                    'about',
                    'email',
                    'email_verified_at',
                    'password',
                    'remember_token',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ]),
            );
    }


    /*******************************
     *  TEST RELATIONSHIPS
     ******************************/

    /**
     * Test relationship with Radio Station
     *
     * @return void
     */
    public function test_user_hast_many_radio_stations()
    {

        $user = User::factory()->create();
        $radioStation = RadioStation::factory()->create(['created_by' => $user->id, "updated_by" => $user->id]);

        $this->assertTrue($user->radioStationsCreated->contains($radioStation));
        $this->assertEquals(1, $user->radioStationsCreated->count());

        $this->assertTrue($user->radioStationsUpdated->contains($radioStation));
        $this->assertEquals(1, $user->radioStationsUpdated->count());

        $this->assertInstanceOf(Collection::class, $user->radioStationsCreated);
        $this->assertInstanceOf(Collection::class, $user->radioStationsUpdated);
    }
}
