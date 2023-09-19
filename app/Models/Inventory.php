<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;

class Inventory extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = [
        'code',
        'name',
        'category',
        'stock',
        'price',
        'file'
    ];
}
