<?php

use Illuminate\Database\Seeder;
use App\Subject;
use App\Attendance;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attendance::truncate();
        
        Attendance::create(['description' => 'asdfasdfasf', 'date' => '2020-08-05', 'subject_id' => '2']);
    }
}
