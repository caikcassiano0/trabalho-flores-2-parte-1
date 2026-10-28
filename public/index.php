<?php
/******************************************************************************
Curso: Engenharia de Software
Disciplina: Linguagem e Técnicas de Programacão
Professor: Flores
Turma: ESOFT-2
Componentes:
 26008762-2 - Caik
Data: 28 de Outubro de 2026
Descritivo: Ponto de entrada da aplicação. Roteia pelos parâmetros ?page= e ?action=.
*******************************************************************************/

$page   = $_GET["page"]   ?? "produtos";
$action = $_GET["action"] ?? "index";
$id     = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

// Mapa das telas: página => ação => arquivo da view
$rotas = [
    "produtos" => [
        "index"  => "/../views/produtos/index_prod.php",
        "create" => "/../views/produtos/create_prod.php",
        "edit"   => "/../views/produtos/edit_prod.php",
    ],
    "categorias" => [
        "index"  => "/../views/categorias/index_cat.php",
        "create" => "/../views/categorias/create_cat.php",
        "edit"   => "/../views/categorias/edit_cat.php",
    ],
];

// Página desconhecida volta para produtos
if (!isset($rotas[$page])) {
    $page = "produtos";
}

// Ação de deletar: não tem tela, só executa e volta para a lista
if ($action === "delete") {
    if ($page === "produtos") {
        include_once __DIR__ . '/../controllers/ProdutoController.php';
        $controller = new ProdutoController();
    } else {
        include_once __DIR__ . '/../controllers/CategoriaController.php';
        $controller = new CategoriaController();
    }

    if ($controller->delete($id)) {
        header("Location: /crud_php/public/index.php?page=" . $page);
        exit();
    }
    $erro = "Não foi possível deletar o registro.";
    $action = "index";
}

// Ação desconhecida volta para a listagem
if (!isset($rotas[$page][$action])) {
    $action = "index";
}

include __DIR__ . $rotas[$page][$action];
?>
