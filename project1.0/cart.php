<?php
// cart.php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];   // [productId => qty]

$action = $_POST['action'] ?? '';
$pid    = (int)($_POST['product_id'] ?? 0);
$qty    = max(1, (int)($_POST['qty'] ?? 1));

if ($pid > 0) {
    if ($action === 'add_one') {
        $_SESSION['cart'][$pid] = ($_SESSION['cart'][$pid] ?? 0) + $qty;
    } elseif ($action === 'remove_one') {
        if (isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid] -= $qty;
            if ($_SESSION['cart'][$pid] <= 0) unset($_SESSION['cart'][$pid]);
        }
    }
}

$total = array_sum(array_map('intval', $_SESSION['cart']));
$isAjax = (isset($_POST['ajax']) && $_POST['ajax'] === '1') || !empty($_SERVER['HTTP_X_REQUESTED_WITH']);

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'success'    => true,
        'cartTotal'  => $total,
        'currentQty' => (int)($_SESSION['cart'][$pid] ?? 0),
    ]);
    exit;
}

// Non-JS fallback
header('Location: catalog.php');
exit;
