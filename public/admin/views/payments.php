<h2>Payments</h2>

<table border="1">
	<tr>
		<th>OrderID</th>
		<th>Amount</th>
		<th>Status</th>
		<th>Method</th>
		<th>Card</th>
	</tr>
	
	<?php while ($row = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
	<tr>
		<td><?= (int)$row['OrderID'] ?> </td>	
		<td>$<?= number_format((float)$row['Amount'], 2) ?></td>

		<td><?= htmlspecialchars($row['PaymentStatus'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></td>    
		<td><?= htmlspecialchars($row['Method'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>    

		<td>**** <?= htmlspecialchars($row['CardLastFour'] ?? '0000', ENT_QUOTES, 'UTF-8') ?></td>
	</tr>
	<?php endwhile; ?>	

</table>

