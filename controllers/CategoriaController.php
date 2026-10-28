<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Controlador de Categorias (liga as views ao modelo Categoria).
*******************************************************************************/

// __DIR__ garante o caminho certo, não importa de onde o arquivo é incluído
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Categoria.php';

class CategoriaController {
    private $conn;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->categoria = new Categoria($this->conn);
    }

    // Lista as categorias
    public function index() {
        $stmt = $this->categoria->read();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['lista' => $lista, 'num' => count($lista)];
    }

    // Cria categoria (nome não pode ser vazio)
    public function create($nome) {
        if (trim($nome) === '') {
            return false;
        }
        $this->categoria->nome = $nome;
        return $this->categoria->create();
    }

    // Busca uma categoria; retorna null se não existir
    public function readOne($id) {
        $this->categoria->id = $id;
        return $this->categoria->readOne() ? $this->categoria : null;
    }

    // Atualiza categoria
    public function update($id, $nome) {
        if (trim($nome) === '') {
            return false;
        }
        $this->categoria->id = $id;
        $this->categoria->nome = $nome;
        return $this->categoria->update();
    }

    // Deleta categoria
    public function delete($id) {
        $this->categoria->id = $id;
        return $this->categoria->delete();
    }
}
?>
