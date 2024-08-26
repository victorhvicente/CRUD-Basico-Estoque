<?php
    class Produto {
        private $codigo;
        private $nome;
        private $preco;
        private $quantidade;
        private $conexao;
        private $tabela = "produto";

        public function __construct($bancoDados) {
            $this->conexao = $bancoDados; // Aqui você deve garantir que $bancoDados é uma instância de PDO
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getPreco() {
            return $this->preco;
        }

        public function setPreco($preco) {
            if ($preco > 0) {
                $this->preco = $preco;
            } else {
                echo "Valor menor ou igual a 0 não permitido.";
            }
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            if ($quantidade > 0) {
                $this->quantidade = $quantidade;
            } else {
                echo "Quantidade menor ou igual a 0 não permitido.";
            }
        }

        public function criar($nome, $preco, $quantidade) {

            if ($preco <= 0 || $quantidade <= 0) {
                echo "Preço e quantidade devem ser maiores que 0.";
                return;
            }

            $this->setNome($nome);
            $this->setPreco($preco);
            $this->setQuantidade($quantidade);

            $query = "INSERT INTO " . $this->tabela . " (nome, preco, quantidade) VALUES (:nome, :preco, :quantidade)";
            
            $resultado = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $resultado->bindParam(":nome", $nome);
            $resultado->bindParam(":preco", $preco);
            $resultado->bindParam(":quantidade", $quantidade);

            $resultado->execute();
        }

        public function lerTudo() {
            $query = "SELECT * FROM " . $this->tabela . " ORDER BY codigo DESC";

            $resultado = $this->conexao->prepare($query);
            $resultado->execute();

            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }

        public function lerUm($codigo) {
            $query = "SELECT * FROM " . $this->tabela . " WHERE codigo = :codigo";
            
            $resultado = $this->conexao->prepare($query);
            $resultado->bindParam(':codigo', $codigo, PDO::PARAM_INT);

            $resultado->execute();

            $row = $resultado->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Atribui os valores aos atributos da classe
                $this->nome = $row['nome'];
                $this->preco = $row['preco'];
                $this->quantidade = $row['quantidade'];
            } else {
                // Trata o caso onde não há resultados
                echo "Nenhum produto encontrado com o código fornecido.";
            }
        }

        public function atualizar($codigo) {
            $query = "UPDATE " . $this->tabela . " SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE codigo = :codigo";
            
            $resultado = $this->conexao->prepare($query);

            // Bind dos parâmetros
            $resultado->bindParam(":nome", $this->nome);
            $resultado->bindParam(":preco", $this->preco);
            $resultado->bindParam(":quantidade", $this->quantidade);
            $resultado->bindParam(":codigo", $codigo, PDO::PARAM_INT);

            return $resultado->execute();
        }

        public function deletar($codigo) {
            $query = "DELETE FROM " . $this->tabela . " WHERE codigo = :codigo";

            $resultado = $this->conexao->prepare($query);
            $resultado->bindParam(':codigo', $codigo, PDO::PARAM_INT);

            return $resultado->execute();
        }
    }
?>
