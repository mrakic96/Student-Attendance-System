<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        /*  Pozivamo metodu truncate da očistimo tabelu User i međutablicu 
            prije seedanja kako ne bi duplali podatke */
        User::truncate();
        DB::table('role_user')->truncate();

        // Dohvaćamo nazive uloga iz tabele Role i spremamo ih u varijable
        $adminRole = Role::where('name', 'admin')->first();
        $profesorRole = Role::where('name', 'profesor')->first();
        $studentRole = Role::where('name', 'student')->first();

        // Kreiramo Usere na koje ćemo 'kačiti' gore definirane uloge
        $admin = User::create([ 
            'name' => 'Admin', 
            'email' => 'admin@sas.fsre.ba', 
            'password' => Hash::make('password123') 
        ]);

        $profesor = User::create([ 
            'name' => 'Profesor', 
            'email' => 'profesor@sas.fsre.ba', 
            'password' => Hash::make('password123') 
        ]);

        $student = User::create([ 
            'name' => 'Student', 
            'email' => 'student@sas.fsre.ba', 
            'password' => Hash::make('password123') 
        ]);
        
        // Kačimo uloge na usere
        $admin->roles()->attach($adminRole);
        $profesor->roles()->attach($profesorRole);
        $student->roles()->attach($studentRole);
    }
}
