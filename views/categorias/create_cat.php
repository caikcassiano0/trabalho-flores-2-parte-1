<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Formulário de cadastro de categoria.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$erro = '';

// Quando o formulário é enviado, tenta salvar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if ($controller->create($nome)) {
        header('Location: /crud_php/public/index.php?page=categorias');
        exit();
    }
    $erro = 'Não foi possível criar a categoria. Verifique o nome.';
}

include __DIR__ . '/../includes/header.php';
?>

<h2>Criar Categoria</h2>

<form action="/crud_php/public/index.php?page=categorias&action=create" method="POST">
    <label for="nome">Nome da Categoria:</label>
    <input type="text" id="nome" name="nome" maxlength="255" required>
    <button type="submit" class="button">Salvar</button>
    <a href="/crud_php/public/index.php?page=categorias" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
