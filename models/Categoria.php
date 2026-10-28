<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Modelo da entidade Categoria (acesso à tabela categorias).
*******************************************************************************/

class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $id;
    public $nome;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lista todas as categorias em ordem alfabética
    function read() {
        $query = "SELECT id, nome FROM " . $this->table_name . " ORDER BY nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Cria uma nova categoria
    // Obs.: o texto é salvo como foi digitado; o escape é feito na hora de exibir
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":nome", trim($this->nome));
        return $stmt->execute();
    }

    // Lê uma única categoria pelo id. Retorna false se não existir.
    function readOne() {
        $query = "SELECT id, nome FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int) $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        $this->nome = $row['nome'];
        return true;
    }

    // Atualiza o nome da categoria
    function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', trim($this->nome));
        $stmt->bindValue(':id', (int) $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Deleta a categoria (os produtos dela são apagados em cascata pelo banco)
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int) $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
