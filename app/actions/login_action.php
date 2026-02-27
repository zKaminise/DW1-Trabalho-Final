<?php
session_start();
require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/login.php');
    exit;
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);

if (!$email || !$senha) {
    $_SESSION['erro'] = 'Informe e-mail e senha.';
    header('Location: /agendai/public/login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, email, senha_hash, tipo FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if (!$usuario) {
    $_SESSION['erro'] = 'E-mail ou senha incorretos.';
    header('Location: /agendai/public/login.php');
    exit;
}

if (!password_verify($senha, $usuario['senha_hash'])) {
    $_SESSION['erro'] = 'E-mail ou senha incorretos.';
    header('Location: /agendai/public/login.php');
    exit;
}

$_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'email' => $usuario['email'],
    'tipo' => $usuario['tipo'],
];

$_SESSION['sucesso'] = 'Login realizado com sucesso!';
header('Location: /agendai/public/dashboard.php');
exit;