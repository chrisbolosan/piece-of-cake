
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<?php if (!$processed): ?>

<h1>Checkout</h1>
<h3>Total: $<?= number_format($total, 2) ?></h3>

<form method="post">
    <h2>Shipping Information</h2>
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="text" name="address" placeholder="Street Address" required><br>
    <input type="text" name="city" placeholder="City" required><br>
    <input type="text" name="state" placeholder="State" required><br>
    <input type="text" name="zip" placeholder="ZIP Code" required><br>

    <h2>Billing Information</h2>
    <input type="text" name="cardname" placeholder="Name on Card" required><br>
    <input type="text" name="cardnum" placeholder="Fake Card Number" required><br>
    <input type="text" name="exp" placeholder="Expiration Date" required><br>
    <input type="text" name="cvv" placeholder="Fake CVV" required><br>

    <button type="submit">Place Order</button>
</form>

<?php else: ?>

<h1>Order Placed</h1>
<p>Your order number is <?= $orderID ?>.</p>
<p>Total Paid: $<?= number_format($total, 2) ?></p>
<p>Status: Processing</p>

<?php endif; ?>

</body>
</html>
