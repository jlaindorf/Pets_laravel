<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = ['professional_id', 'pet_id', 'dose', 'name','status','observations','date'];


    public function professional(){
        return $this->HasOne(Professional::class, 'id', 'professional_id');
    }
}
