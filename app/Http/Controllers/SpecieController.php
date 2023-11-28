<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class SpecieController extends Controller
{
    use HttpResponses;
    public function index(){
        $species = Specie::All();
            return  $species;

    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:races|max:50'
            ]);

            $data = $request->all();

            $specie =  Specie::create($data);

            return $specie;

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), HttpFoundationResponse::HTTP_BAD_REQUEST);
         }
        }
    }



