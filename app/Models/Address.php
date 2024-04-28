<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'first_name', 'last_name', 'phone', 'street_address', 'city', 'province', 'postal_code'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFullNameAttribute() //Esta funcion hace que se pueda acceder a la propiedad full_name en vez de first_name y last_name
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
