

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gem's Wig Supply</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f8f6fb;
      color: #333;
    }

    header {
      background: #5a2d82;
      color: white;
      text-align: center;
      padding: 2.5rem 1rem;
    }

    header h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    header p {
      margin: 0.5rem 0 0;
      font-size: 1.2rem;
    }

    nav {
      background: #ece6f4;
      display: flex;
      justify-content: center;
      gap: 2rem;
      padding: 1rem;
    }

    nav a {
      text-decoration: none;
      color: #5a2d82;
      font-weight: bold;
      transition: color 0.2s;
    }

    nav a:hover {
      color: #7a3ab3;
    }

    .hero {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem 1rem;
      text-align: center;
      background: url('https://images.unsplash.com/photo-1615207429056-95d38a935f36?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
      color: white;
    }

    .hero-content {
      background: rgba(90, 45, 130, 0.7);
      padding: 2rem;
      border-radius: 12px;
    }

    .hero-content h2 {
      margin-top: 0;
      font-size: 2rem;
    }

    .btn {
      display: inline-block;
      margin-top: 1.5rem;
      padding: 0.8rem 1.5rem;
      background: #fff;
      color: #5a2d82;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.2s;
    }

    .btn:hover {
      background: #f2eafd;
    }

    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      padding: 3rem 1.5rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .feature {
      background: #fff;
      border-radius: 8px;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .feature i {
      color: #5a2d82;
      font-size: 2rem;
      margin-bottom: 0.5rem;
    }

    footer {
      background: #5a2d82;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 3rem;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>Gem's Wig Supply</h1>
    <p>Where Glam Meets Comfort</p>
  </header>

  <nav>
    <a href="index.html">Home</a>
    <a href="catalog.php">Shop Wigs</a>
    <a href="checkout.php"><i class="fa fa-shopping-cart"></i> Cart</a>
  </nav>

  <section class="hero">
    <div class="hero-content">
      <h2>Find Your Perfect Look</h2>
      <p>Explore our premium selection of wigs, accessories, and styling tools.</p>
      <a href="catalog.php" class="btn">Shop Now</a>
    </div>
  </section>

  <section class="features">
    <div class="feature">
      <i class="fa fa-diamond"></i>
      <h3>Premium Quality</h3>
      <p>Silky, natural textures designed for all-day comfort and style.</p>
    </div>
    <div class="feature">
      <i class="fa fa-truck"></i>
      <h3>Fast Shipping</h3>
      <p>Get your favorite styles delivered right to your door quickly.</p>
    </div>
    <div class="feature">
      <i class="fa fa-heart"></i>
      <h3>Customer Care</h3>
      <p>Friendly support and hassle-free returns on every order.</p>
    </div>
  </section>

  <footer>
    &copy; 2025 Gem's Wig Supply — All Rights Reserved
  </footer>

</body>
</html>
