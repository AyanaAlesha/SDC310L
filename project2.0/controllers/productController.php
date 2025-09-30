<?php 
    require_once('../Models/products.php');

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $pid    = (int)$row['ProductID'];
          $name   = htmlspecialchars($row['Name']);
          $desc   = htmlspecialchars($row['Description']);
          $price  = number_format((float)$row['Cost'], 2);
          $inCart = (int)($_SESSION['cart'][$pid] ?? 0);


        $products[] = $row;
        }
  }
?>