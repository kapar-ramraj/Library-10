<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nationality',
        'birth_date',
        'death_date',
        'biography',
        'photo',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
