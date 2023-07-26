<?

// tests/Feature/CheckoutControllerTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Book;
use App\Models\User;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_book()
    {
        // Create a book and user for testing
        $book = Book::factory()->create(['copies' => 5]);
        $user = User::factory()->create();

        $checkoutData = [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ];

        $response = $this->post('/api/checkouts', $checkoutData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Book checked out successfully'])
            ->assertJsonStructure(['data' => []]);

        $this->assertDatabaseHas('checkouts', $checkoutData);
        $this->assertDatabaseHas('books', ['id' => $book->id, 'copies' => 4]);
    }

    public function test_return_book()
    {
        // Create a checkout for testing
        $checkout = Checkout::factory()->create(['return_date' => null]);
        $book = Book::find($checkout->book_id);

        $response = $this->put('/api/checkouts/'.$checkout->id, ['return_date' => '2023-07-26']);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Book marked as returned successfully']);

        $this->assertDatabaseHas('checkouts', ['id' => $checkout->id, 'return_date' => '2023-07-26']);
        $this->assertDatabaseHas('books', ['id' => $book->id, 'copies' => 5]);
    }
}
