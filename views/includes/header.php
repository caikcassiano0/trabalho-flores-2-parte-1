<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Cabeçalho comum (HTML inicial e menu) incluído em todas as páginas.
*******************************************************************************/

// Função auxiliar: escapa texto antes de mostrar no HTML (evita injeção de código)
if (!function_exists('e')) {
    function e($texto) {
        return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Primeiro CRUD PHP</title>
    <link rel="stylesheet" href="/crud_php/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>LINGUAGEM E TÉCNICAS DE PROGRAMAÇÃO - PHP com MySQL</h1>
        <nav>
            <a href="/crud_php/public/index.php?page=produtos">Produtos</a>
            <a href="/crud_php/public/index.php?page=categorias">Categorias</a>
        </nav>
        <hr>
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo e($erro); ?></p>
        <?php endif; ?>
