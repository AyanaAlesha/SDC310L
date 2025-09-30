<?php 


require('mysqli_connect.php');

      $products = [];
      $sql = "SELECT ProductID, Name, Description, Cost, cart FROM products ORDER BY ProductID";
      $result = $db_conn ->query($sql);

    
  ?>