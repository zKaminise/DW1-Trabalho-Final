<?php
require __DIR__ . '/../../app/includes/auth.php';
require_prestador_ou_admin();

require __DIR__ . '/../../app/config/conexao.php';

$pageTitle = 'Editar Serviço - AgendAí';

$usuarioId = $_SESSION['usuario']['id'];
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, titulo, descricao, preco FROM itens WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuarioId]);
$servico = $stmt->fetch();

if (!$servico) {
    $_SESSION['erro'] = 'Serviço não encontrado.';
    header('Location: index.php');
    exit;
}

include __DIR__ . '/../../app/includes/header.php';
include __DIR__ . '/../../app/includes/flash.php';
?>

<h2 class="mb-3">Editar Serviço</h2>

<form method="post" action="/agendai/app/actions/item_update.php" class="card shadow-sm p-3">
    <input type="hidden" name="id" value="<?php echo (int)$servico['id']; ?>">

    <label class="form-label">Nome do Serviço</label>
    <input type="text" name="titulo" class="form-control mb-2" value="<?php echo htmlspecialchars($servico['titulo']); ?>" required minlength="3">

    <label class="form-label">Descrição</label>
    <textarea name="descricao" class="form-control mb-2" rows="4" required minlength="10"><?php echo htmlspecialchars($servico['descricao']); ?></textarea>

    <label class="form-label">Preço (R$)</label>
    <input type="number" name="preco" step="0.01" min="0" class="form-control mb-3" value="<?php echo htmlspecialchars($servico['preco']); ?>" required>

    <div class="d-flex gap-2">
        <button class="btn btn-primary" type="submit">Atualizar</button>
        <a class="btn btn-secondary" href="index.php">Voltar</a>
    </div>
</form>

<?php include __DIR__ . '/../../app/includes/footer.php'; ?>