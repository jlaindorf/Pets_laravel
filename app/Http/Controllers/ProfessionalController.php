<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function store(Request $request)
    {

        try {
          $dataPeople = $request->only('name','cpf','contact','email');
          $dataProfessional = $request->only('register','speciality');

          $people = People::create($dataPeople);

          Professional::create([
            'people_id' => $people->id,
                'register' => $dataProfessional['register'],
                'speciality' => $dataProfessional['speciality']
                // ...dataProfessional (substitui os campos acima abaixp dp people_id)

          ]);

           return $people;
        } catch (\Exception $exception) {

    }
}
}
