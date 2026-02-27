<?php
require __DIR__ . '/../../app/includes/auth.php';
require_admin();

require __DIR__ . '/../../app/config/conexao.php';

$pageTitle = 'Usuários (Admin) - AgendAí';

$stmt = $pdo->query("SELECT id, email, tipo, criado_em FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll();

$erro = $_SESSION['erro'] ?? null;
$sucesso = $_SESSION['sucesso'] ?? null;
unset($_SESSION['erro'], $_SESSION['sucesso']);

include __DIR__ . '/../../app/includes/header.php';
?>

<div class="container my-4">
    <h2 class="mb-3">Usuários (Admin)</h2>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
    <?php endif; ?>

    <div class="alert alert-info">
        Esta tela é exclusiva do administrador. Você pode listar usuários e excluir contas (exceto a sua própria).
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Tipo</th>
                    <th>Criado em</th>
                    <th style="width: 180px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?php echo (int)$u['id']; ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars($u['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($u['criado_em']); ?></td>
                        <td>
                            <?php if ((int)$u['id'] === (int)($_SESSION['usuario']['id'] ?? 0)): ?>
                                <span class="text-muted">Você</span>
                            <?php else: ?>
                                <form method="post" action="/agendai/app/actions/admin_user_delete.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
                                    <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../../app/includes/footer.php'; ?>