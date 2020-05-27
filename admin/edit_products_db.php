<?php 
	include('server.php');

	$numrand = mt_rand();


	if (isset($_POST['edit_product'])) {

		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_qty = $_POST['product_qty'];
		$product_detail = $_POST['product_detail'];
		$product_type = $_POST['type_id'];
		$product_img = (isset($_POST['product_img']) ? $_POST['product_img'] : '');
		$img2 = $_POST['img2'];
		$upload = $_FILES['product_img']['name'];

		if ($upload != '') {
			$path = "../img/";
			$type = strrchr($_FILES['product_img']['name'], ".");
			$newname = 'img'.$numrand.$type;
			$path_copy = $path.$newname;
			$path_link = "../img/".$newname;
			move_uploaded_file($_FILES['product_img']['tmp_name'], $path_copy);
		} else {
			$newname = $img2;
		}

		$sql = "UPDATE products SET 
				product_name = '$product_name', 
				price = $product_price, 
				pic = '$newname',
				product_qty = $product_qty, 
				product_detail = '$product_detail', 
				type_id = $product_type WHERE product_id = $product_id ";

		$result = mysqli_query($conn, $sql);

		if($result){
	        echo "<script type='text/javascript'>";
	        echo "alert('อัพเดตสินค้าเรียบร้อยแล้ว!');";
	        echo "window.location = 'product_list.php'; ";
	        echo "</script>";
	    } else {
	        echo "<script type='text/javascript'>";
	        echo "alert('มีบางอย่างผิดพลาด');";
	        echo "</script>";
	    }

	    var_dump($sql);

	}


?>