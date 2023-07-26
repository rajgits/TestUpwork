<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'isbn', 'published_at', 'copies'];

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
}