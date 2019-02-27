<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testHasNecessaryCategories()
    {
        $this->get('api/categories')
        ->assertJsonFragment(['name' => 'PHP']);
    }
}
