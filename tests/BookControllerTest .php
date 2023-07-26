<?php 
// tests/Feature/BookControllerTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Book;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_books()
    {
        // Assuming you have already seeded books in the database
        $response = $this->get('/api/books');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_add_new_book()
    {
        $bookData = [
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'published_at' => '2023-07-26',
            'copies' => 5,
        ];

        $response = $this->post('/api/books', $bookData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Book added successfully'])
            ->assertJsonStructure(['data' => []]);

        $this->assertDatabaseHas('books', $bookData);
    }

    // Add tests for updating and deleting a book here
}
