<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Modelo da entidade Produto (acesso à tabela produtos, com JOIN em categorias).
*******************************************************************************/

class Produto {
    private $conn;
    private $table_name = "produtos";

    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $categoria_id;
    public $categoria_nome;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lista todos os produtos com o nome da categoria
    function read() {
        $query = "SELECT c.nome AS categoria_nome, p.id, p.nome, p.descricao, p.preco, p.categoria_id
                  FROM " . $this->table_name . " p
                  LEFT JOIN categorias c ON p.categoria_id = c.id
                  ORDER BY p.nome";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Liga os campos do produto aos parâmetros da query
    private function bindCampos($stmt) {
        $stmt->bindValue(":nome", trim($this->nome));
        $stmt->bindValue(":descricao", trim($this->descricao));
        $stmt->bindValue(":preco", (float) $this->preco);
        $stmt->bindValue(":categoria_id", (int) $this->categoria_id, PDO::PARAM_INT);
    }

    // Cria um novo produto
    function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome, descricao, preco, categoria_id)
                  VALUES (:nome, :descricao, :preco, :categoria_id)";
        $stmt = $this->conn->prepare($query);
        $this->bindCampos($stmt);
        return $stmt->execute();
    }

    // Lê um único produto pelo id. Retorna false se não existir.
    function readOne() {
        $query = "SELECT c.nome AS categoria_nome, p.id, p.nome, p.descricao, p.preco, p.categoria_id
                  FROM " . $this->table_name . " p
                  LEFT JOIN categorias c ON p.categoria_id = c.id
                  WHERE p.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int) $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        $this->nome = $row["nome"];
        $this->descricao = $row["descricao"];
        $this->preco = $row["preco"];
        $this->categoria_id = $row["categoria_id"];
        $this->categoria_nome = $row["categoria_nome"];
        return true;
    }

    // Atualiza o produto
    function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET nome = :nome, descricao = :descricao, preco = :preco, categoria_id = :categoria_id
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->bindCampos($stmt);
        $stmt->bindValue(":id", (int) $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Deleta o produto
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, (int) $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
