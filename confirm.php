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
						<li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ตระกร้า</a></li>
 						<li><a href="my_orders.php"><i class="fa fa-list-alt" aria-hidden="true"></i> ดูรายการสินค้า</a></li>
				    	<li> <a href="index.php?logout=<?php echo $_SESSION['username']; ?>" style="color: red;"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>
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
			<form action="saveorder.php" method="post">
				<h1>สั่งซื้อสินค้า</h1>
				<br>
				<table width="100%" border="1" style="border-collapse: collapse;">
					<tr>
						<td>สินค้า</td>
						<td>ราคา</td>
						<td>จำนวน</td>
						<td>รวม</td>
					</tr>
					<?php 
						$total = 0;
						if (!empty($_SESSION['cart'])) {
							foreach ($_SESSION['cart'] as $product_id => $qty) {
								$sql = "SELECT * FROM products WHERE product_id = $product_id";
								$query = mysqli_query($conn, $sql);
								$row = mysqli_fetch_assoc($query);
								$sum = $row['price'] * $qty;
								$total += $sum;
					?>
						<tr>
							<td><?php echo $row['product_name']; ?></td>
							<td><?php echo number_format($row['price'], 2); ?></td>
							<td><?php echo $qty; ?></td>
							<td><?php echo number_format($sum, 2); ?></td>
						</tr>
					<?php } ?>
						<tr>
							<td colspan="3">ราคารวม</td>
							<td><?php echo number_format($total, 2); ?></td>
						</tr>
					<?php } ?> 
				</table>
				<br>
				<table>
					<?php 
						$query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
			            $result = mysqli_query($conn, $query);
			            $row = mysqli_fetch_assoc($result);
					?>
					<tr><td>รายละเอียดการส่งสินค้า</td></tr>
					<input type="hidden" name="cust_name" value="<?php echo $row['username']; ?>">
					<input type="hidden" name="total" value="<?php echo $total; ?>">
					<tr>
						<td>ชื่อ</td>
						<td><input type="text" name="name" placeholder="ชื่อ-นามสกุล" required></td>
					</tr>
					<tr>
						<td>เบอร์โทรศัพท์</td>
						<td><input type="tel" name="phone" placeholder="เบอร์โทรศัพท์" required></td>
					</tr>
					<tr>
						<td>อีเมล์</td>
						<td><input type="email" name="email" placeholder="อีเมล์" required></td>
					</tr>
					<tr>
						<td>ที่อยู่</td>
						<td><textarea name="address" placeholder="ที่อยู่" required></textarea></td>
					</tr>
					<tr>
						<td colspan="2"><input style="width: 100%; cursor: pointer; background: green; color: #fff; padding: .5rem;" type="submit" name="save_order" value="สั่งซื้อ"></td>
					</tr>
				</table>
			</form>
			

		</div>
	</section>

	<footer>
		<div class="container">
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
		</div>
	</footer>
</body>
</html>