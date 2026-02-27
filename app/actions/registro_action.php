<?php
session_start();
require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/registro.php');
    exit;
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
$confirmar = filter_input(INPUT_POST, 'confirmar', FILTER_UNSAFE_RAW);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_UNSAFE_RAW);

if (!$email) {
    $_SESSION['erro'] = 'E-mail inválido.';
    header('Location: ../../public/registro.php');
    exit;
}

if (!$senha || strlen($senha) < 4) {
    $_SESSION['erro'] = 'A senha deve ter pelo menos 4 caracteres.';
    header('Location: ../../public/registro.php');
    exit;
}

if ($senha !== $confirmar) {
    $_SESSION['erro'] = 'As senhas não conferem.';
    header('Location: ../../public/registro.php');
    exit;
}

if ($tipo !== 'cliente' && $tipo !== 'prestador') {
    $tipo = 'cliente';
}

// Verifica se já existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$existe = $stmt->fetch();

if ($existe) {
    $_SESSION['erro'] = 'Este e-mail já está cadastrado.';
    header('Location: ../../public/registro.php');
    exit;
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (email, senha_hash, tipo) VALUES (?, ?, ?)");
$ok = $stmt->execute([$email, $senha_hash, $tipo]);

if ($ok) {
    $_SESSION['sucesso'] = 'Cadastro realizado com sucesso! Faça login.';
    header('Location: ../../public/login.php');
    exit;
}

$_SESSION['erro'] = 'Erro ao cadastrar. Tente novamente.';
header('Location: ../../public/registro.php');
exit;