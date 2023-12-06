<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VaccineController extends Controller
{

    use HttpResponses;

    public function store(Request $request) {
        try {

            $data = $request->all();

            // validar dados do body

            $vaccine = Vaccine::create($data);

            return $vaccine;

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
