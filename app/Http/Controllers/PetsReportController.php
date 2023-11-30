<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PetsReportController extends Controller
{
    public function export() {
        $pets = Pet::all();

        $pdf = Pdf::loadView('pdfs.pets', [
            'pets' => $pets
        ]);

        return $pdf->stream('relatorio_pets.pdf');
    }
}
