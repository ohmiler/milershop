<?php 
	
	session_start();

	include('server.php');
	date_default_timezone_set('Asia/Bangkok');

	if (isset($_POST['save_order'])) {
		$order_name = $_POST['name'];
		$order_phone = $_POST['phone'];
		$order_email = $_POST['email'];
		$order_address = $_POST['address'];
		$total = $_POST['total'];
		$cust_name = $_POST['cust_name'];
		$order_date = Date("Y-m-d G:i:s");

		$sql1 = "INSERT INTO orders (order_date, order_name, order_email, order_phone, order_address, total, cust_name) 
				VALUES ('$order_date', '$order_name', '$order_email', '$order_phone', '$order_address', $total, '$cust_name') ";
		$query1 = mysqli_query($conn, $sql1);

		$sql2 = "SELECT max(order_id) as o_id FROM orders WHERE order_name = '$order_name' AND order_email = '$order_email' AND order_date = '$order_date' ";
		$query2 = mysqli_query($conn, $sql2);
		$row = mysqli_fetch_assoc($query2);
		$o_id = $row['o_id'];

		foreach($_SESSION['cart'] as $product_id => $qty) {
			$sql3 = "SELECT * FROM products WHERE product_id = $product_id ";
			$query3 = mysqli_query($conn, $sql3);
			$row3 = mysqli_fetch_assoc($query3);
			$total = $row3['price'] * $qty;
			$count = mysqli_num_rows($query3);

			$sql4 = "INSERT INTO orders_detail (order_id, product_id, qty, total) VALUES ($o_id, $product_id, $qty, $total)";
			$query4 = mysqli_query($conn, $sql4);

			// Cut Stock
			for ($i = 0; $i < $count; $i++) {
				$instock = $row3['product_qty'];
				$stock = $instock - $qty;
				$sqlstock = "UPDATE products SET product_qty = $stock WHERE product_id = $product_id";
				$querystock = mysqli_query($conn, $sqlstock);
			}
		}

		if ($query1 && $query4) {
			foreach ($_SESSION['cart'] as $product_id) {
				unset($_SESSION['cart']);
			}
			echo "<script type='text/javascript'>";
	        echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
	        echo "window.location = 'index.php'; ";
	        echo "</script>";
	      } else {
	        echo "<script type='text/javascript'>";
	        echo "alert('มีบางอย่างผิดพลาด');";
	        echo "</script>";
	      }

	      mysqli_close($conn);
	  }

?>