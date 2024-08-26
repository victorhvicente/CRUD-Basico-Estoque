<?php

require_once '../configuration/Database.php';
require_once '../model/Produto.php';

class ProdutoController {
    private $produto;

    public function __construct($db) {
        $this->produto = new Produto($db);
    }

    public function criarProduto($nome, $preco, $quantidade) {
        if (empty($nome) || empty($preco) || empty($quantidade)) {
            throw new InvalidArgumentException("Todos os campos são obrigatórios.");
        }

        if (!is_numeric($preco) || !is_numeric($quantidade)) {
            throw new InvalidArgumentException("Preço e quantidade devem ser numéricos.");
        }

        $this->produto->criar($nome, $preco, $quantidade);
    }
}

// Manipulação do pedido de criação de produto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    
    if($preco > 0 && $quantidade > 0){

        try {
            $local = "localhost";
            $nomeBanco = "estoque";
            $usuario = "root";
            $senha = "";
    
            $db = new DataBase($local, $nomeBanco, $usuario, $senha);
            $controller = new ProdutoController($db->getConexaoInstance());
            $controller->criarProduto($nome, $preco, $quantidade);
    
            echo "Produto criado com sucesso.";

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    else{
        echo "Produto nao cadastrado, valores menores que 0 não são permitidos";
    }
    
}
?>



