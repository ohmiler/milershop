<?php 
	
	include('server.php');

	if (isset($_POST['pd_type_add'])) {

		$type_name = $_POST['type_name'];
		$sql = "INSERT INTO products_type (type_name) VALUES ('$type_name') ";
		$result = mysqli_query($conn, $sql);

	  if($result){
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มประเภทสินค้าเรียบร้อยแล้ว');";
        echo "window.location = 'product_type.php'; ";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด');";
 		echo "window.location = 'product_type.php'; ";
        echo "</script>";
      }

      mysqli_close($conn);
	}


?>