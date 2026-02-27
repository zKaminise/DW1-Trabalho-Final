<?php
session_start();

unset($_SESSION['usuario']);
$_SESSION['sucesso'] = 'Você saiu da conta.';
header('Location: ../../public/login.php');
exit;