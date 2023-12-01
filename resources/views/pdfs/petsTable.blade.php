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
    <table border="1">
        <thead>
            <th>Nome</th>
            <th>Peso</th>
            <th>Idade</th>
            <th>Tamanho</th>
            <th>Observação</th>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->name }} </td>
                    <td>{{ $pet->weight }} </td>
                    <td>{{ $pet->age }} </td>
                    <td> {{ $pet->size }} </td>
                    <td>
                        @if ($pet->age > 10)
                        <p>LIGAR PARA O DONO DO PET </p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
