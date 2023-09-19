<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'client_id',
        'proforma_id',
        'total_price',
        'information',
        'status',
        'file'
    ];

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function Proforma(){
        return $this->belongsTo('App\Models\Proforma');
    }
}
