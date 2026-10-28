<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Formulário de edição de categoria.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$erro = '';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$categoria = $controller->readOne($id);

// Se o id não existe, avisa e para
if (!$categoria) {
    include __DIR__ . '/../includes/header.php';
    echo "<p class='error'>Categoria não encontrada.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    if ($controller->update($id, $nome)) {
        header('Location: /crud_php/public/index.php?page=categorias');
        exit();
    }
    $erro = 'Não foi possível atualizar a categoria. Verifique o nome.';
}

include __DIR__ . '/../includes/header.php';
?>

<h2>Editar Categoria</h2>

<form action="/crud_php/public/index.php?page=categorias&action=edit&id=<?php echo $id; ?>" method="POST">
    <label for="nome">Nome da Categoria:</label>
    <input type="text" id="nome" name="nome" maxlength="255" value="<?php echo e($categoria->nome); ?>" required>
    <button type="submit" class="button">Salvar</button>
    <a href="/crud_php/public/index.php?page=categorias" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
