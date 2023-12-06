<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomePet;
use App\Models\Pet;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class PetController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        try {

            // pegar os dados que foram enviados via query params
            $filters = $request->query();

            // inicializa uma query
            $pets = Pet::query()
          /*  ->select(
                'id as id_pet',
                'pets.name as pet_name',
                'pets.race_id',
                'pets.specie_id'
            )
            /*->with('race'); //with para puxar as colunas da raça junto*/
            ->with(['race'=> function($query){
                $query->select('name','id');
            }])
            ->with(['specie' => function ($query) {
                $query->select('name', 'id');
            }])
            ->with('vaccines')
            ->with('specie');

            // verifica se filtro
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

            // retorna o resultado
            $columnOrder = $request->has('order') && !empty($filters['order']) ?  $filters['order'] : 'name';

            return $pets->orderBy($columnOrder)->get();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            // rebecer os dados via body
            $data = $request->all();

            $request->validate([
                'name' => 'required|string|max:150',
                'age' => 'int',
                'weight' => 'numeric',
                'size' => 'required|string', // melhorar validacao para enum
                'race_id' => 'required|int',
                'specie_id' => 'required|int'
            ]);

            $pet = Pet::create($data);

            Mail::to('julioluzlaindorf@gmail.com','Julio Laindorf')
            ->send(new SendWelcomePet($pet->name, 'Julio Laindorf'));

            return $pet;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id){
        $pet = Pet::find($id);
        if(!$pet) return $this->error('Dado Não encontrado', Response::HTTP_NOT_FOUND);

        $pet->delete();

        return $this->response('', Response::HTTP_NO_CONTENT);

    }
}
