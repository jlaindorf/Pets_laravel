<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getSpeciesAmountByPet(Request $request)
    {
        return DB::select('select count(specie_id), species.name from pets
        right join species on pets.specie_id = species.id
        group by specie_id, species.name');

    }

    public function getClientsAmountByMonth(Request $request)
    {
        return DB::select('select count(created_at),
        EXTRACT(MONTH FROM created_at) as mes
        from clients c
        group by EXTRACT(MONTH FROM created_at)
        order by EXTRACT(MONTH FROM created_at)
        ');

    }

}
