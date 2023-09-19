<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'region',
        'phone',
        'information',
        'file'
    ];
    
    public function invoice()
    {
        return $this->hasMany('App\Models\invoice');
    }
}
