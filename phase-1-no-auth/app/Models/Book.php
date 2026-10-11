<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'author', 'isbn', 'description', 'price', 'published_year'])]
class Book extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2', // 399.10, "399.00", 399.00
            'published_year' => 'integer', // 2010, 2026
        ];
    }
}
