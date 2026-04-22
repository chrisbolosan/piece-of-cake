<!DOCTYPE html>
<head>
	<title> </title>
	<link rel="stylesheet" href="../css/admin.css">
	<style>
	body {
	    font-family: Arial, sans-serif;
	    background: #f4f6f8;
	    margin: 0;
	    padding: 0;
	}
	header {
	    background: #222;
	    color: #fff;
	    padding: 15px;
	    text-align: center;
	}
	main {
	    max-width: 900px;
	    margin: 40px auto;
	    background: #ffffff;
	    padding: 25px;
	    border-radius: 10px;
	    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}
	h1 {
	    margin-top: 0;
	}
	.status {
	    padding: 10px;
	    border-radius: 5px;
	    background: #e8f5e9;
	    margin-bottom: 20px;
	}
	</style>
</head>

<body>
<!-- header -->
<header>
	<h1>Piece of Cake Admin Panel</h1>
</header>

<!-- sidebar  -->
<aside class="sidebar">
	I am new sidebar
	<div class="sidebar">
		logo here admin	
		
		<h2> Admin Piece of Cake Store </h2>
		</div>
	<ul class="sidebar-menu">
		<li><a href="?page=dashboard">Dashboard</a></li>
		<li><a href="?page=cakes">Cakes</a></li>
		<li><a href="?page=orders">Orders</a></li>
		<li><a href="?page=customers.php">Customers</a></li>
		<li><a href="?page=payments">Payments</a></li>
	</ul>
</aside>

<div class="main">
	<?php include($view); ?>
</div>
</body>
</html>
