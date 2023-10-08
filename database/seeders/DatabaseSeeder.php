<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\Job;
use App\Models\People;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         $user = \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

         $peoples = People::factory(100)->create();


         foreach ($peoples->random(2) as $person)
         {
             $person->user_id = $user->id;
             $person->save();
         }

         Item::factory(100)->create();

         Job::factory(10)->create();








    }
}
