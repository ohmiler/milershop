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
			<div class="content-c">
				<div class="sidebar-c">
					<div class="sidebar-title">
						<h3>หมวดหมู่สินค้า</h3>
					</div>

					<ul class="sidebar-categories">
						<?php
				            
				            $query = "SELECT * FROM products_type ORDER BY type_id";
				            $result = mysqli_query($conn, $query);

				          	if (mysqli_num_rows($result) == 0) { 
				          	echo "<li>ไม่มีหมวดหมู่สินค้า !</li>";
				          } else { ?>
				          <?php foreach($result as $results) { ?>
							<li><a href="categories.php?type=<?php echo $results['type_id']; ?>"><?php echo $results["type_name"]; ?></a></li>
			              <?php } } ?>

			              <!-- <li><a href="categories.php"></a></li> -->
					</ul>
				</div>


			<div class="product-c">

			<br><br>

			<?php if (isset($_SESSION['success'])) : ?>
		      <div class="error success" >
		      	<h3>
		          <?php 
		          	echo $_SESSION['success']; 
		          	unset($_SESSION['success']);
		          ?>
		      	</h3>
		      </div>

		  	<?php endif ?>

			<div class="product-grid">
				<?php 

					$sql = "SELECT * FROM products";
					$query = mysqli_query($conn, $sql);

					if (mysqli_num_rows($query) > 0) {
						while($row = mysqli_fetch_assoc($query)) {

				?>

				<div class="product-items">
					<div class="pd-img">
						<h3><?php echo $row['product_name']; ?></h3>
						<a href="product-details.php?detail=<?php echo $row['product_id']; ?>">
							<img src="img/<?php echo $row['pic']; ?>" alt="">
						</a>
					</div>
					<div class="pd-info">
						<p class="price">ราคา <?php echo $row['price']; ?> บาท</p>
						<?php 
							if ($row['product_qty'] == 0) {
								echo "<p style='color: red;'>สินค้าหมด</p>";
							} else {
						?>
						<a class="buy" href="cart.php?addtocart=<?php echo $row['product_id']; ?>">สั่งซื้อ</a>
						<?php } ?>
						<p class="label">จำนวนคงเหลือ <?php echo $row['product_qty']; ?> ชิ้น</p>
					</div>
				</div>
				
				<?php } 
					} else {
						echo "<h1>ไม่มีสินค้า</h1>";
					}
				?>

				<!-- <div class="product-items">
					<div class="pd-img">
						<h3>Product name</h3>
						<a href="#">
							<img src="img/product1.jpg" alt="">
						</a>
					</div>
					<div class="pd-info">
						<p class="price">ราคา 10000 บาท</p>
						<a class="buy" href="#">สั่งซื้อ</a>
						<p class="label">จำนวนคงเหลือ 5 ชิ้น</p>
					</div>
				</div> -->
			</div>
			</div>
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