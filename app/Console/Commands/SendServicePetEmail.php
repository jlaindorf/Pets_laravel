<?php

namespace App\Console\Commands;

use App\Mail\SendServicePet;
use App\Mail\SendWelcomePet;
use App\Models\Pet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendServicePetEmail extends Command
{

    protected $signature = 'app:send-service-pet-Email'; //nome do comando


    protected $description = 'Envia um email oferecendo serviços para os pets cadastrados';

    public function handle()
    {
        //coloca o que queremos que aconteca , no caso que envie um email para cada pet

      $pets = Pet::all();
      foreach ($pets as $pet) {
        Mail::to('julioluzlaindorf@gmail.com', 'Julio')
        ->send(new SendServicePet());
    }
    }
}
