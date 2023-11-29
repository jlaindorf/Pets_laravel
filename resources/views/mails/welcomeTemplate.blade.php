<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Petshop</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        .boas-vindas {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .informacoes-adicionais {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .servicos {
            margin-top: 20px;
            padding: 10px;
        }

        .servico {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="container">


    <header>
        <h1>Bem-vindo {{$petName}}!</h1>
    </header>

    <section class="boas-vindas">
        <p>Olá, {{$clientName}}!</p>
        <p style="font-style: italic;">Estamos felizes por ter você e seu peludo conosco.</p>
    </section>

    <section class="informacoes-adicionais">
        <p>Oferecemos uma variedade de serviços para garantir que seu pet receba os melhores cuidados.</p>
        <!-- Adicione mais informações sobre seus serviços aqui -->
    </section>

    <section class="servicos">
        <h2>Nossos Serviços</h2>
        <div class="servico">
            <span>Serviço 1: </span>
            <span>R$ 50,00</span>
        </div>
        <div class="servico">
            <span>Serviço 2: </span>
            <span>R$ 60,00</span>
        </div>
        <div class="servico">
            <span>Serviço 3: </span>
            <span>R$ 75,00</span>
        </div>

    </section>

</div>

</body>
</html>
