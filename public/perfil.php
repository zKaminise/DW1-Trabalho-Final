<?php
require __DIR__ . '/../app/includes/auth.php';
require_login();

require __DIR__ . '/../app/config/conexao.php';

$pageTitle = 'Meu Perfil - AgendAí';

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("SELECT id, email, tipo, criado_em FROM usuarios WHERE id = ?");
$stmt->execute([$usuarioId]);
$u = $stmt->fetch();

include __DIR__ . '/../app/includes/header.php';
include __DIR__ . '/../app/includes/flash.php';
?>

<div class="card shadow-sm p-3 mb-3">
    <h2 class="mb-2">Meu Perfil</h2>
    <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($u['email']); ?></p>
    <p class="mb-1"><strong>Tipo:</strong> <?php echo htmlspecialchars($u['tipo']); ?></p>
    <p class="mb-0"><strong>Criado em:</strong> <?php echo htmlspecialchars($u['criado_em']); ?></p>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h4>Alterar Email</h4>
            <form method="post" action="/agendai/app/actions/perfil_update.php">
                <label class="form-label">Novo Email</label>
                <input type="email" name="email" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h4>Excluir minha conta</h4>
            <p class="text-danger mb-2"><strong>Atenção:</strong> isso remove sua conta e seus serviços.</p>
            <form method="post" action="/agendai/app/actions/conta_delete.php">
                <label class="form-label">Digite sua senha para confirmar</label>
                <input type="password" name="senha" class="form-control mb-2" required>
                <button type="submit" class="btn btn-danger">Excluir Conta</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>