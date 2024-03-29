<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomePet;
use App\Models\Client;
use App\Models\File;
use App\Models\People;
use App\Models\Pet;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

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
                ->select(
                    'id',
                    'pets.name as pet_name',
                    'pets.race_id',
                    'pets.specie_id',
                    'pets.size as size',
                    'pets.weight as weight',
                    'pets.age as age'
                )
                #->with('race') // traz todas as colunas
                ->with(['race' => function ($query) {
                    $query->select('name', 'id');
                }])
                ->with('vaccines.professional.people')
                /*
                ->with(['vaccines.professional.people' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // mostra exemplos
                }])
                */
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

            if ($request->has('specie_id') && !empty($filters['specie_id'])) {
                $pets->where('specie_id', $filters['specie_id']);
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
            $body = $request->all();

            $request->validate([
                'name' => 'required|string|max:150',
                'age' => 'int',
                'weight' => 'numeric',
                'size' => 'required|string|in:SMALL,MEDIUM,LARGE,EXTRA_LARGE', // melhorar validacao para enum
                'race_id' => 'required|int',
                'specie_id' => 'required|int',
                'client_id' => 'int'
            ]);

            $pet = Pet::create($body);

            if (!empty($pet->client_id)) {

                $people = People::find($pet->client_id);

                Mail::to($people->email, $people->name)
                    ->send(new SendWelcomePet($pet->name, 'Henrique Douglas'));
            }

            return $pet;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

        $pet->delete();

        return $this->response('', Response::HTTP_NO_CONTENT);
    }

    public function show($id)
    {
        $pet = Pet::find($id);
        if (!$pet) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        return $pet;
    }
    public function update($id, Request $request)
    {
        $body = $request->all();
        $request->validate([
            'name' => 'string|max:150',
            'age' => 'int',
            'weight' => 'numeric',
            'size' => 'string|in:SMALL,MEDIUM,LARGE,EXTRA_LARGE', // melhorar validacao para enum
            'race_id' => 'int',
            'specie_id' => 'int',
            'client_id' => 'int'
        ]);
        $pet = Pet::find($id);
        if (!$pet) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        $pet->update($body);
        $pet->save();
        return $pet;
    }
    public function upload(Request $request)
    {
        $createds = [];

        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {

                $description =  $request->input('description');

                $slugName = Str::of($description)->slug();
                $fileName = $slugName . '.' . $file->extension();

                $pathBucket = Storage::disk('s3')->put('documentos', $file);
                $fullPathFile = Storage::disk('s3')->url($pathBucket);

                $fileCreated = File::create(
                    [
                        'name' => $fileName,
                        'size' => $file->getSize(),
                        'mime' => $file->extension(),
                        'url' => $pathBucket
                    ]
                );

                array_push($createds, $fileCreated);
            }
        }

        return $createds;
    }
}
