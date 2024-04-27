<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('books')->truncate();
        DB::table('genres')->truncate();
        DB::table('rentals')->truncate();
        DB::table('users')->truncate();

        \App\Models\User::factory(10)->create();

        $this->call([
            GenreSeeder::class,
        ]);
        
        $this->call([
            BooksSeeder::class,
        ]);

        $this->call([
            RentalSeeder::class,
        ]);
    }
}
