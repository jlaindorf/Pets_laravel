<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\People;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{

    use HttpResponses;

    public function store(Request $request)
    {

        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required|max:255',
                'contact' => 'string|required|max:30',
                'email' => 'string|required|unique:peoples',
                'cpf' => 'string|required|max:30|unique:peoples'
            ]);

            $people = People::create($data);

            Client::create([
                'people_id' => $people->id
            ]);

            return $people;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }



    public function index(Request $request)
    {

        $search = $request->input('name');

        $clients = Client::query()
            ->select('id as client_id', 'bonus', 'people_id')
            ->with('people')
           /* ->with(
                [
                    'people',
                    fn ($query) => $query->select('id', 'name', 'cpf', 'email', 'contact')
                ]
            )
            */
            ->whereHas('people', function ($query) use ($search) {
                $query
                    // ->select('id','name','cpf', 'email', 'contact')
                    ->where('name', 'ilike', "%$search%")
                    ->orWhere('cpf', 'ilike', "%$search%")
                    ->orWhere('contact', 'ilike', "%$search%")
                    ->orWhere('email', 'ilike', "%$search%");
            })
            ->get();

        return $clients;
    }
}
