<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Bonito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        p {
            margin: 0;
        }

        .link-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .link-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Assunto: Solicitação de Documentação para adoção</h1>
        <p>Prezado(a) {{ $name }},</p>
        <p>Espero que esteja tudo bem com você.</p>
        <p>Estamos entrando em contato para solicitar a documentação necessária para finalizar o processo em andamento.
        </p>
        <p>Por favor, clique no link a seguir para acessar o formulário: <a
                href="http://localhost:5173/adocoes/documentos/1" class="link-button">Acessar Formulário</a></p>
        <p>Os documentos solicitados incluem:</p>
        <ul>
            <li>RG</li>
            <li>CPF</li>
            <li>Comprovante de Residência</li>
            <li>Termo de Adoção Assinado</li>
        </ul>
        <p>Solicitamos que preencha o formulário com as informações necessárias e faça o upload dos documentos exigidos.
            Este passo é essencial para prosseguirmos com o processo de forma eficiente.</p>
        <p>Estamos à disposição para quaisquer dúvidas ou assistência adicional. Agradecemos antecipadamente pela sua
            colaboração e aguardamos o envio dos documentos.</p>
        <p>Atenciosamente,</p>
    </div>
</body>

</html>
