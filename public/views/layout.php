<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
		<img src="images/header.png" alt="Piece of Cake Banner" class="header-img">
	<nav>
		<a href="?page=home">Home</a>
		<a href="index.php?page=about">About Us</a>
		<a href="?page=cart">Cart</a>
		<a href="?page=billing">Checkout</a>
		<a href="?page=track">Track Order</a>
	</nav>
</header>

<div class="promo">
	<p>Enter code <strong>URMOM</strong> at checkout for a Mother's Day discount!</p>
</div>


<main>
	<?php include($view); ?>
</main>

<footer>
	<div class="footer-content">
		<div class="footer-left">
			<img src="images/logo.png" alt="Piece of Cake Logo" class="footer-logo">
		</div>

		<div class="footer-right">
			<h3><strong>Contact Information</strong></h3>
			<p>Email: pieceofcake@gmail.com</p>
			<p>Phone: (630) 123-4567</p>
		</div>
	</div>
</footer>



</body>
</html>
