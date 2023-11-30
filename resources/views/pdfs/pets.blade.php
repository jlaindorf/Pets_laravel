<html>
    <head>

        <style>
            .title {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
            }
        </style>
    </head>
    <body>
            <h1 class="title">Relatório de pets</h1>
            @foreach ($pets as  $pet)
            <ul>
                @if ($pet->age > 10)
                <p>LIGAR PARA O DONO DO PET </p>
            @endif
                <li> Nome: {{$pet->name}} </li>
                <li> Peso: {{$pet->weight}} </li>
                <li> Idade: {{$pet->age}} </li>
                <li> Tamanho: {{$pet->size}} </li>
           </ul>
           <hr/>
            @endforeach
    </body>

</html>
