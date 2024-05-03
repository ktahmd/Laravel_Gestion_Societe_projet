<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\models\User;

class DatabaseSeeder extends Seeder
{
   /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		DB::table('users')->insert([
            [
                'username'      => 'admin',
                'name'          => 'admin',
                'email'         => 'admin@gmail.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'admin'
            ],
            [
                'username'      => 'Staff',
                'name'          => 'Staff',
                'email'         => 'staff@mail.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'staff'
            ],
        ]);
    }
}
