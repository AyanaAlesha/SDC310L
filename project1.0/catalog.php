<?php
// catalog.php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];            // [productId => qty]
$cartTotal = array_sum(array_map('intval', $_SESSION['cart']));    // total items in cart
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Catalog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {  background-image: url('download.jpg'); font-family: Arial, sans-serif; margin:0; }
    #container { max-width: 1000px; margin: 1.5rem auto; background: #fff; padding: 1rem; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
    .header-bar { display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom: .75rem; }
    .shop-title { font-size:1.8rem; font-weight:700; color:#5a2d82; }
    #cartIcon a { display:inline-flex; align-items:center; gap:.5rem; text-decoration:none; color:#5a2d82; background:#efe9f8; padding:.35rem .6rem; border-radius:6px; font-weight:600; }
    #cartIcon a:hover { background:#e4daf6; }
    .cart-badge { display:inline-block; min-width:1.2rem; padding:.15rem .4rem; text-align:center; border-radius:999px; background:#5a2d82; color:#fff; font-size:.8rem; line-height:1; }
    table { width:100%; border-collapse:collapse; }
    thead { background:#5a2d82; color:#fff; }
    th, td { border:1px solid #ddd; padding:.65rem; text-align:left; vertical-align:top; }
    tbody tr:nth-child(even) { background:#f9f9f9; }
    .btn { padding:.4rem .8rem; border:0; border-radius:4px; cursor:pointer; }
    .btn-add { background:#5a2d82; color:#fff; }
    .btn-remove { background:#e8e8e8; color:#333; }
    .qty-input { width:60px; padding:.3rem; }
  </style>
</head>
<body>
  <div id="container">
    <div class="header-bar">
      <header class="shop-title">Gem's Wig Supply</header>
      <nav id="cartIcon">
        <a href="checkout.php" aria-label="View cart / checkout">
          <i class="fa fa-shopping-cart" style="font-size:18px"></i>
          Cart <span class="cart-badge"><?= (int)$cartTotal ?></span>
        </a>
      </nav>
    </div>

    <h2>Catalog</h2>
    <table id="catalogTable">
      <thead>
        <tr>
          <th>Product Id</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Add / Remove</th>
          <th>In Cart</th>
        </tr>
      </thead>
      <tbody>
      <?php
      require_once 'mysqli_connect.php';
      $sql = "SELECT ProductID, Name, Description, Cost FROM products ORDER BY ProductID";
      $result = $dbconn->query($sql);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $pid    = (int)$row['ProductID'];
          $name   = htmlspecialchars($row['Name']);
          $desc   = htmlspecialchars($row['Description']);
          $price  = number_format((float)$row['Cost'], 2);
          $inCart = (int)($_SESSION['cart'][$pid] ?? 0);

          echo "<tr>
                  <td>{$pid}</td>
                  <td>{$name}</td>
                  <td>{$desc}</td>
                  <td>\${$price}</td>
                  <td>
                    <form class='cart-form' method='post' action='cart.php' style='display:flex; gap:.5rem; align-items:center;'>
                      <input type='hidden' name='product_id' value='{$pid}'>
                      <input type='number' class='qty-input' name='qty' min='1' max='99' value='0'>
                      <button type='submit' name='action' value='add_one' class='btn btn-add'>Add</button>
                      <button type='submit' name='action' value='remove_one' class='btn btn-remove'>Remove</button>
                    </form>
                  </td>
                  <td class='in-cart'>{$inCart}</td>
                </tr>";
        }
      }
      ?>
      </tbody>
    </table>
  </div>