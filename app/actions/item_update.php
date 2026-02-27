<?php
require __DIR__ . '/../includes/auth.php';
require_prestador_ou_admin();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/itens/index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$titulo = trim((string)filter_input(INPUT_POST, 'titulo', FILTER_UNSAFE_RAW));
$descricao = trim((string)filter_input(INPUT_POST, 'descricao', FILTER_UNSAFE_RAW));
$preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

if (!$id) {
    $_SESSION['erro'] = 'Serviço inválido.';
    header('Location: /agendai/public/itens/index.php');
    exit;
}

if (!$titulo || strlen($titulo) < 3) {
    $_SESSION['erro'] = 'O nome do serviço deve ter pelo menos 3 caracteres.';
    header('Location: /agendai/public/itens/editar.php?id=' . (int)$id);
    exit;
}

if (!$descricao || strlen($descricao) < 10) {
    $_SESSION['erro'] = 'A descrição deve ter pelo menos 10 caracteres.';
    header('Location: /agendai/public/itens/editar.php?id=' . (int)$id);
    exit;
}

if ($preco === false || $preco < 0) {
    $_SESSION['erro'] = 'Preço inválido.';
    header('Location: /agendai/public/itens/editar.php?id=' . (int)$id);
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("UPDATE itens SET titulo = ?, descricao = ?, preco = ? WHERE id = ? AND usuario_id = ?");
$stmt->execute([$titulo, $descricao, $preco, $id, $usuarioId]);

$_SESSION['sucesso'] = 'Serviço atualizado com sucesso!';
header('Location: /agendai/public/itens/index.php');
exit;