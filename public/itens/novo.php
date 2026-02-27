<?php
require __DIR__ . '/../../app/includes/auth.php';
require_prestador_ou_admin();

$pageTitle = 'Novo Serviço - AgendAí';

include __DIR__ . '/../../app/includes/header.php';
include __DIR__ . '/../../app/includes/flash.php';
?>

<h2 class="mb-3">Novo Serviço</h2>

<form method="post" action="/agendai/app/actions/item_create.php" class="card shadow-sm p-3">
    <label class="form-label">Nome do Serviço</label>
    <input type="text" name="titulo" class="form-control mb-2" required minlength="3">

    <label class="form-label">Descrição</label>
    <textarea name="descricao" class="form-control mb-2" rows="4" required minlength="10"></textarea>

    <label class="form-label">Preço (R$)</label>
    <input type="number" name="preco" step="0.01" min="0" class="form-control mb-3" required>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Salvar</button>
        <a class="btn btn-secondary" href="index.php">Voltar</a>
    </div>
</form>

<?php include __DIR__ . '/../../app/includes/footer.php'; ?>