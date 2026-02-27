<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login(): void {
    if (!isset($_SESSION['usuario'])) {
        $_SESSION['erro'] = 'Você precisa estar logado para acessar esta página.';
        header('Location: /agendai/public/login.php');
        exit;
    }
}

function current_user_tipo(): string {
    return $_SESSION['usuario']['tipo'] ?? '';
}

function require_admin(): void {
    require_login();
    if (current_user_tipo() !== 'admin') {
        $_SESSION['erro'] = 'Acesso restrito ao administrador.';
        header('Location: /agendai/public/dashboard.php');
        exit;
    }
}

function require_prestador_ou_admin(): void {
    require_login();
    $tipo = current_user_tipo();
    if ($tipo !== 'prestador' && $tipo !== 'admin') {
        $_SESSION['erro'] = 'Acesso restrito: apenas prestadores podem gerenciar serviços.';
        header('Location: /agendai/public/dashboard.php');
        exit;
    }
}