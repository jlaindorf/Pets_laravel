<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ImportPeoplesController extends Controller
{

    use HttpResponses;

    public function import(Request $request)
    {

        try {
            DB::beginTransaction();
            // Verifica se a solicitação contém um arquivo CSV
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Lê o conteúdo do arquivo CSV
                $contentFile = file_get_contents($file->getRealPath());

                // Converte o conteúdo CSV para uma matriz associativa
                $csvData = array_map('str_getcsv', explode("\n", $contentFile));

                // Pega as keys do array
                $headers = array_shift($csvData);

                $csvArray = [];

                foreach ($csvData as $row) {
                    if(count($row) === 4) {
                        $csvArray[] = array_combine($headers, $row);
                    }
                }

                foreach ($csvArray as $item) {

                   $peopleExist = People::query()
                    ->where('cpf', $item['cpf'])
                    ->orWhere('email', $item['email'])
                    ->first();

                    if(!$peopleExist) People::create($item);
                    else return ('Ja Existe o dado ');
                }

                DB::commit();

                return $this->response('Importado com sucesso',201);

            } else {
                return $this->response("Arquivo ausente", 400);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
