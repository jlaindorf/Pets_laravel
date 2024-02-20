<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PetsReportController extends Controller
{
    public function export(Request $request) {
        $pets = Pet::query();
        $filters = $request->query();
        if ($request->has('name') && !empty($filters['name'])) {
            $pets->where('name', 'ilike', '%' . $filters['name'] . '%');
        }

        if ($request->has('age') && !empty($filters['age'])) {
            $pets->where('age', $filters['age']);
        }

        if ($request->has('size') && !empty($filters['size'])) {
            $pets->where('size', $filters['size']);
        }

        if ($request->has('weight') && !empty($filters['weight'])) {
            $pets->where('weight', $filters['weight']);
        }
        if ($request->has('specie_id') && !empty($filters['specie_id'])) {
            $pets->where('specie_id', $filters['specie_id']);
        }

        $result = $pets->get();

        $pdf = Pdf::loadView('pdfs.pets', [
            'pets' => $result
        ]);

        return $pdf->stream('relatorio_pets.pdf');
    }
}
