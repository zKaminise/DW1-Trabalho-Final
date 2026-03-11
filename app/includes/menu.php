<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logado = isset($_SESSION['usuario']);

$BASE_URL = '/agendai';
$PUBLIC_URL = $BASE_URL . '/public';

$tipo = $logado ? ($_SESSION['usuario']['tipo'] ?? 'cliente') : null;

$current = basename($_SERVER['PHP_SELF']);

function is_active(array $names, string $current): string {
    return in_array($current, $names, true) ? ' active' : '';
}
?>

<nav class="w-100">
    <div class="d-flex w-100">
        <a class="menu-btn<?php echo is_active(['index.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/index.php">Home</a>
        <a class="menu-btn<?php echo is_active(['quem-somos.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/quem-somos.php">Quem Somos</a>
        <a class="menu-btn<?php echo is_active(['cases.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/cases.php">Casos de uso</a>
        <a class="menu-btn<?php echo is_active(['contato.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/contato.php">Contato</a>

        <?php if ($logado): ?>
            <a class="menu-btn<?php echo is_active(['dashboard.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/dashboard.php">Dashboard</a>

            <a class="menu-btn<?php echo is_active(['perfil.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/perfil.php">Meu Perfil</a>

            <a class="menu-btn<?php echo is_active(['index.php','novo.php','editar.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/itens/index.php">Serviços</a>

            <?php if ($tipo === 'admin'): ?>
                <a class="menu-btn<?php echo is_active(['usuarios.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/admin/usuarios.php">Usuários</a>
            <?php endif; ?>

            <a class="menu-btn" href="<?php echo $BASE_URL; ?>/app/actions/logout.php">Logout</a>
        <?php else: ?>
            <a class="menu-btn<?php echo is_active(['login.php'], $current); ?>" href="<?php echo $PUBLIC_URL; ?>/login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>