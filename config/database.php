<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Classe de conexão com o banco de dados MySQL usando PDO.
*******************************************************************************/

class Database {
    private $host = "localhost";
    private $db_name = "crud_db";
    private $username = "root";
    private $password = ""; // No XAMPP, a senha padrão do root é vazia
    public $conn;

    // Abre e retorna a conexão com o banco
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            // Faz o PDO lançar exceção quando houver erro de SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Erro de conexão: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>
