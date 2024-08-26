<?php
    require_once '../controller/ProdutoController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
</head>
<body>
    <form method="POST" action="../controller/ProdutoController.php">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="preco">Preço</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <label for="quantidade">Quantidade</label>
        <input type="number" id="quantidade" name="quantidade" required>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

</html>