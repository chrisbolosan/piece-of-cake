<!DOCTYPE html>
<head>
	<title> </title>
	<link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<div class="sidebar">
	<h2> Admin> </h2>
	<a href="?page=dashboard">Dashboard</a>
	<a href="?page=cakes">Cakes</a>
	<a href="?page=orders">Orders</a>
</div>

<div class="main">
	<?php include($view); ?>
</div>
</body>
</html>
