<?php 

	session_start();

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
						<form action="search.php" method="get">
							<span>ค้นหา</span>
							<input type="text" name="search_name" placeholder="ค้นหาสินค้า">
							<input type="submit" name="search_btn">
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

			<div class="search_c">
				<h1>Categories Results : </h1>
				<?php 

				include('server.php');

				if (isset($_GET['type'])) {
					
					$cat_id = mysqli_real_escape_string($conn, $_GET['type']);
					$query = "SELECT * FROM products WHERE type_id LIKE '%".$cat_id."%'";
					$result = mysqli_query($conn, $query); ?>

					<div class="search-grid">
					<?php 
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) 
					{ ?>
						<div class="search-items">
							<h3>ชื่อสินค้า : <?php echo $row['product_name']; ?></h3>
							<img src="img/<?php echo $row['pic']; ?>" alt="">
							<h5>ราคา <?php echo $row['price']; ?> บาท</h5>
						</div>
					<?php 
							}
						} else {
							echo "<h1>No Results</h1>";
						}
					} ?>
					</div>

				<?php 
					mysqli_close($conn);
				?>
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