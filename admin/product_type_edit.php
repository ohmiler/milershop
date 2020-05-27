<?php 
	
	session_start();

	include('server.php');

	if ($_SESSION["userid"] == "") {
		header("location: index.php");
		exit();
	}

	if ($_SESSION["status"] != "admin") {
		echo "This page for admin only!";
		exit();
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['userid']."' ";
	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>Welcome <?php echo $result["username"]; ?>!</h1>
	</header>
	<section>
		<nav>
			<ul>
				<li><a href="dashboard.php">Dashboard</a><br></li>
				<li><a href="product_list.php">จัดการสินค้า</a><br></li>
				<li><a href="product_type.php">จัดการประเภทสินค้า</a><br></li>
				<li><a href="view_orders.php">จัดการออเดอร์</a><br></li>
				<li class="logout"><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<div class="info">
			<h1>แก้ไขประเภทสินค้า</h1>

			<?php 
				$type_id = $_GET['edit'];
				$sql = "SELECT * FROM products_type WHERE type_id = $type_id ";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
			?>

			<form  class="adduser" action="product_type_edit_db.php" method="POST">
	            <input name="type_id" type="hidden" value="<?php echo $type_id; ?>" placeholder="ใส่ประเภทสินค้า" required>
	            <input name="type_name" type="text" value="<?php echo $row['type_name']; ?>" placeholder="ใส่ประเภทสินค้า" required>
	            <br>
	            <input type="submit" name="pd_type_edit">
	         </form>
			<?php mysqli_close($conn); ?>
		</div>
	</section>

	<footer>
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
	</footer>
</body>
</html>
