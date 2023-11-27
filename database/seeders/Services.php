<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Services extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $status;
    protected $invoServices;
    protected $quoteServices;
    protected $contServices;
    protected $curFormatDate;
    protected $serviceTypes;

    public function __construct()
    {
        $this->status = config('constants.STATUS');
        $this->quoteServices = config('constants.SERVICES');
        $this->invoServices = config('constants.CONTRACTS');
        $this->contServices = config('constants.INVOICES');
        $this->serviceTypes = config('constants.SERVICE_TYPES');
    }

    public function run()
    {
        // Create  Quote Services
        foreach ($this->quoteServices as $key => $val) {
            Service::create([
                'title' => ucwords($val),
                'type' => $this->serviceTypes[1],
                'created_by' => 'Default'
            ]);
        }


        // Create  Contract Services
        foreach ($this->contServices as $key => $val) {
            Service::create([
                'title' => ucwords($val),
                'type' => $this->serviceTypes[2],
                'created_by' => 'Default'
            ]);
        }

        // Create  Invoice Services
        foreach ($this->invoServices as $key => $val) {
            Service::create([
                'title' => ucwords($val),
                'type' => $this->serviceTypes[3],
                'created_by' => 'Default'
            ]);
        }
    }
}
