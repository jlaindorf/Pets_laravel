<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


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

            $body = $request->all();

            $race =  Race::create($body);

            return $race;

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
