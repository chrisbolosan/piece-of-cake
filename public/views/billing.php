<style>
.card {
    max-width: 700px;
    margin: 30px auto;
    padding: 25px;
    background: white;
    border-radius: 10px;
}

.input {
    width: 95%;
    padding: 10px;
    margin-bottom: 10px;
}

.btn-primary {
    background: #1e2366;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 6px;
    width: 100%;
}

.text-center {
    text-align: center;
}

.success {
    color: green;
}
</style>

<?php if (!$processed): ?>

<div class="card">
	<h3>Subtotal: $<?= number_format($total, 2) ?></h3>

	<?php if($promoUsed): ?>
		<h3 class="success">Promo Applied: -$<?= number_format($discount, 2) ?></h3>
	<?php endif; ?>

	<h3>Total: $<?= number_format($finalTotal, 2) ?></h3>

	<form method="post">

		<h2>Customer Information</h2>
		<input class="input" type="text" name="cust_name" placeholder="Full Name" required>
		<input class="input" type="email" name="cust_email" placeholder="Email" required>
		<input class="input" type="text" name="cust_phone" placeholder="Phone Number" required>

		<h2>Shipping Information</h2>
		<input class="input" type="text" name="name" placeholder="Full Name" required>
		<input class="input" type="text" name="address" placeholder="Street Address" required>
		<input class="input" type="text" name="city" placeholder="City" required>
		<input class="input" type="text" name="state" placeholder="State" required>
		<input class="input" type="text" name="zip" placeholder="ZIP Code" required>

		<h2>Billing Information</h2>
		<input class="input" type="text" name="cardname" placeholder="Name on Card" required>
		<input class="input" type="text" name="cardnum" placeholder="Fake Card Number" required>

		<h2>Promo Code</h2>
		<input class="input" type="text" name="promo" placeholder="Enter Promo Code Here">

		<button class="btn-primary" type="submit">Place Order</button>
	</form>
</div>

<?php else: ?>

<div class="card text-center">
	<h1>Order Placed </h1>

	<p>Your order number is <strong><?= $orderID ?></strong></p>
	<p>Total Paid: <strong>$<?= number_format($finalTotal, 2) ?></strong></p>
	<p>Status: Processing</p>

	<br>

	<a href="index.php?page=track" class="btn-primary">
		Track Your Order
	</a>
</div>

<?php endif; ?>
