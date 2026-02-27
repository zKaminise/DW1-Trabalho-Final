<?php
session_start();
$pageTitle = 'Registro - AgendAí';
include __DIR__ . '/../app/includes/header.php';
include __DIR__ . '/../app/includes/flash.php';
?>

<div class="login-page">
    <div class="login-container">
        <h2>Registro</h2>

        <form method="post" action="/agendai/app/actions/registro_action.php">
            <input type="email" name="email" placeholder="E-mail" class="form-control mb-3" required>
            <input type="password" name="senha" placeholder="Senha" class="form-control mb-3" required>
            <input type="password" name="confirmar" placeholder="Confirmar Senha" class="form-control mb-3" required>

            <label class="form-label">Tipo de Usuário</label>
            <div class="mb-3">
                <input type="radio" name="tipo" id="cliente" value="cliente" checked>
                <label for="cliente">Cliente</label>

                <input type="radio" name="tipo" id="prestador" value="prestador" class="ms-3">
                <label for="prestador">Prestador</label>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-3">Registrar-se</button>
            <p class="text-center">Já tem conta? <a href="login.php">Login</a></p>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>