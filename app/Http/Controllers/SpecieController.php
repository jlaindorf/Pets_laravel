<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Specie;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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

            $body = $request->all();

            $specie =  Specie::create($body);

            return $specie;

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), HttpFoundationResponse::HTTP_BAD_REQUEST);
         }

        }

        public function destroy($id) {
            $specie = Specie::find($id);
            $amountPetsUsingSpecieId = Pet::query()->where('specie_id', $id)->count();

        if($amountPetsUsingSpecieId !== 0) return $this->error('Existem pets usando essa espécie', Response::HTTP_CONFLICT);
            if(!$specie) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

            $specie->delete();

            return $this->response('', Response::HTTP_NO_CONTENT);
        }
    }





