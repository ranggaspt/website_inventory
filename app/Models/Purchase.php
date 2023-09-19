<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;

class Purchase extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $fillable = [
        'code',
        'supplier_id',
        'title',
        'total_price',
        'information',
        'file'
    ];
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
}
