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
			<a style="padding: .5rem; background: green; display: inline-block; color: #fff; text-decoration: none;" href="add_products.php">เพิ่มสินค้า</a>

			<?php
			    $query = "SELECT * FROM products as p INNER JOIN products_type as t ON p.type_id = t.type_id ORDER BY p.product_id";
			    $result = mysqli_query($conn, $query);
			?>
			  	<table width="100%">
			        <tr>
			            <td>Product id</td>
			            <td>Product Pic</td>
			            <td>Product Name</td>
			            <td>Product Price</td>
			            <td>Product Qty</td>
			            <td>Product Type</td>
			            <td colspan='2'>Actions</td>
			      	</tr>
			      <?php  while ($row = mysqli_fetch_assoc($result)) { ?>
			        <tr>
			           <td><?php echo $row["product_id"]; ?></td>
			           <td width=""><img width="50%" src="../img/<?php echo $row["pic"]; ?>" alt=""></td>
			           <td><?php echo $row["product_name"]; ?></td>
			           <td><?php echo $row["price"]; ?></td>
			           <td><?php echo $row["product_qty"]; ?></td>
			           <td><?php echo $row["type_name"]; ?></td>
			           <td><a href="edit_products.php?edit=<?php echo $row['product_id']; ?>">แก้ไข</a></td> 
			           <td><a href="delete_products.php?delete=<?php echo $row['product_id']; ?>" 
			           		  onclick="return confirm('คุณต้องการลบสินค้านี้หรือไม่ ?');" >ลบ</a></td>
			     	</tr>
			        <?php } ?>
			      </table>

			<?php mysqli_close($conn); ?>
		</div>
	</section>

	<footer>
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
	</footer>
</body>
</html>
