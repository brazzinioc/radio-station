<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\{ RefreshDatabase, WithFaker };
use Illuminate\Support\Facades\Schema;

use App\Models\{ User , RadioStation };

class RadioStationTest extends TestCase
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
                Schema::hasColumns('radio_stations', [
                    'id',
                    'name',
                    'website',
                    'email',
                    'slogan',
                    'about',
                    'mission',
                    'vision',
                    'moral_principles',
                    'created_by',
                    'updated_by',
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
     * Test relationship with User creator.
     *
     * @return void
     */
    public function test_radio_station_belongs_to_user_creator()
    {
        $radioStation = RadioStation::factory()->create();

        $this->assertInstanceOf(User::class, $radioStation->userCreator);
    }

    /**
     * Test relationship with User updater.
     *
     * @return void
     */
    public function test_radio_station_belongs_to_user_updater()
    {
        $radioStation = RadioStation::factory()->create();

        $this->assertInstanceOf(User::class, $radioStation->userUpdater);
    }
}
