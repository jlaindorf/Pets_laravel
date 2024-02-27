<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'cpf', 'contact', 'observations', 'status', 'pet_id'];

    public function pet()
    {
        return $this->hasOne(Pet::class, 'id', 'pet_id');
    }
}
