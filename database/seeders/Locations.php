<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Locations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $locations;
    protected $locationTypes;

    public function __construct()
    {
        $this->locations = config('constants.LOCATIONS');
        $this->locationTypes = config('constants.LOCATION_TYPES');
    }

    public function run()
    {
        // Create  defual locations ..
        foreach ($this->locations as $key => $val) {
            ($key == 'PK') ? $type = $this->locationTypes['1'] : (($key == 'LHR' || $key == 'ISB') ? $type = $this->locationTypes['2'] : $type = $this->locationTypes['3']);
            Location::create([
                'code' => strtoupper($key),
                'name' => ucwords($val),
                'type' => $type,
                'created_by' => 1
            ]);
        }
    }
}
