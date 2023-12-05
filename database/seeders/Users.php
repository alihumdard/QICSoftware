<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;


class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $quoteStatus;
    protected $currencies;
    protected $curFormatDate;
    protected $currencyTypes;

    public function __construct()
    {
        $this->quoteStatus = config('constants.QUOTE_STATUS');
        $this->currencyTypes = config('constants.CURRENCY_TYPES');
        $this->currencies = config('constants.CURRENCIES');
        $this->curFormatDate = Carbon::now()->format('Y-m-d');
    }

    public function run()
    {
        // Create an Software Manager
        User::factory()->create([
            'name'       => 'Software Manager',
            'email'      => 'manager@gmail.com',
            'password'   => Hash::make('12345'),
            'role'       => 'Manager',
            'status'     => '1',
            'created_by' => '1',
        ]);

        // Create an Super Admins
        User::factory()->create([
            'name'       => 'Super Admin',
            'email'      => 'superadmin@gmail.com',
            'password'   => Hash::make('12345'),
            'role'       => 'Super Admin',
            'status'     => '1',
            'sub_exp_date' => Carbon::now()->addDays(30),
            'manager_id' =>  1,
            'created_by' => '1',
        ]);

        // Create a Admins 
        User::factory()->create([
            'name'         => 'Admin',
            'email'        => 'admin@gmail.com',
            'password'     => Hash::make('12345'),
            'role'         => 'Admin',
            'status'       => '1',
            'sadmin_id'    => '2',
            'manager_id'   => '1',
            'created_by'   => '2'
        ]);

        // Create a Users
        User::factory()->create([
            'name'      => 'User',
            'email'     => 'user@gmail.com',
            'password'  => Hash::make('12345'),
            'role'      => 'User',
            'status'    => '1',
            'admin_id'  => '3',
            'sadmin_id' => '2',
            'manager_id'=> '1',
            'created_by'=> '1'
        ]);
    }
}
