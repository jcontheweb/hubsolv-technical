<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatesresourceGivenCriteria(): void
    {
        $book = [
            'isbn' => '978-1491905012',
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'categories' => ['php'],
            'price' => '18.99'
        ];

        $this->post('api/books', $book)
        ->assertSeeText($book['isbn'])
        ->assertSeeText($book['title'])
        ->assertSeeText($book['author'])
        ->assertSeeText('PHP')
        ->assertSeeText('18.99')
        ->assertStatus(201);
    }

    public function testFailsToCreateresourceGivenInvalidCriteria(): void
    {
        $book = [
            'isbn' => '978-INVALID-ISBN-1491905012',
            'title' => 'Modern PHP: New Features and Good Practices',
            'author' => 'Josh Lockhart',
            'categories' => ['php'],
            'price' => '18.99'
        ];

        $this->post('api/books', $book)
        ->assertStatus(400);
    }
}
