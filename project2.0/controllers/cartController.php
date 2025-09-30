<?php


declare(strict_types=1);

session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // [productId => qty]
}

$action = $_POST['action_add'] ?? '';
$removeAction = $_POST['action_remove'] ?? '';
$pid    = (int)($_POST['pid'] ?? 0);
$qty    = max(1, (int)($_POST['qty'] ?? 1));




if ($pid > 0) {
    if ($action === 'Add') {
        $_SESSION['cart'][$pid] = ($_SESSION['cart'][$pid] ?? 0) + $qty;

    } elseif ($removeAction === 'Remove') {
        if (isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid] -= $qty;
            if ($_SESSION['cart'][$pid] <= 0) unset($_SESSION['cart'][$pid]);
        }
    }
}

$cartTotal = array_sum(array_map('intval', $_SESSION['cart']));

?>

