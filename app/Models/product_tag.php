<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_tag extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id ',
        'tag_id ',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
