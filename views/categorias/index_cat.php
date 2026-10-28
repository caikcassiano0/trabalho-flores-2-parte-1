<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Tela de listagem de categorias.
*******************************************************************************/

include_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$data = $controller->index();

include __DIR__ . '/../includes/header.php';
?>

<h2>Categorias</h2>

<a href="/crud_php/public/index.php?page=categorias&action=create" class="button">Criar Nova Categoria</a>

<?php if ($data['num'] > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($data['lista'] as $row): ?>
            <tr>
                <td><?php echo (int) $row['id']; ?></td>
                <td><?php echo e($row['nome']); ?></td>
                <td>
                    <a href="/crud_php/public/index.php?page=categorias&action=edit&id=<?php echo (int) $row['id']; ?>" class="button edit">Editar</a>
                    <a href="/crud_php/public/index.php?page=categorias&action=delete&id=<?php echo (int) $row['id']; ?>" class="button delete"
                       onclick="return confirm('Deletar esta categoria? Os produtos dela também serão apagados.');">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhuma categoria encontrada.</p>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>
