# SDC310L

  README — Gem’s Wig Supply (PHP Shopping Cart)
🛍 Overview

This project is a simple online store web application built with PHP, MySQL, HTML, CSS, and JavaScript.

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

Visit http://localhost/gemswig/catalog.php

🧠 How It Works

When a user clicks Add or Remove:

A JavaScript fetch() call sends product_id, qty, and action to cart.php

cart.php updates $_SESSION['cart']

It returns the new total and item quantity as JSON

The page instantly updates the cart badge and the row’s “In Cart” cell — no page reload

On the checkout page:

It queries the DB for all items in the cart

Shows each item with ProductID, Name, Qty, Unit Cost, Line Total

Calculates:

Subtotal = sum of line totals

Tax = 5% of subtotal

Shipping = 10% of subtotal

Grand total = subtotal + tax + shipping

“Check Out” clears $_SESSION['cart'] and redirects back to catalog

📌 Features

Real-time badge updates using AJAX

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

✅ To-Do / Possible Improvements

User login system and order history

Stock inventory quantity control

Styling enhancements / responsive design

Database-based order records
