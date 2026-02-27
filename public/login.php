<?php
session_start();
$pageTitle = 'Login - AgendAí';
include __DIR__ . '/../app/includes/header.php';
include __DIR__ . '/../app/includes/flash.php';
?>

<div class="login-page">
    <div class="login-container">
        <h2>Login</h2>

        <form method="post" action="/agendai/app/actions/login_action.php">
            <input type="email" name="email" placeholder="E-mail" class="form-control mb-3" required>
            <input type="password" name="senha" placeholder="Senha" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
            <p class="text-center">Não tem conta? <a href="registro.php">Registre-se</a></p>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>