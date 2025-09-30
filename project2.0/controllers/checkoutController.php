<?php
// checkout.php — Basic Shopping Cart / Order Summary
require('../Models/mysqli_connect.php');
require('cartController.php');

// Gather items
$cart = array_filter($_SESSION['cart'], fn($q) => (int)$q > 0);
$ids = array_keys($cart);
$items = [];
if ($ids) {
    $ids = array_map('intval', $ids);
    $idList = implode(',', $ids);
    $sql = "SELECT ProductID, Name, Cost, cart FROM products WHERE ProductID IN ($idList) ORDER BY ProductID";
    $res = $db_conn->query($sql);
    if ($res) {
        while ($r = $res->fetch_assoc()) {
            $pid = (int)$r['ProductID'];
            $items[] = [
                'ProductID' => $pid,
                'Name'      => $r['Name'],
                'Qty'       => (int)$cart[$pid],
                'Unit'      => (float)$r['Cost'],
                'Total'     => (float)$r['Cost'] * (int)$cart[$pid],
            ];
        }
        $res->free();
    }
}

// Totals
$subtotal = array_sum(array_column($items, 'Total'));
$tax      = $subtotal * 0.05;  // 5%
$ship     = $subtotal * 0.10;  // 10% pre-tax
$grand    = $subtotal + $tax + $ship;
$fmt = fn($v) => '$' . number_format((float)$v, 2);


if(($_POST['clearAction'] ?? '') === 'checkout'){
    $_SESSION['cart'] = [];
    header('Location: ../Views/catalog.php');
exit; 
}

?>