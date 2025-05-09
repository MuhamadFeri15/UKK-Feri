<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    
    protected $fillable = [
        nama, 
        no_telp,
        poin,
    ];

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
}
