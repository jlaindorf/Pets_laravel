<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;

class PetController extends Controller
{
    use HttpResponses;

    public function index(Request $request){
        try{
            $filters= $request->query();

           $pets = Pet::query()
            ->where('name','ilike', '%'.$filters['name'].'%')
            ->get();
            return $pets;
        }
        catch(Exception $exception){

        }

    }
}
