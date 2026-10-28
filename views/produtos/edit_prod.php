<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Formulário de edição de produto.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();
$erro = '';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$produto = $controller->readOne($id);
$categorias = $controller->getCategorias();

// Se o id não existe, avisa e para
if (!$produto) {
    include __DIR__ . '/../includes/header.php';
    echo "<p class='error'>Produto não encontrado.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? 0;

    if ($controller->update($id, $nome, $descricao, $preco, $categoria_id)) {
        header('Location: /crud_php/public/index.php?page=produtos');
        exit();
    }
    $erro = 'Não foi possível atualizar o produto. Verifique os campos.';
}

include __DIR__ . '/../includes/header.php';
?>

<h2>Editar Produto</h2>

<form action="/crud_php/public/index.php?page=produtos&action=edit&id=<?php echo $id; ?>" method="POST">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" maxlength="255" value="<?php echo e($produto->nome); ?>" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"><?php echo e($produto->descricao); ?></textarea>

    <label for="preco">Preço:</label>
    <input type="number" id="preco" name="preco" step="0.01" min="0" value="<?php echo e($produto->preco); ?>" required>

    <label for="categoria_id">Categoria:</label>
    <select id="categoria_id" name="categoria_id" required>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?php echo (int) $cat['id']; ?>" <?php echo ($cat['id'] == $produto->categoria_id) ? 'selected' : ''; ?>>
                <?php echo e($cat['nome']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="button">Salvar</button>
    <a href="/crud_php/public/index.php?page=produtos" class="button">Cancelar</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
