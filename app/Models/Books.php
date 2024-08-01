<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'books';

    protected $fillable = [
        'id','title','summary','image','stock','category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id','id');
    }

    public function borrow()
    {
        return $this->hasMany(Borrows::class,'book_id', 'id');
    }
}