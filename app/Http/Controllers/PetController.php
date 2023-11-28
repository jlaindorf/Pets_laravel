<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;

class PetController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        try {

            //pega os dados enviados via query params
            $filters = $request->query();

            //inicializa uma query
            $pets = Pet::query();
            //verifica-se filtro
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

            //ordenar resultado da pesquisa
            $columnOrder=$request->has('order') && !empty($filters['order']) ?  $filters['order'] : 'name';
            //retorna o resultado
            return $pets->orderBy($columnOrder)->get();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
