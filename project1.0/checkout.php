<?php
// checkout.php — Basic Shopping Cart / Order Summary
declare(strict_types=1);
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

require_once 'mysqli_connect.php';

// Handle "Check Out" → clear cart, go back to catalog
if (($_POST['action'] ?? '') === 'checkout') {
    $_SESSION['cart'] = [];
    header('Location: catalog.php');
    exit;
}

// Gather items
$cart = array_filter($_SESSION['cart'], fn($q) => (int)$q > 0);
$ids = array_keys($cart);
$items = [];
if ($ids) {
    $ids = array_map('intval', $ids);
    $idList = implode(',', $ids);
    $sql = "SELECT ProductID, Name, Cost FROM products WHERE ProductID IN ($idList) ORDER BY ProductID";
    $res = $dbconn->query($sql);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial, sans-serif; background:#f6f6f6; margin:0; }
    #container { max-width: 1000px; margin: 1.5rem auto; background: #fff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
    header { font-size:1.8rem; font-weight:700; color:#5a2d82; text-align:center; margin-bottom:.5rem; }
    .actions { display:flex; justify-content:space-between; gap:.5rem; margin:.75rem 0 1rem; }
    a.btn, button.btn { text-decoration:none; display:inline-block; padding:.5rem .9rem; border-radius:6px; border:0; cursor:pointer; }
    a.btn { background:#e9e6f1; color:#5a2d82; }
    a.btn:hover { background:#e1dbee; }
    button.btn-primary { background:#5a2d82; color:#fff; }
    button.btn-primary:hover { background:#7a3ab3; }
    table { width:100%; border-collapse:collapse; margin-top:.5rem; }
    thead { background:#5a2d82; color:#fff; }
    th, td { border:1px solid #ddd; padding:.65rem; text-align:left; }
    td.right, th.right { text-align:right; }
    tbody tr:nth-child(even) { background:#f9f9f9; }
    .totals { max-width:420px; margin-left:auto; margin-top:1rem; border:1px solid #ddd; border-radius:8px; overflow:hidden; }
    .totals table { margin:0; }
    .totals td { border-bottom:1px solid #eee; }
    .empty { padding:1rem; background:#fff8e6; border:1px solid #ffe2a8; color:#7a5b00; border-radius:8px; }
  </style>
</head>
<body>
<div id="container">
  <header>Gem's Wig Supply — Shopping Cart</header>

  <div class="actions">
    <a class="btn" href="catalog.php">← Continue Shopping</a>
    <?php if ($items): ?>
      <form method="post">
        <button type="submit" name="action" value="checkout" class="btn btn-primary">Check Out</button>
      </form>
    <?php endif; ?>
  </div>

  <?php if (!$items): ?>
    <div class="empty">Your cart is empty. <a href="catalog.php">Continue shopping</a>.</div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th class="right">Quantity</th>
          <th class="right">Product Cost (each)</th>
          <th class="right">Product Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $it): ?>
          <tr>
            <td><?= (int)$it['ProductID'] ?></td>
            <td><?= htmlspecialchars($it['Name']) ?></td>
            <td class="right"><?= (int)$it['Qty'] ?></td>
            <td class="right"><?= $fmt($it['Unit']) ?></td>
            <td class="right"><?= $fmt($it['Total']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="totals">
      <table style="width:100%; border-collapse:collapse;">
        <tr><td>Items Subtotal</td>             <td class="right"><?= $fmt($subtotal) ?></td></tr>
        <tr><td>Tax (5%)</td>                   <td class="right"><?= $fmt($tax) ?></td></tr>
        <tr><td>Shipping &amp; Handling (10%)</td><td class="right"><?= $fmt($ship) ?></td></tr>
        <tr><td><strong>Order Total</strong></td><td class="right"><strong><?= $fmt($grand) ?></strong></td></tr>
      </table>
    </div>

    <div class="actions" style="margin-top:1rem;">
      <a class="btn" href="catalog.php">← Continue Shopping</a>
      <form method="post">
        <button type="submit" name="action" value="checkout" class="btn btn-primary">Check Out</button>
      </form>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
