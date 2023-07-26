# TEST TASK By BHARATHRAJ (UPWORK FREELANCER)

# STEPS TO INSTALL
# step 1:  Change db name in .env
# step 2: run composer update/ install
# step 3: run php artisan migrate
# step 4: run php artisan serve

## API ENDPOINTS
# Register:  http://127.0.0.1:8000/api/register (post)
body header:
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
# Login:     http://127.0.0.1:8000/api/login
{
    "email": "john.doe@example.com",
    "password": "password123"
}

# CRUD
Post Book
http://localhost:8000/api/books (POST)
{
  "title": "Sample Book",
  "author": "John Doe",
  "isbn": "1234567890",
  "published_at": "2023-07-26",
  "copies": 5
}
Note: Pass token 

Get Book
http://localhost:8000/api/books (GET)

Update Book
http://localhost:8000/api/books (PUT)
{
  "title": "Sample Book",
  "author": "John Doe",
  "isbn": "1234567890",
  "published_at": "2023-07-26",
  "copies": 5
}

Check out:
http://localhost:8000/api/books (POST)
{
    "user_id": 1,
    "book_id": 1
}

http://localhost:8000/api/checkouts/1
{
    "return_date": "2023-07-26"
}

## Test case inside Test folder