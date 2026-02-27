<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$erro = $_SESSION['erro'] ?? null;
$sucesso = $_SESSION['sucesso'] ?? null;
$info = $_SESSION['info'] ?? null;

unset($_SESSION['erro'], $_SESSION['sucesso'], $_SESSION['info']);
?>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<?php if ($sucesso): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
<?php endif; ?>

<?php if ($info): ?>
    <div class="alert alert-info"><?php echo htmlspecialchars($info); ?></div>
<?php endif; ?>