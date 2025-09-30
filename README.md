# SDC310L

  README — Gem’s Wig Supply (PHP Shopping Cart)
🛍 Overview

This project is a simple online store web application built with PHP, MySQL, HTML, and CSS.

Users can:

Browse a product catalog.

Add or remove quantities of each product to their shopping cart.

See a cart badge showing the total quantity of items.

Click the cart icon to view the checkout page showing:

Each product in the cart (ID, name, qty, unit cost, line total)

Order totals: subtotal, 5% tax, 10% shipping, and final total.

Clear the cart by clicking “Check Out” (then return to catalog).
How to Run

Install and start XAMPP / WAMP / MAMP

Place all project files into the htdocs (XAMPP) or www (WAMP) directory inside a folder like gemswig.

Visit http://localhost/project2.0/Views/index.php


Session-based cart persistence

Clean separation of logic (cart.php) and display (catalog.php, checkout.php)

Safe server-side totals (client cannot tamper with prices)

📷 UI Preview

Catalog page:

Product table

Quantity selector

Add / Remove buttons

Shopping cart badge in top right

Checkout page:

List of items

Totals table

Continue shopping / Checkout buttons

