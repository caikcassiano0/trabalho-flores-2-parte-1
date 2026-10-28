<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Formulário de cadastro de produto.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();
$categorias = $controller->getCategorias();
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? 0;

    if ($controller->create($nome, $descricao, $preco, $categoria_id)) {
        header('Location: /crud_php/public/index.php?page=produtos');
        exit();
    }
    $erro = 'Não foi possível criar o produto. Verifique os campos.';
}

include __DIR__ . '/../includes/header.php';
?>

<h2>Criar Produto</h2>

<?php if (count($categorias) === 0): ?>
    <p class="error">Cadastre uma categoria antes de criar produtos.</p>
<?php else: ?>
<form action="/crud_php/public/index.php?page=produtos&action=create" method="POST">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" maxlength="255" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"></textarea>

    <label for="preco">Preço:</label>
    <input type="number" id="preco" name="preco" step="0.01" min="0" required>

    <label for="categoria_id">Categoria:</label>
    <select id="categoria_id" name="categoria_id" required>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?php echo (int) $cat['id']; ?>"><?php echo e($cat['nome']); ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="button">Salvar</button>
    <a href="/crud_php/public/index.php?page=produtos" class="button">Cancelar</a>
</form>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>
