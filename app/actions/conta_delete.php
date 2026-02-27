<?php
require __DIR__ . '/../includes/auth.php';
require_login();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/perfil.php');
    exit;
}

$senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
if (!$senha) {
    $_SESSION['erro'] = 'Informe a senha para confirmar.';
    header('Location: /agendai/public/perfil.php');
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("SELECT senha_hash FROM usuarios WHERE id = ?");
$stmt->execute([$usuarioId]);
$u = $stmt->fetch();

if (!$u || !password_verify($senha, $u['senha_hash'])) {
    $_SESSION['erro'] = 'Senha incorreta.';
    header('Location: /agendai/public/perfil.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$usuarioId]);

unset($_SESSION['usuario']);
$_SESSION['sucesso'] = 'Conta removida com sucesso.';
header('Location: /agendai/public/login.php');
exit;