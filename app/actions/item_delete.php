<?php
require __DIR__ . '/../includes/auth.php';
require_prestador_ou_admin();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/itens/index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    $_SESSION['erro'] = 'Serviço inválido.';
    header('Location: /agendai/public/itens/index.php');
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("DELETE FROM itens WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuarioId]);

$_SESSION['sucesso'] = 'Serviço excluído com sucesso!';
header('Location: /agendai/public/itens/index.php');
exit;