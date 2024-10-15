<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="produto<?=$i?>">Produto <?=$i?>:</label>
            <input type="text" name="produto<?=$i?>" required>
            <label for="preco<?=$i?>">Preço:</label>
            <input type="number" name="preco<?=$i?>" step="0.01" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $produtos = [];
        $precos = [];

        for ($i = 1; $i <= 5; $i++) {
            $produtos[] = $_POST["produto$i"];
            $precos[] = (float)$_POST["preco$i"];
        }

        function quantidadePrecoInferior($precos, $valor) {
            return count(array_filter($precos, function ($preco) use ($valor) {
                return $preco < $valor;
            }));
        }

        function produtosEntrePrecos($produtos, $precos, $min, $max) {
            return array_filter($produtos, function ($produto, $key) use ($precos, $min, $max) {
                return $precos[$key] >= $min && $precos[$key] <= $max;
            }, ARRAY_FILTER_USE_BOTH);
        }

        function mediaPrecoSuperior($precos, $valor) {
            $filtrados = array_filter($precos, function ($preco) use ($valor) {
                return $preco > $valor;
            });
            return array_sum($filtrados) / count($filtrados);
        }

        $quantidadeInferior50 = quantidadePrecoInferior($precos, 50);
        $produtosEntre50e100 = produtosEntrePrecos($produtos, $precos, 50, 100);
        $mediaSuperior100 = mediaPrecoSuperior($precos, 100);
    ?>

    <h2>Resultados:</h2>
    <p>Quantidade de produtos com preço inferior a R$50,00: <?= $quantidadeInferior50 ?></p>
    <p>Produtos com preço entre R$50,00 e R$100,00:
        <ul>
            <?php foreach ($produtosEntre50e100 as $produto): ?>
                <li><?= $produto ?></li>
            <?php endforeach; ?>
        </ul>
    </p>
    <p>Média dos preços dos produtos com preço superior a R$100,00: <?= number_format($mediaSuperior100, 2) ?></p>

    <?php
    }
    ?>
</body>
</html>