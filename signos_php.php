<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Qual o meu signo?</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        let startDate = document.getElementById('startDate')
        let endDate = document.getElementById('endDate')

        startDate.addEventListener('change', (e) => {
            let startDateVal = e.target.value
            document.getElementById('startDateSelected').innerText = startDateVal
        })

        endDate.addEventListener('change', (e) => {
            let endDateVal = e.target.value
            document.getElementById('endDateSelected').innerText = endDateVal
        })
    </script>
    <style>
        html,
        body {
            height: 100%;
        }

        .parent {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 3%;
        }
    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <?php

    // Transformando arquivo XML em Objeto
    $xml = simplexml_load_file('signos.xml');
    $data_de_nascimento = date('Y-m-d', strtotime($_POST['birthday']));
    $ano = date('Y', strtotime($_POST['birthday']));
    $nome = $_POST['people-name'];

    // Percorre todos os registros de signos
    foreach ($xml->signo as $registro) :
        $start_date = $registro->dataInicio;
        $start_date = date('Y-m-d', strtotime($ano . '-' . $start_date));
        $end_date = $registro->dataFim;
        $end_date = date('Y-m-d', strtotime($ano . '-' . $end_date));
        $signo = $registro->signoNome;
        $emoji = $registro->emoji;
        $descricao1 = $registro->descricao1;
        $descricao2 = $registro->descricao2;
        if (($data_de_nascimento >= $start_date) && ($data_de_nascimento <= $end_date)) {
    ?>
            <div class="container text-center">
                <h1 class="display-1">
                    <?php
                    echo $emoji;
                    ?>
                </h1>
                </br>
                <h1 class="display-3">
                    <?php
                    echo ucwords($nome) . ' o seu sigino é: ' . $signo . '<br>';
                    ?>
                </h1>
                </br>
                <p class="container h4 text-md-start">
                    <?php
                    echo $descricao1;
                    ?>
                </p>
                </br>
                <p class="container h4 text-md-start">
                    <?php
                    echo $descricao2;
                    ?>
                </p>
            </div>
    <?php
        }
    endforeach;

    exit();

    ?>
</body>

</html>