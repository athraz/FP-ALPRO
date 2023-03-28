<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";
    protected $fillable = ["title", "desc", "genre_id", "author_id", "photo"];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
}
