<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitationDocument extends Model
{
    use HasFactory;

    protected $table = "solicitations_documents";
    protected $fillable = ['client_id', 'cpf', 'document_address', 'rg', 'term_adoption'];
}
