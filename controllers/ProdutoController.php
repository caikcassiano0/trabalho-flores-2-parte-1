<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Controlador de Produtos (liga as views aos modelos Produto e Categoria).
*******************************************************************************/

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Produto.php';
include_once __DIR__ . '/../models/Categoria.php';

class ProdutoController {
    private $conn;
    private $produto;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->produto = new Produto($this->conn);
        $this->categoria = new Categoria($this->conn);
    }

    // Lista os produtos
    public function index() {
        $stmt = $this->produto->read();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['lista' => $lista, 'num' => count($lista)];
    }

    // Confere se os dados do produto são válidos
    private function valido($nome, $preco, $categoria_id) {
        return trim($nome) !== '' && is_numeric($preco) && $preco >= 0 && (int) $categoria_id > 0;
    }

    // Cria produto
    public function create($nome, $descricao, $preco, $categoria_id) {
        if (!$this->valido($nome, $preco, $categoria_id)) {
            return false;
        }
        $this->produto->nome = $nome;
        $this->produto->descricao = $descricao;
        $this->produto->preco = $preco;
        $this->produto->categoria_id = $categoria_id;
        return $this->produto->create();
    }

    // Busca um produto; retorna null se não existir
    public function readOne($id) {
        $this->produto->id = $id;
        return $this->produto->readOne() ? $this->produto : null;
    }

    // Atualiza produto
    public function update($id, $nome, $descricao, $preco, $categoria_id) {
        if (!$this->valido($nome, $preco, $categoria_id)) {
            return false;
        }
        $this->produto->id = $id;
        $this->produto->nome = $nome;
        $this->produto->descricao = $descricao;
        $this->produto->preco = $preco;
        $this->produto->categoria_id = $categoria_id;
        return $this->produto->update();
    }

    // Deleta produto
    public function delete($id) {
        $this->produto->id = $id;
        return $this->produto->delete();
    }

    // Lista de categorias para o <select> dos formulários
    public function getCategorias() {
        return $this->categoria->read()->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
