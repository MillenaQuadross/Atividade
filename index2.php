<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas dos Alunos</title>
</head>
<body>
    <form method="post">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <label for="nome<?=$i?>">Nome do Aluno <?=$i?>:</label>
            <input type="text" name="nome<?=$i?>" required>
            <label for="nota<?=$i?>">Nota:</label>
            <input type="number" name="nota<?=$i?>" step="0.01" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alunos = [];
        $notas = [];

        for ($i = 1; $i <= 10; $i++) {
            $alunos[] = $_POST["nome$i"];
            $notas[] = (float)$_POST["nota$i"];
        }

        function mediaNotas($notas) {
            return array_sum($notas) / count($notas);
        }

        function maiorNota($alunos, $notas) {
            $maxNota = max($notas);
            $key = array_search($maxNota, $notas);
            return $alunos[$key];
        }

        $mediaClasse = mediaNotas($notas);
        $alunoMaiorNota = maiorNota($alunos, $notas);
    ?>

    <h2>Resultados:</h2>
    <p>Média das notas da classe: <?= number_format($mediaClasse, 2) ?></p>
    <p>Aluno com a maior nota: <?= $alunoMaiorNota ?></p>

    <?php
    }
    ?>
</body>
</html>

