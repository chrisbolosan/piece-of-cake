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
		<td><?= $row['OrderID'] ?> </td>	
		<td>$<?= $row['Amount'] ?> </td>	
		<td> <?= $row['PaymentStatus'] ?> </td>	
		<td> <?= $row['Method'] ?> </td>	
		<td>**** <?= $row['CardLastFour'] ?> </td>	
	</tr>
	<?php endwhile; ?>	

</table>

