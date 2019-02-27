<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testSearchBasedOnAuthorCriteriaForRobinNixon(): void
    {
        $response = $this->post('api/books/searches', ['author' => 'Robin Nixon'])
            ->assertJsonCount(2)
            ->assertJsonFragment(['isbn' => '978-1491918661'])
            ->assertJsonFragment(['isbn' => '978-0596804848'])
            ->assertStatus(200);
    }

    public function testSearchBasedOnAuthorCriteriaForChristopherNegus(): void
    {
        $response = $this->post('api/books/searches', ['author' => 'Christopher Negus'])
            ->assertJsonCount(1)
            ->assertJsonFragment(['isbn' => '978-1118999875'])
            ->assertStatus(200);
    }

    public function testSearchBasedOnAuthorCriteriaForRobinNixonAndCategoryCriteriaForLinux(): void
    {
        $response = $this->post('api/books/searches', [
            'author' => 'Robin Nixon',
            'category' => 'linux'
        ])
            ->assertJsonCount(1)
            ->assertJsonFragment(['isbn' => '978-0596804848'])
            ->assertStatus(200);
    }
}
