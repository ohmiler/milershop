<?php 

	session_start();

	include('server.php');

	if (!isset($_SESSION['username'])) {
		header("location: login.php");
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

   <header>
   		<div class="container">
			<div class="banner">
				<img style="width: 100%;" src="img/banner.jpg" alt="">
			</div>
   		</div>
   </header>

	<nav>
		<div class="container">
			<div class="nav-c">
				<ul class="menu">
					<li><a href="index.php">HOME</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
					<li>
						<form class="search_bar" action="<?php echo htmlspecialchars('search.php'); ?>" method="get">
							<span>ค้นหา</span>
							<input type="text" name="search_name" placeholder="ค้นหาสินค้า">
							<input type="submit" name="search_btn" value="Seach">
						</form>
					</li>
				</ul>

				<ul class="login">
					<!-- logged in user information -->
				    <?php  if (isset($_SESSION['username'])) : ?>
				    	<li>Welcome <strong><?php echo $_SESSION['username']; ?></strong></li>
						<li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
 CART</a></li>
 						<li><a href="my_orders.php">ดูรายการสินค้า</a></li>
				    	<li> <a href="index.php?logout=<?php echo $_SESSION['username']; ?>" style="color: red;">logout</a></li>
				    <?php else: ?>
					<li><a href="login.php">LOGIN</a></li>
					<li><a href="register.php">REGISTER</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>

	

	<section>
		<div class="container">
			<br>
			<h1>รายการสั่งซื้อของคุณ <?php echo $_SESSION['username']; ?> ทั้งหมด</h1>
			<br>
			<div class="content-c">
			<?php
			    $query = "SELECT * FROM orders WHERE cust_name = '".$_SESSION['username']."' ";
			    $result = mysqli_query($conn, $query);
			?>
			  	<table width="100%" border="1" style="border-collapse: collapse;">
			        <tr>
			            <td>Order Id</td>
			            <td>Order Date</td>
			            <td>Order Name</td>
			            <td>Order Email</td>
			            <td>Order Phone</td>
			            <td>Order Address</td>
			            <td>Order Total</td>
			      	</tr>
			      <?php  while ($row = mysqli_fetch_assoc($result)) { ?>
			        <tr>
			           <td><?php echo $row["order_id"]; ?></td>
			           <td><?php echo $row["order_date"]; ?></td>
			           <td><?php echo $row["order_name"]; ?></td>
			           <td><?php echo $row["order_email"]; ?></td>
			           <td><?php echo $row["order_phone"]; ?></td>
			           <td><?php echo $row["order_address"]; ?></td>
			           <td><?php echo $row["total"]; ?></td>
			     	</tr>
			        <?php } ?>
			      </table>

			<?php mysqli_close($conn); ?>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
		</div>
	</footer>
</body>
</html>