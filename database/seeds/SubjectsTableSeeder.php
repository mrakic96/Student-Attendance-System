<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::truncate();

        Subject::create(['name' => 'Matematika 1', 'totalHeld' => 0]);
        Subject::create(['name' => 'Matematika 2','totalHeld' => 0]);
        Subject::create(['name' => 'Programiranje 1', 'totalHeld' => 0]);
        Subject::create(['name' => 'Programiranje 2', 'totalHeld' => 0]);

    }
}
