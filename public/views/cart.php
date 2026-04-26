<h1>Your Cart</h1>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <ul>
        <?php foreach ($cart as $id => $qty): ?>
            <li>Product ID: <?= $id ?> — Quantity: <?= $qty ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
