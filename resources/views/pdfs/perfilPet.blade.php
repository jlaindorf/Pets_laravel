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
    <h1 class="title">Perfil do pet</h1>

    <h2>Nome do pet: <span>{{ $name }}</span></h2>
    <h2>Especie do pet: <span>{{ $specie }}</span></h2>
    <h2>Raça do pet: <span>{{ $race }}</span></h2>

    @foreach ( $vaccines as  $vacine)
        <ul>
            <li>Nome: {{ $vacine->name}} </li>
            <li>Dose: {{ $vacine->dose}} </li>
        </ul>
    @endforeach
</body>

</html>
