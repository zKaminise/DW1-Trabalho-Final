<?php
require __DIR__ . '/../includes/auth.php';
require_login();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /agendai/public/perfil.php');
    exit;
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {
    $_SESSION['erro'] = 'E-mail inválido.';
    header('Location: /agendai/public/perfil.php');
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id <> ?");
$stmt->execute([$email, $usuarioId]);
if ($stmt->fetch()) {
    $_SESSION['erro'] = 'Este e-mail já está em uso.';
    header('Location: /agendai/public/perfil.php');
    exit;
}

$stmt = $pdo->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
$ok = $stmt->execute([$email, $usuarioId]);

if ($ok) {
    $_SESSION['usuario']['email'] = $email;
    $_SESSION['sucesso'] = 'E-mail atualizado com sucesso!';
} else {
    $_SESSION['erro'] = 'Não foi possível atualizar.';
}

header('Location: /agendai/public/perfil.php');
exit;