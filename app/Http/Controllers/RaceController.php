<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Traits\HttpResponses;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RaceController extends Controller
{

    use HttpResponses;


    public function index(){
        $races = Race::All();
            return  $races;

    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:races|max:50'
            ]);

            $data = $request->all();

            $race =  Race::create($data);

            return $race;

        } catch (Exception $exception) {
           return $this->error($exception->getMessage(), HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
}
