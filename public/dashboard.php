<?php
require __DIR__ . '/../app/includes/auth.php';
require_login();

$pageTitle = 'Dashboard - AgendAí';

$tipo = current_user_tipo();
$email = $_SESSION['usuario']['email'] ?? '';

include __DIR__ . '/../app/includes/header.php';
include __DIR__ . '/../app/includes/flash.php';
?>

<div class="row g-3">
    <div class="col-12">
        <div class="card shadow-sm p-3">
            <h2 class="mb-1">Bem-vindo ao AgendAí</h2>
            <p class="mb-0">
                Usuário: <strong><?php echo htmlspecialchars($email); ?></strong> |
                Perfil: <strong><?php echo htmlspecialchars($tipo); ?></strong>
            </p>
        </div>
    </div>

    <?php if ($tipo === 'cliente'): ?>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h4>Área do Cliente</h4>
                <p class="mb-2">
                    Como cliente, você pode visualizar os serviços cadastrados pelos prestadores e administradores,
                    além de gerenciar seus dados de perfil.
                </p>
                <a class="btn btn-success" href="itens/index.php">Ver Serviços</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h4>Meu Perfil</h4>
                <p class="mb-2">Atualize seu e-mail ou exclua sua conta.</p>
                <a class="btn btn-primary" href="perfil.php">Ir para Meu Perfil</a>
            </div>
        </div>

    <?php elseif ($tipo === 'prestador'): ?>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h4>Área do Prestador</h4>
                <p class="mb-2">
                    Cadastre e gerencie seus <strong>serviços</strong> (nome, descrição e preço).
                    Esses serviços ficam visíveis para os clientes no sistema.
                </p>
                <a class="btn btn-success" href="itens/index.php">Gerenciar Serviços</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h4>Meu Perfil</h4>
                <p class="mb-2">Atualize seu e-mail ou exclua sua conta.</p>
                <a class="btn btn-primary" href="perfil.php">Ir para Meu Perfil</a>
            </div>
        </div>

    <?php else: ?>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h4>Admin - Usuários</h4>
                <p class="mb-2">Liste e gerencie usuários do sistema.</p>
                <a class="btn btn-warning" href="admin/usuarios.php">Gerenciar Usuários</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h4>Serviços</h4>
                <p class="mb-2">Admin também pode cadastrar e gerenciar serviços.</p>
                <a class="btn btn-success" href="itens/index.php">Gerenciar Serviços</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h4>Meu Perfil</h4>
                <p class="mb-2">Atualize seu e-mail ou exclua sua conta.</p>
                <a class="btn btn-primary" href="perfil.php">Ir para Meu Perfil</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>