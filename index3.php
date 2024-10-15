<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números</title>
</head>
<body>
    <form method="post">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="numero<?=$i?>">Número <?=$i?>:</label>
            <input type="number" name="numero<?=$i?>" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeros = [];

        for ($i = 1; $i <= 10; $i++) {
            $numeros[] = (int)$_POST["numero$i"];
        }

        $negativos = 0;
        $positivos = 0;
        $pares = 0;
        $impares = 0;

        foreach ($numeros as $numero) {
            if ($numero < 0) {
                $negativos++;
            } else {
                $positivos++;
            }

            if ($numero % 2 == 0) {
                $pares++;
            } else {
                $impares++;
            }
        }
    ?>

    <h2>Resultados:</h2>
    <p>Quantidade de números negativos: <?= $negativos ?></p>
    <p>Quantidade de números positivos: <?= $positivos ?></p>
    <p>Quantidade de números pares: <?= $pares ?></p>
    <p>Quantidade de números ímpares: <?= $impares ?></p>

    <?php
    }
    ?>
</body>
</html>
