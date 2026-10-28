<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Tela de listagem de produtos.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/ProdutoController.php';

$controller = new ProdutoController();
$data = $controller->index();

include __DIR__ . '/../includes/header.php';
?>

<h2>Produtos</h2>

<a href="/crud_php/public/index.php?page=produtos&action=create" class="button">Criar Novo Produto</a>

<?php if ($data['num'] > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($data['lista'] as $row): ?>
            <tr>
                <td><?php echo (int) $row['id']; ?></td>
                <td><?php echo e($row['nome']); ?></td>
                <td><?php echo e($row['descricao']); ?></td>
                <td>R$ <?php echo number_format((float) $row['preco'], 2, ',', '.'); ?></td>
                <td><?php echo e($row['categoria_nome']); ?></td>
                <td>
                    <a href="/crud_php/public/index.php?page=produtos&action=edit&id=<?php echo (int) $row['id']; ?>" class="button edit">Editar</a>
                    <a href="/crud_php/public/index.php?page=produtos&action=delete&id=<?php echo (int) $row['id']; ?>" class="button delete"
                       onclick="return confirm('Deletar este produto?');">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum produto encontrado.</p>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>
