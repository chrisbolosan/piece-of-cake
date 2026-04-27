<style>
.track-container {
	max-width:700px;
	margin: 40px auto;
	padding: 20px;
}

.track-card {
	background: white;
	border-radius: 10px;
	padding: 25px;
}

.track-form {
	text-align: center;
	margin-bottom: 25px;
}

.track-form button {
	padding: 10px 20px;
	cursor: pointer;
}

.divider {
	margin: 20px 0;
	border-top: 1px solid black;
}

.progress-bar {
	display: flex;
	justify-content: space-between;
	position: relative;
	margin: 25px 0;
}

.progress-line {
	position: absolute;
	top: 12px;
	left: 0;
	height: 4px;
	background: #4CAF50;
	z-index: 0;
	width: 0%;
	transition: width 0.5s ease-in-out;
}

.step {
	text-align: center;
	flex:1;
	position: relative;
	z-index: 1;
}

.circle {
	width: 25px;
	height: 25px;
	border-radius: 50%;	
	background: #ccc;
	margin: 0 auto;
}

.step.active .circle {
	background: #4CAF50; 
	box-shadow: 0 0 0 4px rgba(76,175,80,0.2);
}

.label {
	font-size: 12px;
	margin-top: 6px;
}
.status-processing { color: orange; }
.status-shipped { color: blue; }
.status-delivered { color: green; }
.status-ready { color: purple; }

</style>

<div class="track-container">

	<div class="track-form">
		<h3>Track Your Order</h3>

		<form method="POST">
			<input type="number" name="orderID" min="1" maxlength=8 placeholder="Order ID" required>
			<input type="text" name="email" maxlength=30 placeholder="Email" required>
			<br><br>
			<button type="submit">Track</button>
		</form>
	</div>
	
		<?php if ($order): ?>
		<!-- card -->
		<div class="track-card">

			<h3> Order # <?= $order['OrderID'] ?></h3>

			<p>
				<strong>Status:</strong> 
				<span class="status-<?= strtolower(str_replace(' ', '-', $order['OrderStatus'])) ?>">
				<?= $order['OrderStatus'] ?>
				</span>
			</p>	
			<!-- VISUAL TRACKER -->
			
			<?php
			$status = $order['OrderStatus'];	
			$type = $order['FulfillmentType'];
			if ($type ==='Pickup') {
				$steps = ['Processing', 'Ready for Pickup', 'Delivered'];
			} else {
				$steps = ['Processing', 'Shipped', 'Delivered'];
			}

			$currentIdx = array_search($status, $steps);
			if ($currentIdx === false) $currentIdx = 0;
			$totalSteps = count($steps) - 1;
			$progressPercentage = ($currentIdx / $totalSteps) * 100;
			?>
			
			<div class="progress-bar">
				<div class="progress-line" style="width: <?= $progressPercentage ?>%"></div>
			<?php foreach($steps as $idx => $step): ?>
				<div class="step <?= $idx <= $currentIdx ? 'active' : '' ?>">
				<div class="circle"></div> 
				<div class="label"><?= $step ?></div> </div>
			<?php endforeach; ?> </div>	

			<?php if ($order['FulfillmentType'] === 'Pickup'): ?>
				<p><strong>Pickup Status:</strong> <?= $order['OrderStatus'] ?></p>
			<?php else: ?>

				<?php if ($order['TrackingNumber']): ?>
					<p><strong>Tracking Number:</strong> <?= $order['TrackingNumber'] ?></p>
				<?php else: ?>
					<p><em>Tracking available once your order ships.</em></p>
				<?php endif; ?>
			
				<div class="divider"></div>

				<h4> Shipping Address</h4>

				<p>
					<?= $order['StreetAddress'] ?>,
					<?= $order['City'] ?>,
					<?= $order['State'] ?>,
					<?= $order['ZIP'] ?>,
				</p>

			<?php endif; ?>

			<div class="divider"></div>

			<h4> Customer Name</h4>
			<p><?= $order['Name'] ?> </p>

			<div class="divider"></div>
		
			<h4> Payment</h4>	
			<p><strong>Order Total:</strong> $<?= number_format($order['Amount'], 2) ?></p>
			<p><strong>Total Spent (All Orders):</strong> $<?= number_format($totalSpent, 2) ?></p>	

			<div class="divider"></div>

			<h4> Items</h4>
			<?php while ($item = $items->fetch(PDO::FETCH_ASSOC)): ?>
				<p>
					<?= $item['Flavor'] ?>
					(<?= $item['Size'] ?>)
					 x <?= $item['Quantity'] ?>
				</p>
			<?php endwhile; ?>
		</div>
	
	<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'):?>
		<p>order not found</p>	
	<?php endif; ?>

</div>
