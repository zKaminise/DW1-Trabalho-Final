<?php
require __DIR__ . '/../../app/includes/auth.php';
require_prestador_ou_admin();

require __DIR__ . '/../../app/config/conexao.php';

$pageTitle = 'Meus Serviços - AgendAí';

$usuarioId = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("SELECT id, titulo, descricao, preco, criado_em FROM itens WHERE usuario_id = ? ORDER BY id DESC");
$stmt->execute([$usuarioId]);
$servicos = $stmt->fetchAll();

include __DIR__ . '/../../app/includes/header.php';
include __DIR__ . '/../../app/includes/flash.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Meus Serviços</h2>
    <a class="btn btn-success" href="novo.php">Novo Serviço</a>
</div>

<?php if (count($servicos) === 0): ?>
    <div class="alert alert-info">Nenhum serviço cadastrado ainda.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Preço</th>
                    <th>Criado em</th>
                    <th style="width: 220px;">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($servicos as $s): ?>
                <tr>
                    <td>
                        <strong><?php echo htmlspecialchars($s['titulo']); ?></strong><br>
                        <small class="text-muted"><?php echo htmlspecialchars($s['descricao']); ?></small>
                    </td>
                    <td>R$ <?php echo htmlspecialchars(number_format((float)$s['preco'], 2, ',', '.')); ?></td>
                    <td><?php echo htmlspecialchars($s['criado_em']); ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="editar.php?id=<?php echo (int)$s['id']; ?>">Editar</a>

                        <form method="post" action="/agendai/app/actions/item_delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo (int)$s['id']; ?>">
                            <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../app/includes/footer.php'; ?>