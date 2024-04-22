<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rental;
use App\Models\User;
use App\Models\Books;
use Illuminate\Support\Str;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Rental::factory(30)->create();

        // Assume you have a few users and books already seeded in your database
        $users = User::all();
        $books = Books::all();

        // // Generate 30 rental records
        // // foreach (range(1, 40) as $index) 
        // // {
        //     // Rental::factory(30)->create([
                
        //     // ]);
        // // }

        // Rental::factory()
        //     ->count(30)
        //     ->for($users->random())
        //     ->for($books->random())
        //     ->create();

        // foreach ($books as $book) {
        //     \App\Models\Rental::factory(5)
        //         ->for($user)
        //         ->hasBooks()
        //         ->create() ;
        // }

        // foreach ($books as $book) {
        //     \App\Models\Rental::factory(5)->create([
        //         'user_id' => $users->random(),
        //         'book_id' => $book,
        //     ]);
        // }

        // foreach (range(1, 40) as $index) {
        //     \App\Models\Rental::factory()->create([
        //         'user_id' => $users->random(),
        //         'books_id' => $books->random(),
        //     ]);
        // }

        \App\Models\Rental::factory(30)->create();
    }
}
