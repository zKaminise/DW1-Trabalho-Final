<?php
require __DIR__ . '/../includes/auth.php';
require_admin();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/admin/usuarios.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    $_SESSION['erro'] = 'Usuário inválido.';
    header('Location: /agendai/public/admin/usuarios.php');
    exit;
}

$meuId = (int)($_SESSION['usuario']['id'] ?? 0);
if ($id === $meuId) {
    $_SESSION['erro'] = 'Você não pode excluir sua própria conta por aqui.';
    header('Location: /agendai/public/admin/usuarios.php');
    exit;
}

$stmt = $pdo->prepare("SELECT tipo FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$u = $stmt->fetch();

if (!$u) {
    $_SESSION['erro'] = 'Usuário não encontrado.';
    header('Location: /agendai/public/admin/usuarios.php');
    exit;
}

if (($u['tipo'] ?? '') === 'admin') {
    $_SESSION['erro'] = 'Não é permitido excluir outro administrador.';
    header('Location: /agendai/public/admin/usuarios.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

$_SESSION['sucesso'] = 'Usuário excluído com sucesso!';
header('Location: /agendai/public/admin/usuarios.php');
exit;