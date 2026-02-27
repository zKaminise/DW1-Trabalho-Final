<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$BASE_URL = '/agendai';
$PUBLIC_URL = $BASE_URL . '/public';
$ASSETS_URL = $BASE_URL . '/assets';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'AgendAí'; ?></title>

    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<img src="<?php echo $ASSETS_URL; ?>/img/banner.png" alt="Banner" class="w-100">

<?php include __DIR__ . '/menu.php'; ?>

<main class="container my-4">