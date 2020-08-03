<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Pozivamo metodu truncate da očistimo tabelu prije seedanja kako ne bi duplali podatke
        Role::truncate();

        // Kreiramo uloge
        Role::create([ 'name' => 'admin']);
        Role::create([ 'name' => 'profesor']);
        Role::create([ 'name' => 'student']);

    }
}
