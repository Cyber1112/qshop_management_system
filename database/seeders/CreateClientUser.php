<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateClientUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "Hulda",
            "phone_number" => "+77058341313",
            "password" => '$2y$10$nm2zCrq1UGl7z7ZDndRRI.kxHEDSp/b1wKXr5iGlHBtLODr9vN7wu'
        ]);

        Client::create([
            "user_id" => $user->id
        ]);
    }
}
