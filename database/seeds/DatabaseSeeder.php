<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            'php' => factory(Category::class)->create(['name' => 'PHP']),
            'javascript' => factory(Category::class)->create(['name' => 'JavaScript']),
            'linux' => factory(Category::class)->create(['name' => 'Linux'])
        ]);

        factory(Book::class, 100)->create()->each(function (Book $book) use ($categories) {
            $book->categories()->attach(
                $categories->random(random_int(1, 3))->pluck('id')->toArray()
            );
        });

        factory(Book::class)->create([
            'isbn' => '978-1491918661',
            'author' => 'Robin Nixon',
            'title' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
            'price' => '9.99'
        ])->categories()->attach(
            $categories->only('php', 'javascript')->pluck('id')->toArray()
        );

        factory(Book::class)->create([
            'isbn' => '978-0596804848',
            'author' => 'Robin Nixon',
            'title' => 'Ubuntu: Up and Running: A Power User\'s Desktop Guide',
            'price' => '12.99'
        ])->categories()->attach($categories->get('linux'));

        factory(Book::class)->create([
            'isbn' => '978-1118999875',
            'title' => 'Linux Bible',
            'author' => 'Christopher Negus',
            'price' => '19.99'
        ])->categories()->attach($categories->get('linux'));

        factory(Book::class)->create([
            'isbn' => '978-0596517748',
            'title' => 'JavaScript: The Good Parts',
            'author' => 'Douglas Crockford',
            'price' => '8.99'
        ])->categories()->attach($categories->get('javascript'));
    }
}
