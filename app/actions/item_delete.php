<?php
require __DIR__ . '/../includes/auth.php';
require_prestador_ou_admin();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Método inválido.'
        ]);
        exit;
    }

    header('Location: /agendai/public/itens/index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Serviço inválido.'
        ]);
        exit;
    }

    $_SESSION['erro'] = 'Serviço inválido.';
    header('Location: /agendai/public/itens/index.php');
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("DELETE FROM itens WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuarioId]);

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Serviço excluído com sucesso!'
    ]);
    exit;
}

$_SESSION['sucesso'] = 'Serviço excluído com sucesso!';
header('Location: /agendai/public/itens/index.php');
exit;