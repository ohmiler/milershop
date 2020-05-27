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
					<li><a href="#">TECH</a></li>
					<li><a href="#">MEN</a></li>
					<li><a href="#">WOMEN</a></li>
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
			<?php 

				include('server.php');

				if (isset($_GET['detail'])) {
					$productid = $_GET['detail'];
					$sql = "SELECT * FROM products WHERE product_id = $productid ";
					$query = mysqli_query($conn, $sql);
					$result = mysqli_fetch_assoc($query);
				}
			?>
			<div style="text-align: center;" class="product-details">
				<br>
				<h1><?php echo $result['product_name']; ?></h1>
				<br>
				<img style="width: 50%;" src="img/<?php echo $result['pic']; ?>" alt="">
				<br>
				<p><?php echo $result['product_detail']; ?></p>
				<br>
				<a class="buy" style="background: green; display: inline-block; 
				padding: .5rem 1rem; color: #fff; text-decoration: none; border-radius: 5px;" href="cart.php?addtocart=<?php echo $result['product_id']; ?>">สั่งซื้อ</a>
				<br><br>
				<a href="index.php" style="background: #ccc; display: inline-block; 
				padding: .5rem 1rem; color: #000; text-decoration: none; border-radius: 5px;">กลับไปหน้าแรก</a>
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