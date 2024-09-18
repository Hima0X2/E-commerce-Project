<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Specify the table associated with the model
    protected $table = 'products';
    
    // Specify which attributes are mass assignable
    protected $fillable = ['name', 'price', 'image'];
    use HasFactory;
}
