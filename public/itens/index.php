<?php
require __DIR__ . '/../../app/includes/auth.php';
require_login();

require __DIR__ . '/../../app/config/conexao.php';

$pageTitle = 'Serviços - AgendAí';

$usuarioId = $_SESSION['usuario']['id'];
$tipo = $_SESSION['usuario']['tipo'] ?? 'cliente';

if ($tipo === 'cliente') {
    $stmt = $pdo->prepare("
        SELECT 
            itens.id,
            itens.titulo,
            itens.descricao,
            itens.preco,
            itens.criado_em,
            usuarios.email AS dono_email,
            usuarios.tipo AS dono_tipo
        FROM itens
        INNER JOIN usuarios ON itens.usuario_id = usuarios.id
        WHERE usuarios.tipo IN ('prestador', 'admin')
        ORDER BY itens.id DESC
    ");
    $stmt->execute();
    $servicos = $stmt->fetchAll();
} else {
    $stmt = $pdo->prepare("
        SELECT 
            itens.id,
            itens.titulo,
            itens.descricao,
            itens.preco,
            itens.criado_em,
            usuarios.email AS dono_email,
            usuarios.tipo AS dono_tipo
        FROM itens
        INNER JOIN usuarios ON itens.usuario_id = usuarios.id
        WHERE itens.usuario_id = ?
        ORDER BY itens.id DESC
    ");
    $stmt->execute([$usuarioId]);
    $servicos = $stmt->fetchAll();
}

include __DIR__ . '/../../app/includes/header.php';
include __DIR__ . '/../../app/includes/flash.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="mb-0">Serviços</h2>
        <?php if ($tipo === 'cliente'): ?>
            <p class="text-muted mb-0">Visualize os serviços cadastrados pelos prestadores e administradores.</p>
        <?php else: ?>
            <p class="text-muted mb-0">Gerencie os serviços cadastrados na sua conta.</p>
        <?php endif; ?>
    </div>

    <?php if ($tipo === 'prestador' || $tipo === 'admin'): ?>
        <a class="btn btn-success" href="novo.php">Novo Serviço</a>
    <?php endif; ?>
</div>

<?php if (count($servicos) === 0): ?>
    <?php if ($tipo === 'cliente'): ?>
        <div class="alert alert-info">Nenhum serviço foi cadastrado pelos prestadores ainda.</div>
    <?php else: ?>
        <div class="alert alert-info">Nenhum serviço cadastrado ainda.</div>
    <?php endif; ?>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Preço</th>
                    <th>Cadastrado por</th>
                    <th>Perfil</th>
                    <th>Criado em</th>

                    <?php if ($tipo === 'prestador' || $tipo === 'admin'): ?>
                        <th style="width: 220px;">Ações</th>
                    <?php endif; ?>
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
                    <td><?php echo htmlspecialchars($s['dono_email']); ?></td>
                    <td>
                        <?php if ($s['dono_tipo'] === 'admin'): ?>
                            <span class="badge bg-warning text-dark">Admin</span>
                        <?php elseif ($s['dono_tipo'] === 'prestador'): ?>
                            <span class="badge bg-success">Prestador</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?php echo htmlspecialchars($s['dono_tipo']); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($s['criado_em']); ?></td>

                    <?php if ($tipo === 'prestador' || $tipo === 'admin'): ?>
                        <td>
                            <a class="btn btn-primary btn-sm" href="editar.php?id=<?php echo (int)$s['id']; ?>">Editar</a>

                            <form method="post" action="/agendai/app/actions/item_delete.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo (int)$s['id']; ?>">
                                <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../../app/includes/footer.php'; ?>