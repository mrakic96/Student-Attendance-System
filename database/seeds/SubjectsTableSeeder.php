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
        DB::table('subject_user')->truncate();


        Subject::create(['name' => 'Matematika 1']);
        Subject::create(['name' => 'Matematika 2']);
        Subject::create(['name' => 'Programiranje 1']);
        Subject::create(['name' => 'Programiranje 2']);   
            
    }
}
