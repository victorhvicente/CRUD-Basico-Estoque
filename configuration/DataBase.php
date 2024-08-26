<?php

class DataBase {
    private $host;
    private $name_db;
    private $user;
    private $password;
    private $conexao;

    public function __construct($local, $nomeBanco, $usuario, $senha) {
        $this->host = $local;
        $this->name_db = $nomeBanco;
        $this->user = $usuario;
        $this->password = $senha;
        $this->conexao = $this->getConexao();
    }

    public function getConexao() {
        try {
            $conexao = new PDO("mysql:host={$this->host};dbname={$this->name_db}", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Erro com a conexão do banco de dados: " . $e->getMessage();
            die(); // Interrompe a execução se a conexão falhar
        }

        return $conexao;
    }

    // Método para acessar a conexão diretamente
    public function getConexaoInstance() {
        return $this->conexao;
    }
}
?>
